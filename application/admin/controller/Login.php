<?php
namespace app\admin\controller;
//安全验证---------------------------待定
use \think\Controller;
use \think\Request;
use \think\Session;
use \think\Db;
use \think\Response;

class Login extends Controller
{
    //登录方法
    public function login()
    {
        $account = input('?post.account')?input('account'):'';
        $pwd =  input('?post.pwd')?input('pwd'):'';//
        $vali =  input('?post.vali')?input('vali'):'';//

        $checkVali = captcha_check($vali);//验证码校验

//        $res = [
//            'account'=>$account,
//            'password'=>$pwd,
//            'validate'=>$vali,
//        ];

//      登录判断(含验证码)

        $md5pwd =md5($pwd); //  加密字符校验
        if ($checkVali) {
            //验证码正确
            $where = [
                'empid' => $account,
                'emppsw' => $md5pwd
            ];
            //数据库查询
            //测试本地连接无问题
            $sel =  Db::name('emp')->where($where)->find();
            if ($sel) {//有结果
                //session存值
                Session::set('onlineEmp',$sel);

                $res = [
                    'code' => 10001,
                    'msg' => config('msg')['login']['success'],
                    'data' => []
                ];
            } else {
                $res = [
                    'code' => 10000,
                    'msg' => config('msg')['login']['error'],
                    'data' => []
                ];
            }
        } else {
            $res = [
                'code' => 10002,
                'msg' => config('msg')['login']['codeFail'],
                'data' => []
            ];
        }
        return json($res);
    }


    //进入后台管理界面

    public function  adminMain(){
        return $this->fetch('index');
    }

    //回到首页
    public function toMain(){
        //由tp自带跳转进入main主页(index/主页名称)
        $this->redirect('home/index/index');
    }


    //
}