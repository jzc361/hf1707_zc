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
    //个人设置
    public function settings()
    {
        return $this->fetch('settings');
    }
    //个人设置test
    public function test()
    {
        return $this->fetch('test3');
    }
    //
}


