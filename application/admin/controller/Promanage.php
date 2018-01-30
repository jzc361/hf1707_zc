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
        if(!empty($projectid)){
            //更改项目状态
            $res=Db::table('zc_project')
                ->where('projectid',$projectid)->setField('stateid',4);
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
    public function limitProView(){
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
            $stateid=5;//众筹中
        }
        else{
            $stateid=3;//审核成功
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
                    'stateid' =>$stateid,
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
}
