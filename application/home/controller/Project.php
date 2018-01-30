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
use \think\Db;
use \think\Cookie;
use \think\Session;

class Project extends Controller
{
    //产品项目（更多众筹）
    public function proindex(){
        cookie( null,'pro_');//清空前缀为pro_的cookie
        $condition=[];
        $ord="";
        $ordertype="";
        $sortid=input('?get.sortid')?input('get.sortid'):"";//分类id
        //$stateid=input('?get.stateid')?input('get.stateid'):"";
        $statename=input('?get.staname')?input('get.staname'):"";//状态
        $order=input('?get.order')?input('get.order'):"";
        //$search=input('?get.search')?input('get.search'):"";//搜索
        /*if($search!=""){
            cookie('search',$search,3600);
        }*/
        //echo cookie('search');
        $pageParam= ['query' =>[]];//分页条件
        $pageParam['query']['order'] = $order;
        //获取分类
        $sort=db('sort')->select();
        //按项目分类搜索
        if($sortid!=""){
            cookie('pro_sortid',$sortid,3600);//将查询的分类id存入cookie
            $condition["sortid"]=$sortid;
            $pageParam['query']['sortid'] = $sortid;
        }
        //按项目状态搜索
        if($statename!=""){
            cookie('pro_staname',$statename,3600);//将查询的项目状态id存入cookie
            $condition["statename"]=$statename;
            $pageParam['query']['statename'] = $statename;
        }
        //条件搜索
        /*if(cookie('search')!=""){
            $condition["projectname"]=['like','%'.cookie('search').'%'];
            $pageParam['query']['projectname'] = ['like','%'.cookie('search').'%'];
        }*/
        //排序
        switch ($order){
            case "":
                cookie('order',null);
                break;
            case 1://按热度排序
                cookie('order',$order,3600);
                $ord='focuscount';
                $ordertype='acs';
                break;
            case 2://最新上线
                cookie('order',$order,3600);
                $ord='begintime';
                $ordertype='desc';
                $condition['statename']='众筹中';
                break;
            case 3://按金额排序
                cookie('order',$order,3600);
                $ord='tolamount';
                $ordertype='desc';
                break;
/*            case 4://按支持人数排序
                cookie('order',$order,3600);
                $ord='tolamount';
                $ordertype='desc';
                break;*/
        }

        //获取项目（不包括审核中的项目）
        $pro=db('project')->where($condition)->order($ord,$ordertype)->paginate(4, false, $pageParam);//->whereOr('intro','like','%'.$search.'%')->where('statename','not in','审核中')
        $pronum=db('project')->where($condition)->count('projectid');//->whereOr('intro','like','%'.$search.'%')->where('statename','not in','审核中')
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
        //项目发起人信息
        //$username=db('user')->where('userid',$pro['userid'])->column('nickname,nickname');
        //$headimg=db('user')->where('userid',$pro['userid'])->column('headimg,headimg');
        //项目详情
        $prodetails=db('prodetails')->where('projectid',$proid)->select() ;
        //$this->assign("username",$username[0]);//发起人姓名
       // $this->assign('headimg',$headimg[0]);//发起人头像
        $this->assign("pro",$pro);//项目信息
        $this->assign("proList",$prodetails);//项目详情
        return $this->fetch();
    }

    /*public function prodetails_progress(){
        return $this->fetch();
    }*/

    //项目评论（页面）
    public function prodetails_comment(){
        $proid=input('?get.proid')?input('get.proid'):"";
        //$data=db('comments')->where('projectid',$proid)->select();
        //多表查询
        $data=Db::table('zc_comments')
            ->alias('a')
            ->join('zc_user b','a.userid = b.userid')
            ->where('a.projectid',$proid)
            ->order('a.ctime','desc')
            ->field('a.*,b.userid,b.username,b.headimg')
            ->select();
        $this->assign('comments',$data);
        $this->assign('proid',$proid);
        return $this->fetch();
    }

    //评论
    public function comment(){
        $proid=input('?post.proid')?input('post.proid'):"";
        $comment=input('?post.comment')?input('post.comment'):"";
        $userid=session('zc_user')[0]['userid'];
        $condition=['projectid'=>$proid,'userid'=>$userid];
        //评论内容为空
        if(!$comment){
            $reMsg=[
                'code'=>30004,
                'msg'=>config('Msg')['comment']['null'],
                'data'=>[]
            ];
            return json($reMsg);
        }
        //查看用户订单表，用户是否支持过该项目
        $res=db('orders')->where($condition)->select();
        if(empty($res)){
            //未支持项目
            $reMsg=[
                'code'=>30003,
                'msg'=>config('Msg')['comment']['notAllow'],
                'data'=>[]
            ];
            return json($reMsg);
        }else{
            $reMsg=[
                'code'=>30003,
                'msg'=>config('Msg')['comment']['success'],
                'data'=>[]
            ];
            return json($reMsg);
        }
    }
}