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


