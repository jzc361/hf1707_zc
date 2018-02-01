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

    public function roleDel(){
        $rid = isset($_POST['rid'])?$_POST['rid']:'';
        $res = [
            'code'=>20004,
            'msg'=>config('msg')['oper']['delFail'],
            'data'=>''
        ];

        if($rid!=''){
            //条件
            $where = [
                'roleid'=>$rid
            ];
            //返回值
            $data = db('role')->where($where)->delete();

            if($data!=0){//删除成功
                $res = [
                    'code'=>20003,
                    'msg'=>config('msg')['oper']['del'],
                    'data'=>''
                ];
            }
            return $res;
        }else{
            return $res;
        }
    }
}