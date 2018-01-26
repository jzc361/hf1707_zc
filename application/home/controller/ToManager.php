<?php
namespace app\home\controller;
//use \think\View;
use \think\Controller;
use \think\Db;
use \think\Request;
use \think\Session;
use \think\Cache;


class ToManager extends  Controller
{
    public function ToManager()
    {
        $this->redirect('admin/index/index');
    }

}