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
        $condition['projecttype']='普通众筹';
        $ord="";
        $ordertype="";
        $sortid=input('?get.sortid')?input('get.sortid'):"";//分类id
        $stateid=input('?get.stateid')?input('get.stateid'):"";//状态id
        //$statename=input('?get.staname')?input('get.staname'):"";
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
        //获取状态--众筹中，众筹成功，众筹失败
        $stateType['stateid']=['>',4];
        $state=db('state')->where($stateType)->select();
        //var_dump($state);exit;
        //按项目分类搜索
        if($sortid!=""){
            cookie('pro_sortid',$sortid,3600);//将查询的分类id存入cookie
            $condition["sortid"]=$sortid;
            $pageParam['query']['sortid'] = $sortid;
        }
        //按项目状态搜索
        if($stateid!=""){
            cookie('pro_stateid',$stateid,3600);//将查询的项目状态id存入cookie
            $stateType="";
            $condition["stateid"]=$stateid;
            $pageParam['query']['stateid'] = $stateid;
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

        //获取项目
        /*$pro=Db::table('zc_project')
            ->alias('a')
            ->join('zc_state b','a.stateid=b.stateid')
            ->where($condition)
            ->where($stateType)
            ->order($ord,$ordertype)
            ->paginate(4, false, $pageParam);
        var_dump($pro);exit;*/
        $pro=db('project')->where($condition)->where($stateType)->order($ord,$ordertype)->paginate(4, false, $pageParam);//->whereOr('intro','like','%'.$search.'%')
        //var_dump($pro);exit;
        $pronum=db('project')->where($condition)->where($stateType)->count('projectid');//->whereOr('intro','like','%'.$search.'%')
        $this->assign('sortid',cookie('pro_sortid'));//给前端返回搜索的分类id
        $this->assign('stateid',cookie('pro_stateid'));//给前端返回搜索的状态id
        $this->assign('sortList',$sort);//分类列表
        $this->assign('stateList',$state);//状态列表
        $this->assign('pronum',$pronum);
        $this->assign('pro',$pro);
        return $this->fetch();
    }

    //项目详情（页面）
    public function prodetails(){
        //项目id
        $proid=input('?get.proid')?input('get.proid'):"";
        //获取项目信息
        $pro=db('project')->where('projectid',$proid)->find() ;
        //获取项目评论数
        $commentnum=db('comments')->where(['projectid'=>$proid,'commentto'=>0])->count('projectid');
        //项目发起人信息
        $username=db('user')->where('userid',$pro['userid'])->column('username,username');
        $headimg=db('user')->where('userid',$pro['userid'])->column('headimg,headimg');
        //项目详情
        $prodetails=db('prodetails')->where('projectid',$proid)->select() ;
        $this->assign("username",$username[0]);//发起人姓名
        $this->assign('headimg',$headimg[0]);//发起人头像
        $this->assign('commentnum',$commentnum);//项目评论数
        $this->assign("pro",$pro);//项目信息
        $this->assign("proList",$prodetails);//项目详情
        return $this->fetch();
    }

    /*public function prodetails_progress(){
        return $this->fetch();
    }*/

    //关注项目
    public function proFocus(){
        $proid=input('?post.proid')?input('post.proid'):"";//关注的项目id
        $userid=session('zc_user')[0]['userid'];//当前登录用户的id
        $now_time = date('Y-m-d H:i:s',time());//当前时间
        $condition=[
            'projectid'=>$proid,
            'userid'=>$userid
        ];
        if(!session('zc_user')){
            //未登录
            $reMsg=[
                'code'=>00000,
                'msg'=>config('Msg')['nologin']['nologin'],
                'data'=>[]
            ];
            return json($reMsg);
        }
        //查看关注表，用户是否关注过该项目
        $res=db('focuspro')->where($condition)->select();
        if(!empty($res)){
            //已关注
            $reMsg=[
                'code'=>40003,
                'msg'=>config('Msg')['focus']['already'],
                'data'=>[]
            ];
            return json($reMsg);
        }else{
            $condition['focustime']=$now_time;
            $res=db('focuspro')->insert($condition);
            if($res){
                //关注成功
                $reMsg=[
                    'code'=>40001,
                    'msg'=>config('Msg')['focus']['success'],
                    'data'=>[]
                ];
                return json($reMsg);
            }else{
                //关注失败
                $reMsg=[
                    'code'=>40002,
                    'msg'=>config('Msg')['focus']['error'],
                    'data'=>[]
                ];
                return json($reMsg);
            }
        }
    }

    //项目评论（页面）
    public function showComment(){
        $proid=input('?get.proid')?input('get.proid'):"";//项目id
        $pageParam['query']['proid'] = $proid;
        //$data=db('comments')->where('projectid',$proid)->select();
        //多表查询
        $data=Db::table('zc_comments')
            ->alias('a')
            ->join('zc_user b','a.userid = b.userid')
            ->where('a.projectid',$proid)
            ->order('a.ctime','desc')
            ->field('a.*,b.userid,b.username,b.headimg')
            ->select();
            //->paginate(4,false,$pageParam);
        $this->assign('comments',$data);
        $this->assign('proid',$proid);
        return $this->fetch('prodetails_comment');
    }

    //评论
    public function comToPro(){
        $proid=input('?post.proid')?input('post.proid'):"";//被评论的项目id
        $content=input('?post.content')?input('post.content'):"";//评论内容
        $commentto=input('?post.commentto')?input('post.commentto'):0;//回复/评论->0
        $userid=session('zc_user')[0]['userid'];//发表评论的用户的id
        $now_time = date('Y-m-d H:i:s',time());//当前时间
        $condition=['projectid'=>$proid,'userid'=>$userid];
        //未登录
        if(!session('zc_user')){
            //未登录
            $reMsg=[
                'code'=>00000,
                'msg'=>config('Msg')['nologin']['nologin'],
                'data'=>[]
            ];
            return json($reMsg);
        }
        //评论内容为空
        if(!$content){
            $reMsg=[
                'code'=>30004,
                'msg'=>config('Msg')['comment']['null'],
                'data'=>[]
            ];
            return json($reMsg);
        }
        //查看用户订单表，用户是否支持过该项目
        $res1=db('orders')->where($condition)->select();
        //判断当前用户是否为项目发起人
        $res2=db('project')->where($condition)->count('projectid');
        //var_dump($res2);exit;
        if(empty($res1)&&$res2==0){
            //未支持项目
            $reMsg=[
                'code'=>30003,
                'msg'=>config('Msg')['comment']['notAllow'],
                'data'=>[]
            ];
            return json($reMsg);
        }else{
            $condition=[
                'projectid'=>$proid,
                'userid'=>$userid,
                'ctime'=>$now_time,
                'content'=>$content,
                'commentto'=>$commentto
            ];
            //将评论内容插入数据库
            $res=db('comments')->insert($condition);
            if($res){
                //评论成功
                $reMsg=[
                    'code'=>30001,
                    'msg'=>config('Msg')['comment']['success'],
                    'data'=>[]
                ];
                return json($reMsg);
            }else{
                //评论失败
                $reMsg=[
                    'code'=>30002,
                    'msg'=>config('Msg')['comment']['commentFail'],
                    'data'=>[]
                ];
                return json($reMsg);
            }
        }
    }
}