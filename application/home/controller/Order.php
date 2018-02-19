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

        if(!$this->zc_user){
            $reMsg=[
                'code'=>00000,
                'msg'=>config('msg')['nologin']['nologin'],
                'data'=>''
            ];
            return json($reMsg);
        }else{
            $condition=[
                'prodetailsid'=>$prodetailsid,
                'userid'=>$this->zc_user['userid']
            ];
            //var_dump($condition);exit;
            $order=db('orders')->where($condition)->find();
            //var_dump($order);exit;
            if(!empty($order)){
                $reMsg=[
                    'code'=>60004,
                    'msg'=>config('msg')['order']['excess'],
                    'data'=>''
                ];
                return json($reMsg);
            }
            $reMsg=[
                'code'=>60005,
                'msg'=>config('msg')['order']['toOrder'],
                'data'=>''
            ];
            return json($reMsg);
        }
        //return $this->fetch('{:url("home/order/addOrder"}');
    }

    public function order(){
        $prodetailsid=input('get.prodetailsid');
        $condition=[
            'prodetailsid'=>$prodetailsid,
            'userid'=>$this->zc_user['userid']
        ];
        $order=db('orders')->where($condition)->find();
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
    public function orderCancel(){
        $orderId=input('?get.orderId')?input('orderId'):"";
        $res=db('orders')
            ->where('userid',$this->zc_user['userid'])
            ->where('ordersid',$orderId)
            ->update(['orderstate'=>'交易关闭']);
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
}