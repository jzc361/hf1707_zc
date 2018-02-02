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

class Project extends Auth
{
    //产品项目（更多众筹）
    public function proindex(){
        $this->updateProState();//更新商品状态
        //Session::set('current','proindex');//当前所在页面
        cookie( null,'pro_');//清空前缀为pro_的cookie
        $condition=[];
        $condition['projecttype']='普通众筹';
        $or=[];
        $ord="";
        $ordertype="";
        $sortid=input('?get.sortid')?input('get.sortid'):"";//分类id
        $stateid=input('?get.stateid')?input('get.stateid'):"";//状态id
        //$statename=input('?get.staname')?input('get.staname'):"";
        $order=input('?get.order')?input('get.order'):"";
        $search=input('?get.search')?input('get.search'):"";//搜索
        //echo $search;
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
        if($search!=""){
            cookie('pro_search',$search,3600);//将查询的条件存入cookie
            $condition["projectname"]=['like','%'.$search.'%'];
            $pageParam['query']['search'] = $search;
            $or["intro"]=['like','%'.$search.'%'];
        }
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
        $pro=db('project')->where($condition)->where($stateType)->order($ord,$ordertype)->paginate(4, false, $pageParam);//->whereOr($or)
        //var_dump($pro);exit;
        $pronum=db('project')->where($condition)->where($stateType)->count('projectid');//->whereOr($or)
        $this->assign('sortid',cookie('pro_sortid'));//给前端返回搜索的分类id
        $this->assign('stateid',cookie('pro_stateid'));//给前端返回搜索的状态id
        $this->assign('search',cookie('pro_search'));
        $this->assign('sortList',$sort);//分类列表
        $this->assign('stateList',$state);//状态列表

        //$pronum=db('project')->count('projectid');
        //$pro=db('project')->select();
        //$this->assign('sortList',$sort);

        $this->assign('pronum',$pronum);
        $this->assign('pro',$pro);
        $this->assign('do',$this->do);
        return $this->fetch();
    }

    //限时众筹（列表）
    public function prolimit(){
        cookie( null,'limit_');//清空前缀为pro_的cookie
        //$limitstateid=$this->getlimitstateid('众筹中');
        $sortid=input('?get.sortid')?input('get.sortid'):"";//分类id
        $stateid=input('?get.stateid')?input('get.stateid'):"";//状态id
        $condition=[
            'projecttype'=>'限时众筹',
            //'a.limitstateid'=>$limitstateid
        ];
        //按项目分类搜索
        if($sortid!=""){
            cookie('limit_sortid',$sortid,3600);//将查询的分类id存入cookie
            $condition["sortid"]=$sortid;
            $pageParam['query']['sortid'] = $sortid;
        }
        //按项目状态搜索
        if($stateid!=""){
            cookie('limit_stateid',$stateid,3600);//将查询的项目状态id存入cookie
            $stateType="";
            $condition["a.limitstateid"]=$stateid;
            $pageParam['query']['stateid'] = $stateid;
        }
        //链表
        $join=[
            ['zc_prodetails b','a.projectid=b.projectid'],
            ['zc_limitstate c','a.limitstateid=c.limitstateid']
        ];
        //获取分类
        //$sort=db('sort')->select();
        //获取限时众筹状态
        $limitstate=db('limitstate')->select();
        //$pro=db('project')->where($condition)->paginate(4);//->whereOr($or)
        //获取限时众筹项目信息
        $pro=Db::table('zc_project')
            ->alias('a')
            ->join($join)
            ->where($condition)
            ->field('a.*,b.price,b.limitcount,c.*')
            ->paginate(4);
        //var_dump($pro);exit;
        $this->assign('pro',$pro);
<<<<<<< HEAD
        $this->assign('sortList',$sort);//分类列表
        $this->assign('do',$this->do);
=======
        $this->assign('sortid',cookie('limit_sortid'));//给前端返回搜索的分类id
        $this->assign('limitstateid',cookie('limit_stateid'));//给前端返回搜索的状态id
        $this->assign('sortList',$this->getsort());//分类列表
        $this->assign('limstaList',$limitstate);//状态列表
>>>>>>> 2f7ab36beb11a7e4334d342515dc189749f414b5
        return $this->fetch();
    }

