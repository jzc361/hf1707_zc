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
        }else{
            /*$condition=[
                'prodetailsid'=>$prodetailsid,
                'userid'=>$this->zc_user['userid']
            ];
            //var_dump($condition);exit;
            $order=db('orders')->where($condition)->select();*/
            $order=$this->getOrder($prodetailsid,$this->zc_user['userid']);
            //var_dump($order);exit;
            //已支持
            if(!empty($order)){
                $reMsg=[
                    'code'=>60002,
                    'msg'=>config('msg')['order']['orderFull'],
                    'data'=>''
                ];
            }
        /*$reMsg=[
            'code'=>'xx',
            'msg'=>'11',
            'data'=>''
        ];*/
        }
        return $reMsg;
        //return $this->fetch('{:url("home/order/addOrder"}');
    }

    //确认订单
    public function checkOrder(){
        $prodetailsid=input('get.prodetailsid');
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
        //var_dump($prodetails);
        //默认地址信息
        $condition=[
            'userid'=>$this->zc_user['userid'],
            //'isdefault'=>1
        ];
        $addList=db('address a')
            ->field('a.*,b.name province_name,c.name city_name,d.name county_name')
            ->join('zc_region b','a.province=b.id')
            ->join('zc_region c','a.city=c.id')
            ->join('zc_region d','a.county=d.id')
            ->where($condition)
            ->order('a.isdefault desc,a.addressid')
            ->select();
            //->find();
        //var_dump($defaultAdd);
        $this->assign('prodetails',$prodetails);
        $this->assign('addList',$addList);
        $this->assign('do',$this->do);
        return $this->fetch('addOrder');
    }

    //提交订单
    public function addOrder(){
        $addressid=input('post.addressid');
        $prodetailsid=input('post.prodetailsid');
        $order=$this->getOrder($prodetailsid,$this->zc_user['userid']);
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
            'ordersprice'=>$data['price'],
            'ordersnum'=>1,
            'orderstype'=>$data['projecttype'],
            'orderstime'=>date('Y-m-d H:i:s',time()),
            'orderstate'=>'未支付'
        ];
        //var_dump($condition);exit;
        //$res=db('orders')->insert($condition);
        $orderid=db('orders')->insertGetId($condition);
        //var_dump($res);exit;
        if($orderid){
            //提交成功
            $reMsg=[
                'code'=>60001,
                'msg'=>config('msg')['order']['addOrder'],
                'data'=>$orderid
            ];
        }else{
            //提交失败
            $reMsg=[
                'code'=>60001,
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
}