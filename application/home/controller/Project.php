<?php
/**
 * Created by PhpStorm.
 * User: LinTong
 * Date: 2018/1/24
 * Time: 16:24
 */

namespace app\home\controller;

//引用基类
use \think\Controller;

class Project extends Controller
{
    //产品项目（更多众筹）
    public function proindex(){
        $sort=db('sort')->select();
        $pronum=db('project')->count('projectid');
        $pro=db('project')->select();
        $this->assign('sortList',$sort);
        $this->assign('pronum',$pronum);
        $this->assign('pro',$pro);
        return $this->fetch();
    }

    //项目详情
    public function prodetails(){
        //项目id
        $proid=input('?get.proid')?input('get.proid'):"";
        //获取项目信息
        $pro=db('project')->where('projectid',$proid)->find() ;
        //项目简介(图片)
        $proimg=db('proimg')->where('projectid',$proid)->select() ;
        //项目发起人信息
        $username=db('user')->where('userid',$pro['userid'])->column('nickname,nickname');
        $headimg=db('user')->where('userid',$pro['userid'])->column('headimg,headimg');
        //项目详情
        $prodetails=db('prodetails')->where('projectid',$proid)->select() ;
        $this->assign("username",$username[0]);//发起人姓名
        $this->assign('headimg',$headimg[0]);//发起人头像
        $this->assign("pro",$pro);//项目信息
        $this->assign("proimg",$proimg);//项目简介(图片)
        $this->assign("proList",$prodetails);//项目详情
        return $this->fetch();
    }

    /*public function prodetails_progress(){
        return $this->fetch();
    }*/

    //项目评论
    public function prodetails_comment(){
        return $this->fetch();
    }
}