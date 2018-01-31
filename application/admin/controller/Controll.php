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
        //$onlineEmp = Session::get('adminInfo');
        Session::delete('adminInfo');
        if(Session::has('adminInfo')){
            //session删除失败
            $res = [
                'code' => 90010,
                'msg' => config('msg')['signOut']['outFail'],
                'data' => ''
            ];
        }else{
            //session删除成功
            //Db::name('emp')->where('', 1)->update(['name' => 'thinkphp']);
            $res = [
                'code' => 90011,
                'msg' => config('msg')['signOut']['signOut'],
                'data' => ''
            ];
        }
        return json($res);
    }


    public function nologin(){
        return $this->fetch('nologin');
    }
}