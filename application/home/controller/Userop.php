<?php
/**
 * Created by PhpStorm.
 * User: LinTong
 * Date: 2018/1/28
 * Time: 19:04
 */

namespace app\home\controller;


use think\Controller;
use \think\Session;

class Userop extends Controller
{
    public function showLogin(){
        return $this->fetch('userLogin');
    }

    public function showRegister(){
        return $this->fetch('userRegister');
    }

    //登录
    public function userLogin(){
        $username=input('?post.username')?input('post.username'):"";
        $userpsd=input('?post.userpsd')?md5(input('post.userpsd')):"";
        $code=input('?post.code')?input('code'):"";
        //验证码
        if(!captcha_check($code)){
            //验证失败
            $reMsg=[
                'code'=>10002,
                'msg'=>config('Msg')['login']['codeFail'],
                'data'=>[]
            ];
            return json($reMsg);
        }
        $condition=['username'=>$username,'userpsw'=>$userpsd];
        $data=db('user')->where($condition)->select();
        if(empty($data)){
            //登录失败
            $reMsg=[
                'code'=>10000,
                'msg'=>config('Msg')['login']['fail'],
                'data'=>[]
            ];
            return json($reMsg);
        }else{
            //登录成功
            Session::set('user',$data);
            $reMsg=[
                'code'=>10001,
                'msg'=>config('Msg')['login']['success'],
                'data'=>[]
            ];
            return json($reMsg);
        }
    }

    //注册
    public function userRegister(){
        $username=input('?post.username')?input('post.username'):"";
        $userpsd=input('?post.userpsd')?md5(input('post.userpsd')):"";
        $code=input('?post.code')?input('code'):"";
        //验证码
        if(!captcha_check($code)){
            //验证失败
            $reMsg=[
                'code'=>10002,
                'msg'=>config('Msg')['register']['codeFail'],
                'data'=>[]
            ];
            return json($reMsg);
        }
        if($username&&$userpsd){
            $condition=['username'=>$username,'userpsw'=>$userpsd];
            $data=db('user')->where('username',$username)->select();
            if(!empty($data)){
                //账号存在，注册失败
                $reMsg=[
                    'code'=>10014,
                    'msg'=>config('Msg')['register']['fail'],
                    'data'=>[]
                ];
                return json($reMsg);
            }else{
                $res=db('user')->insert($condition);
                if($res){
                    //注册成功
                    $reMsg=[
                        'code'=>10001,
                        'msg'=>config('Msg')['register']['success'],
                        'data'=>[]
                    ];
                    return json($reMsg);
                }
            }
        }
    }
}