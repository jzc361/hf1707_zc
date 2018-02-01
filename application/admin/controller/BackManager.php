<?php
namespace app\admin\controller;

//use \think\View;
use \think\Controller;
use \think\Request;
use \think\Db;
use \think\Session;
class Backmanager extends Controller
{

    public function toIframe($htmlName){
        return $this->fetch($htmlName);
    }

    public function allRole(){
        $allRole = Db::name('role')->select();
        if(count($allRole)>0){
            $res = [
                'code'=>90021,
                'msg'=>config('msg')['oper']['select'],
                'data'=>$allRole
            ];
        }else{
            $res = [
                'code'=>90021,
                'msg'=>config('msg')['oper']['selectFail'],
                'data'=>$allRole
            ];
        }
        return json($res);
    }
}