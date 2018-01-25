<?php
namespace app\admin\controller;

//use \think\View;
use \think\Controller;
use \think\Request;
class Index extends Controller
{
    //转入主页
    public function index()
    {
        return $this->fetch('loginView');
    }

}
