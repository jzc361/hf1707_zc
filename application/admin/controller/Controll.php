<?php
namespace app\admin\controller;

//use \think\View;
use \think\Controller;
use \think\Request;
use \think\Session;
use \think\Db;

class Controll extends Controller
{
    public function toIframe($htmlName){
        return $this->fetch($htmlName);
    }

    public function person(){
        return $this->fetch('person');
    }

    //注销
    public function quit(){
        //用户注销删除SESSION
        $onlineEmp = Session::get('adminEmp');
        $empid=$onlineEmp[0]['empid'];
       // echo $empid;
        //var_dump($onlineEmp);exit();
        $res=Db::name('emp')->where('empid',$empid)->update(['loginstate' => '离线']);
        if($res==1){
            Session::delete('adminEmp');
            if(Session::has('adminInfo')){
            //session删除失败
                $res = [
                    'code' => 90010,
                    'msg' => config('msg')['signOut']['outFail'],
                    'data' => ''
                ];
            }
            else{
            //session删除成功

                $res = [
                    'code' => 90011,
                    'msg' => config('msg')['signOut']['signOut'],
                    'data' => ''
                ];
            }
        }
        return json($res);
    }


    public function nologin(){
        return $this->fetch('nologin');
    }
}