    //项目详情（页面）
    public function prodetails(){
        //Session::set('current','proindex');
        //项目id
        $proid=input('?get.proid')?input('get.proid'):"";
        //获取项目信息
        $pro=db('project')->where('projectid',$proid)->find() ;
        //var_dump($pro);exit;
        //获取项目进度信息
        //$log=db('prolog')->where('projectid',$proid)->order('logtime','desc')->select();
        $log=Db::table('zc_prolog')
            ->alias('a')
            ->join('zc_user b','a.userid=b.userid')
            ->where('projectid',$proid)
            ->order('logtime','desc')
            ->field('a.*,b.userid,b.username')
            ->select();
        //var_dump($log);exit;
        //获取项目评论数
        $commentnum=db('comments')->where(['projectid'=>$proid,'commentto'=>0])->count('projectid');
        //项目详情
        $prodetails=db('prodetails')->where('projectid',$proid)->select() ;
        if($pro['projecttype']=='普通众筹'){
            //项目发起人信息
            $username=db('user')->where('userid',$pro['userid'])->column('username,username');
            $headimg=db('user')->where('userid',$pro['userid'])->column('headimg,headimg');
            $this->assign("username",$username[0]);//发起人姓名
            $this->assign('headimg',$headimg[0]);//发起人头像
        }
        //项目进度
        $this->assign('prolog',$log);
        $this->assign('commentnum',$commentnum);//项目评论数
        $this->assign("pro",$pro);//项目信息
        $this->assign("proList",$prodetails);//项目详情
        $this->assign('do',$this->do);
        return $this->fetch();
    }

    /*public function prodetails_progress(){
        return $this->fetch();
    }*/

