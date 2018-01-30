<?php
namespace app\admin\controller;

//use \think\View;
use \think\Controller;
use \think\Request;
use \think\Session;
use \think\Db;

class Index extends Controller
{
    //转入主页
    public function index()
    {
        return $this->fetch('login');
    }

    public function menuctrl(){
        $online = Session::get('onlineEmp');

        $empRole = $online['roleid'];
        $menuDate = Db::name('limit')
            ->alias('a')
            ->join('backmenu b','a.limitid = b.menuid')
            ->where('a.roleid = "'.$empRole.'"')
            ->select();

        return $menuDate;
    }
}
