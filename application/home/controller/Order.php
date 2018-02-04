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
                'data'=>'{:url("home/User/showLogin")}'
            ];
            return $reMsg;
        }else{
            $condition=[
                'prodetailsid'=>$prodetailsid,
                'userid'=>$this->zc_user['userid']
            ];
            //var_dump($condition);exit;
            $order=db('orders')->where($condition)->select();
            //var_dump($order);exit;
            if(!empty($order)){
                $reMsg=[
                    'code'=>11111,
                    'msg'=>'支持数达上限',
                    'data'=>''
                ];
                return $reMsg;
            }
            $reMsg=[
                'code'=>'xx',
                'msg'=>'11',
                'data'=>''
            ];
            return $reMsg;
        }
        //return $this->fetch('{:url("home/order/addOrder"}');
    }

    public function order(){
        $prodetailsid=input('get.prodetailsid');
        $condition=[
            'prodetailsid'=>$prodetailsid,
            'userid'=>$this->zc_user['userid']
        ];
        $this->assign('do',$this->do);
        return $this->fetch('addOrder');
    }
}