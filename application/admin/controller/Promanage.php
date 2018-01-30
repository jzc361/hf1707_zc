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

    //显示项目列表
    public function index()
    {
        //显示某分类
        if(input('?get.sortid') && !input('?get.state')){
            $selectsortid=input('get.sortid');
            $allProList=Db::table('zc_project')
                ->alias('a')
                ->join('zc_sort b','a.sortid=b.sortid')
                ->where('a.sortid',$selectsortid)
                ->order('createtime', 'desc')->paginate(2,false,$config = ['query'=>array('sortid'=>$selectsortid)]);
                $this->assign('selectsortid',$selectsortid);
        }
        //显示某状态
        else if(input('?get.state') && !input('?get.sortid')){
            $state=input('get.state');
            $allProList=Db::table('zc_project')
                ->alias('a')
                ->join('zc_sort b','a.sortid=b.sortid')
                ->where('a.statename',$state)
                ->order('createtime', 'desc')->paginate(2,false,$config = ['query'=>array('state'=>$state)]);
//            $this->assign('selectsortid',$selectsortid);
        }
        //显示某分类加某状态
        else if(input('?get.sortid') && input('?get.state')){
            $selectsortid=input('get.sortid');
            $state=input('get.state');
            $where=[
                'a.sortid'=>$selectsortid,
                'a.statename'=>$state,
            ];
            $allProList=Db::table('zc_project')
                ->alias('a')
                ->join('zc_sort b','a.sortid=b.sortid')
                ->where($where)
                ->order('createtime', 'desc')->paginate(2,false,$config = ['query'=>array('sortid'=>$selectsortid)]);
            $this->assign('selectsortid',$selectsortid);
        }
        else{
            //获取所有项目
            $allProList=Db::table('zc_project')
                ->alias('a')
                ->join('zc_sort b','a.sortid=b.sortid')
                ->order('createtime', 'desc')->paginate(3);
        }
        $this->assign('allProList',$allProList);
        //获取项目分类
        $proSort=Db::table('zc_sort')->select();
        $this->assign('proSort',$proSort);
        //获取项目状态
        $result = Db::query('show columns from zc_project like "statename"');
       // var_dump($result);
        $enum=$result[0]['Type'];
        $enum=str_replace("'", '', $enum); //去掉单引号（将单引号改成空）
        //echo $enum."<br>";
        $enum_arr=explode("(",$enum);
        $enum=$enum_arr[1];
        $enum_arr=explode(")",$enum);
        $enum=$enum_arr[0];
        $enum_arr=explode(",",$enum);

        $this->assign('stateList',$enum_arr);
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
