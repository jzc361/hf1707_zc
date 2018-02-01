<?php
namespace app\admin\controller;

//use \think\View;
use \think\Controller;
use \think\Db;
use \think\Request;
use \think\Paginator;
use think\Session;
use \think\File;
use \think\Config;

class Promanage extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    //显示项目列表
    public function index()
    {
         $this->updateProState();
//        session('sortid', null);
//        session('stateid', null);
//        session('keyword', null);
        $keyword=input('?get.keyword')?input('get.keyword'):'';
        session('keyword',$keyword);
        $this->assign('keyword',$keyword);
        //var_dump($keyword) ;exit();
        //显示某分类
        if(input('?get.sortid') && !input('?get.stateid')){
            session('stateid', null);
            $selectsortid=input('get.sortid');
            $allProList=Db::table('zc_project')
                ->alias('a')
                ->join('zc_sort b','a.sortid=b.sortid')
                ->join('zc_state c','a.stateid=c.stateid')
                ->join('zc_user d','a.userid=d.userid')
                ->where('a.projecttype','普通众筹')
                ->where('a.sortid',$selectsortid)
                ->where('a.projectname','like','%'.$keyword.'%')
                ->order('createtime', 'desc')->paginate(3,false,$config = ['query'=>array('sortid'=>$selectsortid,
                                                                                               'keyword'=>$keyword)]);
                $this->assign('selectsortid',$selectsortid);
                session('selectsortid',$selectsortid);
        }
        //显示某状态
        else if(input('?get.stateid') && !input('?get.sortid')){
            session('selectsortid', null);
            $stateid=input('get.stateid');
//            var_dump($state);exit();
            $allProList=Db::table('zc_project')
                ->alias('a')
                ->join('zc_sort b','a.sortid=b.sortid')
                ->join('zc_state c','a.stateid=c.stateid')
                ->join('zc_user d','a.userid=d.userid')
                ->where('a.projecttype','普通众筹')
                ->where('a.stateid',$stateid)
                ->where('a.projectname','like','%'.$keyword.'%')
                ->order('createtime', 'desc')->paginate(3,false,$config = ['query'=>array('stateid'=>$stateid,'keyword'=>$keyword)]);
                $this->assign('stateid',$stateid);
                session('stateid',$stateid);
        }
        //显示某分类加某状态
        else if(input('?get.sortid') && input('?get.stateid')){
            $selectsortid=input('get.sortid');
            $stateid=input('get.stateid');
            //echo $selectsortid,$state;exit();
            $where=[
                'a.sortid'=>$selectsortid,
                'a.stateid'=>$stateid,
            ];
            $allProList=Db::table('zc_project')
                ->alias('a')
                ->join('zc_sort b','a.sortid=b.sortid')
                ->join('zc_state c','a.stateid=c.stateid')
                ->join('zc_user d','a.userid=d.userid')
                ->where('a.projecttype','普通众筹')
                ->where($where)
                ->where('a.projectname','like','%'.$keyword.'%')
                ->order('createtime', 'desc')->paginate(3,false,$config = ['query'=>array('sortid'=>$selectsortid,'stateid'=>$stateid,'keyword'=>$keyword)]);
            $this->assign('selectsortid',$selectsortid);
            session('selectsortid',$selectsortid);
            $this->assign('stateid',$stateid);
            session('stateid',$stateid);
        }
        else{
            session('selectsortid', null);
            session('stateid', null);
            //获取所有项目
            $allProList=Db::table('zc_project')
                ->alias('a')
                ->join('zc_sort b','a.sortid=b.sortid')
                ->join('zc_state c','a.stateid=c.stateid')
                ->join('zc_user d','a.userid=d.userid')
                ->where('a.projecttype','普通众筹')
                ->where('a.projectname','like','%'.$keyword.'%')
                ->order('createtime', 'desc')->paginate(3,false,$config = ['query'=>array('keyword'=>$keyword)]);
        }
        $this->assign('allProList',$allProList);
        //获取项目分类
        $proSort=Db::table('zc_sort')->select();
        $this->assign('proSort',$proSort);
        //获取项目状态
        $stateList=Db::table('zc_state')->select();
        $this->assign('stateList',$stateList);
//        var_dump($allProList);exit();
        return $this->fetch('allProView');
    }
    //显示项目详情
    public function showDetails(){
        $projectid=input('get.id');
        //echo $projectid;
        $promsg=Db::table('zc_project')
            ->alias('a')
            ->join('zc_state c','a.stateid=c.stateid')
            ->join('zc_user d','a.userid=d.userid')
            ->where('projectid',$projectid)
            ->select();
//        $promsg=Db::name('project')->where('projectid',$projectid)->select();
        $returnmsg=Db::name('prodetails')->where('projectid',$projectid)->select();
       // echo "<pre>";
      //  var_dump($promsg);exit();
       // var_dump($returnmsg);exit();
        $this->assign([
            'promsg'=>$promsg,
            'returnmsg'=>$returnmsg
        ]);
        return $this->fetch('proDetails');
    }
    //通过审核
    public function proPass(){
        $projectid=input('?post.projectid')?input('post.projectid'):'';
        if(!empty($projectid)){
            //更改项目状态
            $res=Db::table('zc_project')
                ->where('projectid',$projectid)->setField('stateid',3);
            if($res){
                //更改成功
                $msgResp=[
                    'code'=>20005, //更新成功
                    'msg'=>config('msg')['oper']['update'],
                    'data'=>[]
                ];
            }
            else{
                //更改失败
                $msgResp=[
                    'code'=>20006, //更新失败
                    'msg'=>config('msg')['oper']['updateFail'],
                    'data'=>[]
                ];
            }
            //return json($msgResp);
        }
        else{
            //更改失败
            $msgResp=[
                'code'=>20006, //更新失败
                'msg'=>config('msg')['oper']['updateFail'],
                'data'=>[]
            ];
        }
        return json($msgResp);
       // echo $projectid;exit();
    }
    //不通过审核
    public function proDispass(){
        $projectid=input('?post.projectid')?input('post.projectid'):'';
        $failreason=input('?post.failreason')?input('post.failreason'):'';
        if(!empty($projectid)){
            //更改项目状态为审核失败
            $stateid=$this->getstateid('审核失败');
            $res=Db::table('zc_project')
                ->where('projectid',$projectid)
                ->update(['stateid'=> $stateid,'failreason'=>$failreason]);
               // setField('stateid',4);
            if($res){
                //更改成功
                $msgResp=[
                    'code'=>20005, //更新成功
                    'msg'=>config('msg')['oper']['update'],
                    'data'=>[]
                ];
            }
            else{
                //更改失败
                $msgResp=[
                    'code'=>20006, //更新失败
                    'msg'=>config('msg')['oper']['updateFail'],
                    'data'=>[]
                ];
            }
            //return json($msgResp);
        }
        else{
            //更改失败
            $msgResp=[
                'code'=>20006, //更新失败
                'msg'=>config('msg')['oper']['updateFail'],
                'data'=>[]
            ];
        }
        return json($msgResp);
        // echo $projectid;exit();
    }
    //发布限时众筹页面
    public function publishLimitPro(){
        $proSort=Db::table('zc_sort')->select();
        $this->assign('proSortList',$proSort);
        return $this->fetch("publishLimitPro");
    }
    //提交限时众筹项目
    public function submitLimitPro(){
        //上传预览图
        $file = request()->file('imgFile');
        $proMsg=input('post.');
        if($proMsg['selectVal']==1){ //马上开始众筹
            $proMsg['starttime']=date("Y-m-d H:i:s",time());
            //获取众筹中的id
            $stateid=$this->getlimitstateid('众筹中');
            //var_dump($stateid);exit();
        }
        else{
            //获取未开始的id
            $stateid=$this->getlimitstateid('未开始');
            //var_dump($stateid);exit();
        }
       // var_dump($file);
       // var_dump($proMsg);
        if($file){
            $path = ROOT_PATH . 'public/static/img/home/project';
            $info = $file->move($path);
            if($info){
                // 成功上传后 获取上传信息
                $imgPath=$info->getSaveName();
                //插入数据
                //插入众筹项目表
                $data = [
                    'projectname' =>$proMsg['proTitle'],
                    'intro' =>$proMsg['proDetails'],
                    'projectimg' =>'__STATIC__/img/home/project/'.$imgPath,
                    'limitstateid' =>$stateid,
                    'sortid' =>$proMsg['proSort'],
                    'createtime'=>date("Y-m-d H:i:s",time()),
                    'begintime'=>$proMsg['starttime'],
                    'endtime'=>$proMsg['endtime'],
                    'projecttype'=>'限时众筹',
                ];
                $maxProId=Db::name('project')->insertGetId($data);
                //回报众筹
                $returnData=[
                    'projectid'=>$maxProId,
                    'price'=>$proMsg['tolprice'],
                    'limitcount'=>$proMsg['totalpart'],
                ];
                $res=Db::name('prodetails')->insertGetId($returnData);
                // var_dump($data);exit();

            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
        //dump(Config::get());exit();
        $msgResp=[
            'code'=>20009, //发布成功，等待审核
            'msg'=>config('msg')['publishPro']['publish'],
            'data'=>[]
        ];
        return json($msgResp);
    }
    //限时众筹显示
    public function limitProView(){
        $this->updateProState();
        $keyword=input('?get.akeyword')?input('get.akeyword'):'';
        session('akeyword',$keyword);
        $this->assign('akeyword',$keyword);
        //var_dump($keyword) ;exit();
        //显示某分类
        if(input('?get.asortid') && !input('?get.astateid')){
            session('astateid', null);
            $selectsortid=input('get.asortid');
            $allProList=Db::table('zc_project')
                ->alias('a')
                ->join('zc_sort b','a.sortid=b.sortid')
                ->join('zc_limitstate c','a.limitstateid=c.limitstateid')
                ->join('zc_prodetails d','a.projectid=d.projectid')
                ->where('a.projecttype','限时众筹')
                ->where('a.sortid',$selectsortid)
                ->where('a.projectname','like','%'.$keyword.'%')
                ->order('createtime', 'desc')->paginate(3,false,$config = ['query'=>array('asortid'=>$selectsortid,
                    'akeyword'=>$keyword)]);
            $this->assign('aselectsortid',$selectsortid);
            session('aselectsortid',$selectsortid);
        }
        //显示某状态
        else if(input('?get.astateid') && !input('?get.asortid')){
            session('aselectsortid', null);
            $stateid=input('get.astateid');
//            var_dump($state);exit();
            $allProList=Db::table('zc_project')
                ->alias('a')
                ->join('zc_sort b','a.sortid=b.sortid')
                ->join('zc_limitstate c','a.limitstateid=c.limitstateid')
                ->join('zc_prodetails d','a.projectid=d.projectid')
                ->where('a.projecttype','限时众筹')
                ->where('a.limitstateid',$stateid)
                ->where('a.projectname','like','%'.$keyword.'%')
                ->order('createtime', 'desc')->paginate(3,false,$config = ['query'=>array('astateid'=>$stateid,'akeyword'=>$keyword)]);
            $this->assign('astateid',$stateid);
            session('astateid',$stateid);
        }
        //显示某分类加某状态
        else if(input('?get.asortid') && input('?get.astateid')){
            $selectsortid=input('get.asortid');
            $stateid=input('get.astateid');
            //echo $selectsortid,$state;exit();
            $where=[
                'a.sortid'=>$selectsortid,
                'a.limitstateid'=>$stateid,
            ];
            $allProList=Db::table('zc_project')
                ->alias('a')
                ->join('zc_sort b','a.sortid=b.sortid')
                ->join('zc_limitstate c','a.limitstateid=c.limitstateid')
                ->join('zc_prodetails d','a.projectid=d.projectid')
                ->where('a.projecttype','限时众筹')
                ->where($where)
                ->where('a.projectname','like','%'.$keyword.'%')
                ->order('createtime', 'desc')->paginate(3,false,$config = ['query'=>array('asortid'=>$selectsortid,'astateid'=>$stateid,'akeyword'=>$keyword)]);
            $this->assign('aselectsortid',$selectsortid);
            session('aselectsortid',$selectsortid);
            $this->assign('astateid',$stateid);
            session('astateid',$stateid);
        }
        else{
            session('aselectsortid', null);
            session('astateid', null);
            //获取所有项目
            $allProList=Db::table('zc_project')
                ->alias('a')
                ->join('zc_sort b','a.sortid=b.sortid')
                ->join('zc_limitstate c','a.limitstateid=c.limitstateid')
                ->join('zc_prodetails d','a.projectid=d.projectid')
                ->where('a.projecttype','限时众筹')
                ->where('a.projectname','like','%'.$keyword.'%')
                ->order('createtime', 'desc')->paginate(3,false,$config = ['query'=>array('akeyword'=>$keyword)]);
        }
        $this->assign('allProList',$allProList);
        //获取项目分类
        $proSort=Db::table('zc_sort')->select();
        $this->assign('proSort',$proSort);
        //获取项目状态
        $stateList=Db::table('zc_limitstate')->select();
        $this->assign('stateList',$stateList);
        return $this->fetch("allLimitProView");
    }
    //显示限时众筹详情
    public function limitProDetails(){
        $projectid=input('get.id');
       // echo $projectid;
        $promsg=Db::table('zc_project')
            ->alias('a')
            ->join('zc_sort b','a.sortid=b.sortid')
            ->join('zc_limitstate c','a.limitstateid=c.limitstateid')
            ->join('zc_prodetails d','a.projectid=d.projectid')
            ->where('a.projecttype','限时众筹')
            ->where('a.projectid',$projectid)->select();
        $this->assign('promsg',$promsg);
        return $this->fetch("limitProDetails");
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
    //获取某限时众筹的状态id
    public function getlimitstateid($statename){
        $stateid=Db::table('zc_limitstate')
            ->where('limitstatename',$statename)
            ->field('limitstateid')
            ->find();
        $stateid=$stateid['limitstateid'];
        return $stateid;
    }
    //实时更改项目状态
    public function updateProState(){
        $proList=Db::table('zc_project')->select();
        //var_dump($proList);
        for($i=0;$i<count($proList);$i++)
        {
            //更改普通众筹的状态
            if($proList[$i]['projecttype']=='普通众筹'){
                if($proList[$i]['begintime']!=NULL){
//                var_dump($proList[$i]['begintime']);
//                var_dump($proList[$i]['endtime']);
                    $begintimeStamp=strtotime($proList[$i]['begintime']);
                    $endtimeStamp=strtotime($proList[$i]['endtime']);
//                var_dump($begintimeStamp);
//                var_dump($endtimeStamp);
                    //众筹中
                    if(time()>$begintimeStamp && time()< $endtimeStamp){
                        //获取状态名为众筹中的stateid
                        $stateid=$this->getstateid('众筹中');
                       // var_dump($stateid) ;exit();
                        if($stateid!=null){
                            //把项目状态改成众筹中
                            $projectid= $proList[$i]['projectid'];
                            Db::table('zc_project')->where('projectid',$projectid)->setField('stateid', $stateid);
                        }
//                    var_dump($stateid) ;
                    }
                }
            }
            //更改限时众筹的状态
            else if($proList[$i]['projecttype']=='限时众筹'){
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
            }
        }
    }



}
