<?php
namespace app\admin\controller;

//use \think\View;
use \think\Controller;
use \think\Request;
use \think\Session;

class Controll extends Controller
{
    public function toIframe($htmlName){
        return $this->fetch($htmlName);
    }

    public function person(){
        return $this->fetch('person');
    }

    public function quit(){
        //用户注销删除SESSION
        Session::delete('adminInfo');
        if(Session::has('adminInfo')){
            $res = [
                'code' => 90010,
                'msg' => config('msg')['signOut']['outFail'],
                'data' => []
            ];
        }else{
            $res = [
                'code' => 90011,
                'msg' => config('msg')['signOut']['signOut'],
                'data' => []
            ];
        }
        return json($res);
    }
}