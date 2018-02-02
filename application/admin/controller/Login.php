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

//      登录判断(含验证码)

        $md5pwd =md5($pwd); //  加密字符校验
        if ($checkVali) {
            //验证码正确
            $where = [
                'empid' => $account,
                'emppsw' => $md5pwd
            ];
            //数据库查询
            //测试连接无问题
            $sel = Db::name('emp')
                ->alias('a')
                ->join('role b','a.roleid = b.roleid')
                ->where($where)
                ->select();
            if ($sel!==NULL) {//有结果
                //session存值

                //登陆状态问题暂时滞留-----------------------------------------------------------------
                //Db::name('emp')->where($sel[0]['empid'],1)->update(['loginstate' => '在线']);
                //$sel[0]['loginstate'] = '在线';
                Session::set('adminEmp',$sel);
                $res = [
                    'code' => 10001,
                    'msg' => config('msg')['login']['success'],
                    'data' => [$sel]
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
    //判断权限
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