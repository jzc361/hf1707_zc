<?php
/**
 * Created by PhpStorm.
 * User: LinTong
 * Date: 2018/2/3
 * Time: 16:42
 */

namespace app\home\controller;


use think\Controller;

class Order extends Auth
{
    //是否已经支持
    public function isOrder(){
        $prodetailsid=input('get.prodetailsid');
        $reMsg=[];
        //未登录
        if(!$this->zc_user){
            $reMsg=[
                'code'=>00000,
                'msg'=>config('msg')['nologin']['nologin'],
                'data'=>''
            ];

            return json($reMsg);

        }else{
            /*$condition=[
                'prodetailsid'=>$prodetailsid,
                'userid'=>$this->zc_user['userid']
            ];
            //var_dump($condition);exit;

            $order=db('orders')->where($condition)->find();

            $order=db('orders')->where($condition)->select();*/
            $order=$this->getOrder($prodetailsid,$this->zc_user['userid']);
            //var_dump($order);exit;
            //支持上限
            if(!empty($order)){
                $ordersnum=0;
                foreach($order as $key=>$value){
                    $ordersnum+=$value['ordersnum'];
                }
                if($ordersnum>=3){
                    $reMsg=[
                        'code'=>60005,
                        'msg'=>config('msg')['order']['excess'],
                        'data'=>''
                    ];
                    return json($reMsg);
                }
            }
            $reMsg=[
                'code'=>60003,
                'msg'=>config('msg')['order']['toOrder'],
                'data'=>''
            ];
            //return json($reMsg);
        }
        return $reMsg;
        //return $this->fetch('{:url("home/order/addOrder"}');
    }

    //确认订单
    public function checkOrder(){
        $prodetailsid=input('get.prodetailsid');
        $num=input('get.num');
        /*$condition=[
            'prodetailsid'=>$prodetailsid,
            'userid'=>$this->zc_user['userid']
        ];*/
        //回报信息
        $prodetails=db('prodetails a')
            ->join('zc_project b','a.projectid=b.projectid')
            ->where('prodetailsid',$prodetailsid)
            ->field('a.*,b.projectname')
            ->find();
        //var_dump($prodetails);exit;
        //默认地址信息
        $condition=[
            'userid'=>$this->zc_user['userid'],
            //'isdefault'=>1
        ];

        $order=db('orders')->where($condition)->find();

        $addList=db('address a')
            ->field('a.*,b.name province_name,c.name city_name,d.name county_name')
            ->join('zc_region b','a.province=b.id')
            ->join('zc_region c','a.city=c.id')
            ->join('zc_region d','a.county=d.id')
            ->where($condition)
            ->order('a.isdefault desc,a.addressid')
            ->select();
            //->find();
        //var_dump($addList);exit;
        $this->assign('num',$num);
        $this->assign('prodetails',$prodetails);
        $this->assign('addList',$addList);
        $this->assign('do',$this->do);
        return $this->fetch('addOrder');
    }


    //删除订单
    public function orderDelete(){
        $orderId=input('?get.orderId')?input('orderId'):"";
        $res=db('orders')
            ->where('userid',$this->zc_user['userid'])
            ->where('ordersid',$orderId)
            ->delete();
        if($res>0){
            $reMsg=[
                'code'=>20003,
                'msg'=>config('msg')['oper']['del'],
                'data'=>''
            ];
        }else{
            $reMsg=[
                'code'=>20004,
                'msg'=>config('msg')['oper']['delFail'],
                'data'=>''
            ];
        }
        return json($reMsg);
    }
    //取消订单
    public function orderCancel()
    {
        $orderId = input('?get.orderId') ? input('orderId') : "";
        $res = db('orders')
            ->where('userid', $this->zc_user['userid'])
            ->where('ordersid', $orderId)
            ->update(['orderstate' => '交易关闭']);
        if ($res > 0) {
            $reMsg = [
                'code' => 20003,
                'msg' => config('msg')['oper']['del'],
                'data' => ''
            ];
        } else {
            $reMsg = [
                'code' => 20004,
                'msg' => config('msg')['oper']['delFail'],
                'data' => ''
            ];
        }
        return json($reMsg);
    }

    //提交订单
    public function addOrder(){
        $addressid=input('post.addressid');
        $prodetailsid=input('post.prodetailsid');
        $num=input('post.num');
        $projectid=$this->getProjectid($prodetailsid);//项目id
        //var_dump($projectid);exit;
        $order=$this->getOrder($prodetailsid,$this->zc_user['userid']);
        //echo $addressid;exit;
        //var_dump($order);exit;
        //已支持
        if(!empty($order)){
            $reMsg=[
                'code'=>60002,
                'msg'=>config('msg')['order']['orderFull'],
                'data'=>''
            ];
            return $reMsg;
        }
        //echo $addressid,$prodetailsid;
        //详情信息
        $data=db('prodetails a')
            ->join('zc_project b','a.projectid=b.projectid')
            ->where('prodetailsid',$prodetailsid)
            ->field('a.*,b.projecttype')
            ->find();
        //var_dump($data);exit;
        $condition=[
            'userid'=>$this->zc_user['userid'],
            'prodetailsid'=>$prodetailsid,
            'addressid'=>$addressid,
            'ordersprice'=>$data['price']*$num,
            'ordersnum'=>$num,
            'orderstype'=>$data['projecttype'],
            'orderstime'=>date('Y-m-d H:i:s',time()),
            'orderstate'=>'未支付'
        ];
        //var_dump($condition);exit;
        //$res=db('orders')->insert($condition);
        $orderid=db('orders')->insertGetId($condition);
        //var_dump($orderid);exit;
        if($orderid){
            //提交成功
            //$res=db('prodetails')->where('prodetailsid',$prodetailsid)->setInc('curcount');//支持数+1
            $this->updateCurcount($projectid);//更新支持数
            //var_dump($res);exit;
            $reMsg=[
                'code'=>60001,
                'msg'=>config('msg')['order']['addOrder'],
                'data'=>$orderid
            ];
        }else{
            //提交失败
            $reMsg=[
                'code'=>60002,
                'msg'=>config('msg')['order']['addOrderFail'],
                'data'=>''
            ];
        }
        return $reMsg;
    }

    //获取订单信息
    public function getOrder($prodetailsid,$userid){
        $condition=[
            'prodetailsid'=>$prodetailsid,
            'userid'=>$userid
        ];
        //var_dump($condition);exit;
        $order=db('orders')->where($condition)->select();
        return $order;
    }

    //获取其他地址信息
    public function getAddress(){
        $condition=[
            'userid'=>$this->zc_user['userid'],
            //'isdefault'=>0
        ];
        $address=db('address a')
            ->field('a.*,b.name province_name,c.name city_name,d.name county_name')
            ->join('zc_region b','a.province=b.id')
            ->join('zc_region c','a.city=c.id')
            ->join('zc_region d','a.county=d.id')
            ->where($condition)
            //->order('a.isdefault desc,a.addressid')
            ->select();
        //var_dump($address);
        return $address;
    }

    //获取项目id
    public function getProjectid($prodetailsid){
        $projectid=db('prodetails')
            ->where('prodetailsid',$prodetailsid)
            ->field('projectid')
            ->find();
        return $projectid['projectid'];
    }

    //更新支持人数
    public function updateCurcount($projectid){
        $curcount=db('orders a')
            ->join('zc_prodetails b','a.prodetailsid=b.prodetailsid')
            ->where('projectid',$projectid)
            ->where('orderstate','<>','交易关闭')
            ->field('count(ordersid) count')
            ->find();
        return $curcount;
    }
}