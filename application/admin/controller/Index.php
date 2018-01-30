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
        $online = Session::get('adminEmp');

        $empRole = $online[0]['roleid'];
        //联表查询后的数据为二(多)维数组
        $menuDate = Db::name('backmenu')
            ->alias('a')
            ->join('limit b','a.menuid = b.menuid')
            ->where('b.roleid = "'.$empRole.'"')
            ->select();
        //thinkphp的数据库路径存取
        foreach($menuDate as $key=>&$value){
            $value['menuurl'] = url($value['menuurl'],$value['menuurlpara']);
        }

//        var_dump($menuDate);//调试用断点
//        exit;
        return $menuDate;
    }
}
