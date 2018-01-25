<?php
namespace app\index\controller;
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
        $account = isset($_POST['account'])?$_POST['account']:"变量未设置";//
        $pwd = isset($_POST['pwd'])?$_POST['pwd']:"变量未设置";//
        $vali = isset($_POST['vali'])?$_POST['vali']:"变量未设置";//

        //var_dump($account,$pwd,$vali);//验证变量
        $checkVali = captcha_check($vali);//验证码校验


//      登录判断(含验证码)
        if($checkVali){
            //验证码正确

            //数据库查询
            $sel = Db::table('manager')->where(['m_id'=>$account,'m_password'=>$pwd])->find();
            if($sel){//有结果
                session_start();
                $_SESSION['manager']= $sel;
                $res = [
                    'code'=>1,//1代表成功0代表失败,
                    'msg'=>'登陆成功'//返回消息
                ];
            }
            else{
                $res = [
                    'code'=>0,//1代表成功0代表失败,
                    'msg'=>'登录失败,账号或密码错误'//返回消息
                ];
            }
        }
        else{
            $res = [
                'code'=>0,//1代表成功0代表失败,
                'msg'=>'验证码错误'
            ];
        }
        echo json_encode($res);
    }

    //回到首页
    public function toMain(){
        //由tp自带跳转进入main主页(index/主页名称)
        return $this->fetch('index/main');
    }


    //
}