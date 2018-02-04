<?php
/**
 * Created by PhpStorm.
 * User: HD阳
 * Date: 2018/1/30
 * Time: 11:38
 */

namespace app\admin\controller;

use \think\Controller;
use \think\Request;
use \think\Db;
use \think\Paginator;
class Chat extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function toIframe($htmlName){

        $empInfo=session('adminEmp');
        //var_dump($adminEmp);exit();
        $this->assign('empInfo',json_encode($empInfo));
        $this->assign('hisList',[]);
        return $this->fetch($htmlName);
    }

    //显示客服页面
    public function showChat(){
        $empid=input('get.empid');
        $userid=input('get.userid');
        //获取用户名与员工名
        $username=db('user')->field('username')->where('userid',$userid)->find();
        $username=$username['username'];
        $empname=db('emp')->field('empname')->where('empid',$empid)->find();
        $empname=$empname['empname'];
        //获取聊天记录
        $res=db('chats')->where(['rever'=>$empid,'sender'=>$userid])
            ->whereOr(['rever'=>$userid,'sender'=>$empid])
            ->order('msgTime','desc')
            ->select();
      //  $this->assign('hisList',$res);
        return json_encode(['hisList'=>$res,'username'=>$username,'empname'=>$empname]);
 //   }


    }
}