<?php
namespace app\home\controller;
//use \think\View;
use \think\Controller;
use \think\Db;
use \think\Request;
use \think\Session;
use \think\Cache;

class User extends  Controller
{
    //跳转用户中心
    public function user()
    {
        return $this->fetch('userView');
    }
    //支持的项目页面
    public function support()
    {
        //判断非法闯入
//        $zc_user=Session::get('zc_user');
//        if(empty($userInfo)){
//            $this->error('非法闯入，跳转到首页。。。','index/Index/index','',3);
//        }
        //获取分页项目
        $zc_user=[];
        $zc_user['userid']=10001;//(测试用)
        $supportList=db('orders a,zc_project b')
            ->where('a.projectid=b.projectid')
            ->where('a.userid',$zc_user['userid'])
            ->order('a.orderstime desc')
            ->paginate(5);
        $this->assign('supportList',$supportList);
        return $this->fetch('support');
    }
    //我的项目页面
    public function myProject()
    {
        return $this->fetch('myProject');
    }
    //关注的项目页面
    public function focus()
    {
        //判断非法闯入
//        $zc_user=Session::get('zc_user');
//        if(empty($userInfo)){
//            $this->error('非法闯入，跳转到首页。。。','index/Index/index','',3);
//        }
        //获取分页项目
        $zc_user=[];
        $zc_user['userid']=10001;//(测试用)
        $focusList=db('focuspro a')
            ->join('zc_project b','a.projectid=b.projectid')
            ->join('zc_prodetails c','a.projectid=c.projectid')
            ->group('a.projectid')
            ->order('a.focustime desc')
            ->paginate(5);
        $this->assign('focusList',$focusList);
        return $this->fetch('focus');
    }
    //资金管理页面
    public function money()
    {
        return $this->fetch('money');
    }
    //个人设置页面
    public function settings()
    {
        return $this->fetch('settings');
    }
    //收货地址页面
    public function address()
    {
        return $this->fetch('address');
    }


    //test
    public function test()
    {
        return $this->fetch('money');
    }
    //
}