    //关注项目
    public function proFocus(){
        if(!session('zc_user')){
            //未登录
            $reMsg=[
                'code'=>00000,
                'msg'=>config('Msg')['nologin']['nologin'],
                'data'=>[]
            ];
            return json($reMsg);
        }
        $proid=input('?post.proid')?input('post.proid'):"";//关注的项目id
        $userid=session('zc_user')['userid'];//当前登录用户的id
        //$userid=session('zc_user')[0]['userid'];//当前登录用户的id
        $now_time = date('Y-m-d H:i:s',time());//当前时间
        $condition=[
            'projectid'=>$proid,
            'userid'=>$userid
        ];
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
            //更新项目表中的关注人数字段
            $res1=db('project')->where('projectid',$proid)->setInc('focuscount');
            //数据插入关注表
            $res2=db('focuspro')->insert($condition);
            if($res1&&$res2){
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

    //评论信息
/*    public function getComment(){
        $proid=input('?get.proid')?input('get.proid'):"";//项目id
        $data=Db::table('zc_comments')
            ->alias('a')
            ->join('zc_user b','a.userid = b.userid')
            ->where('a.projectid',$proid)
            ->order('a.ctime','desc')
            ->field('a.*,b.userid,b.username,b.headimg')
            ->select();
        var_dump($data);
    }*/

    //评论
    public function comToPro(){
        $proid=input('?post.proid')?input('post.proid'):"";//被评论的项目id
        $content=input('?post.content')?input('post.content'):"";//评论内容
        $commentto=input('?post.commentto')?input('post.commentto'):0;//回复/评论->0
        $userid=session('zc_user')['userid'];//发表评论的用户的id
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

    //获取分类列表
    public function getsort(){
        $sort=db('sort')->select();
        return $sort;
    }

    //获取某普通众筹的状态id
    public function getstateid($statename){
        $stateid=Db::table('zc_state')
            ->where('statename',$statename)
            ->field('stateid')
            ->find();
        $stateid=$stateid['stateid'];
        return $stateid;
    }

    //获取限时众筹的状态id
    public function getlimitstateid($limitstatename){
        $limitstateid=db('limitstate')
            ->where('limitstatename',$limitstatename)
            ->field('limitstateid')
            ->find();
        $limitstateid=$limitstateid['limitstateid'];
        return $limitstateid;
    }
    //获取普通众筹筹集的总金额
    public function gettolamount($proid){
        $tolamount=db('project')->where('projectid',$proid)->field('tolamount')->find();
        $tolamount=$tolamount['tolamount'];
        return $tolamount;
    }
    //获取普通众筹当前筹集的金额
    public function getcuramount($proid){
        $curamount=db('project')->where('projectid',$proid)->field('curamount')->find();
        $curamount=$curamount['curamount'];
        //var_dump($curamount);
        return $curamount;
    }
    //实时更改项目状态
    public function updateProState(){
        $proList=db('project')->select();
        //var_dump($proList);exit;
        for($i=0;$i<count($proList);$i++)
        {
            //更改普通众筹的状态
            if($proList[$i]['projecttype']=='普通众筹'){
                $projectid=$proList[$i]['projectid'];//项目id
                //var_dump($projectid);
                if($proList[$i]['begintime']!=NULL){
//                var_dump($proList[$i]['begintime']);
//                var_dump($proList[$i]['endtime']);
                    $begintimeStamp=strtotime($proList[$i]['begintime']);//开始时间
                    $endtimeStamp=strtotime($proList[$i]['endtime']);//结束时间
                    $tolamount=$this->gettolamount($projectid);//众筹总金额
                    $curamount=$this->getcuramount($projectid);//当前众筹金额
                    $stateid=$proList[$i]['stateid'];//状态id
//                var_dump($begintimeStamp);
//                var_dump($endtimeStamp);
                    //->众筹中     --时间范围内，当前金额小于总金额
                    if(time()>$begintimeStamp && time()< $endtimeStamp && $tolamount>$curamount){
                        //获取状态名为众筹中的stateid
                        $stateid=$this->getstateid('众筹中');
                        //var_dump($stateid) ;exit();
                        if($stateid!=null){
                            //把项目状态改成众筹中
                            //$projectid= $proList[$i]['projectid'];
                            $res=db('project')->where('projectid',$projectid)->update(['stateid'=>$stateid]);
                            //var_dump($res);
                        }
//                    var_dump($stateid) ;
                    } //->众筹失败      --超过结束时间且仍在众筹中的项目
                    else if(time()>$endtimeStamp&&$this->getstateid('众筹中')==$stateid){
                        //获取状态名为众筹失败的stateid
                        $stateid=$this->getstateid('众筹失败');
                        //var_dump($projectid);
                        //把项目状态改成众筹失败
                        $res=db('project')->where('projectid',$projectid)->update(['stateid'=>$stateid]);
                        //var_dump($res);
                    }//->众筹成功       --状态为众筹中，且当前金额大于总金额
                    else if($tolamount<=$curamount&&$this->getstateid('众筹中')==$stateid){
                        //获取状态名为众筹成功的stateid
                        $stateid=$this->getstateid('众筹成功');
                        //把项目状态改成众筹成功
                        $res=db('project')->where('projectid',$projectid)->update(['stateid'=>$stateid]);
                        //var_dump($res);
                    }
                }
            }
            //更改限时众筹的状态
           /* else if($proList[$i]['projecttype']=='限时众筹'){
                if($proList[$i]['begintime']!=NULL){
                    $begintimeStamp=strtotime($proList[$i]['begintime']);
                    $endtimeStamp=strtotime($proList[$i]['endtime']);
                    //众筹中
                    if(time()>$begintimeStamp && time()< $endtimeStamp){
                        //获取状态名为众筹中的stateid
                        $stateid=$this->getlimitstateid('众筹中');
                        // var_dump($stateid) ;exit();
                        if($stateid!=null){
                            //把项目状态改成众筹中
                            $projectid= $proList[$i]['projectid'];
                            Db::table('zc_project')->where('projectid',$projectid)->setField('limitstateid', $stateid);
                        }
                    }
                    //未开始
                    else if(time()<$begintimeStamp){
                        $stateid=$this->getlimitstateid('未开始');
                        if($stateid!=null){
                            $projectid= $proList[$i]['projectid'];
                            Db::table('zc_project')->where('projectid',$projectid)->setField('limitstateid', $stateid);
                        }
                    }
                    //已结束
                    else if(time()> $endtimeStamp){
                        $stateid=$this->getlimitstateid('已结束');
                        if($stateid!=null){
                            $projectid= $proList[$i]['projectid'];
                            Db::table('zc_project')->where('projectid',$projectid)->setField('limitstateid', $stateid);
                        }
                    }
                }
            }*/
        }
    }
}