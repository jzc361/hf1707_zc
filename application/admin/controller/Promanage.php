<?php
namespace app\admin\controller;

//use \think\View;
use \think\Controller;
use \think\Db;
use \think\Request;
use \think\Paginator;
class Promanage extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    //显示全部项目
    public function index()
    {
        //获取所有项目
        if(isset($_GET['sortid'])){
            echo "1111";
            //echo input('get.sortid');
            exit();
        }
        $allProList=Db::table('zc_project')
            ->alias('a')
            ->join('zc_sort b','a.sortid=b.sortid')
            ->order('createtime', 'desc')->paginate(3);
        //获取项目分类
        $proSort=Db::table('zc_sort')->select();
        $this->assign('allProList',$allProList);
        $this->assign('proSort',$proSort);
//        var_dump($allProList);exit();
        return $this->fetch('allProView');
    }
    //显示项目详情
    public function showDetails(){
        $projectid=input('get.id');
        //echo $projectid;
        $promsg=Db::name('project')->where('projectid',$projectid)->select();
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
}
