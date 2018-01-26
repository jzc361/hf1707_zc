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
use \think\Cookie;

class Project extends Controller
{
    //产品项目（更多众筹）
    public function proindex(){
        cookie( null,'pro_');//清空前缀为pro_的cookie
        $condition=[];
        $sortid=input('?get.sortid')?input('get.sortid'):"";//分类id
        //$stateid=input('?get.stateid')?input('get.stateid'):"";
        $statename=input('?get.staname')?input('get.staname'):"";//状态
        $select=input('?get.select')?input('get.select'):"";
        echo $select;
        //获取分类
        $sort=db('sort')->select();
        //按项目分类搜索
        if($sortid!=""){
            cookie('pro_sortid',$sortid,3600);//将查询的分类id存入cookie
            $condition["sortid"]=$sortid;
        }
        //按项目状态搜索
        if($statename!=""){
            cookie('pro_staname',$statename,3600);//将查询的项目状态id存入cookie
            $condition["statename"]=$statename;
        }
        $pro=db('project')->where($condition)->paginate(4);
        $pronum=db('project')->where($condition)->count('projectid');
        $this->assign('sortid',cookie('pro_sortid'));//给前端返回搜索的分类id
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
        //$proimg=db('proimg')->where('projectid',$proid)->select() ;
        //项目发起人信息
        //$username=db('user')->where('userid',$pro['userid'])->column('nickname,nickname');
        //$headimg=db('user')->where('userid',$pro['userid'])->column('headimg,headimg');
        //项目详情
        $prodetails=db('prodetails')->where('projectid',$proid)->select() ;
        //$this->assign("username",$username[0]);//发起人姓名
       // $this->assign('headimg',$headimg[0]);//发起人头像
        $this->assign("pro",$pro);//项目信息
        //$this->assign("proimg",$proimg);//项目简介(图片)
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