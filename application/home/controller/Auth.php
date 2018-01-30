<?php
namespace app\home\controller;
//use \think\View;
use \think\Controller;
use \think\Db;
use \think\Request;
use \think\Session;
use \think\Cache;

class Auth extends  Controller
{
    //判断权限，跳转首页
    public function __construct()
    {
        parent::__construct();
        $zc_user=Session::get('zc_user');
        /*
         *  还要使用thinkphp的request类，获取当前请求的模块名/控制器名/方法名
         *  跟配制文件的数组比对，在里面，
         * */
        $request = Request::instance();
        $do=$request->module().'/'.$request->controller().'/'.$request->action();
//        var_dump($do);
//        if(!in_array($do,config('msg')['whiteList'])){
//            if(empty($zc_user)){
//                    $this->error('非法闯入，跳转到首页。。。','index/Index/index','',3);
//                    exit;
//            }
//        }
    }
}


