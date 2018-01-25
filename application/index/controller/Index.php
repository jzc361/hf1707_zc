<?php
namespace app\index\controller;
use \think\Controller;
use \think\Db;
use \think\Cache;


class Index extends  Controller
{
    public function index()
    {
        return $this->redirect('home/Index/index');
    }
}

