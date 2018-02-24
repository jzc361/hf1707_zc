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
    protected $zc_user;
    protected $do;
    //判断权限，跳转首页
    public function __construct()
    {
        parent::__construct();
        $this->zc_user=Session::get('zc_user');
        /*
         *  还要使用thinkphp的request类，获取当前请求的模块名/控制器名/方法名
         *  跟配制文件的数组比对，在里面，
         * */
        $request = Request::instance();
        $this->do=$request->path();

        if(!in_array(strtolower($this->do),config('msg')['whiteList'])){
            if(empty($this->zc_user)){
                    $this->error("非法闯入{$this->do}，跳转到首页。。。",'home/Index/index','',3);
                    exit;
            }
        }
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


