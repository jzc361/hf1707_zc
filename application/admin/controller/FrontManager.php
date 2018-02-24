<?php
namespace app\admin\controller;

//use \think\View;
use \think\Controller;
use \think\Request;
class FrontManager extends Controller
{

    public function toIframe($htmlName){
        $adList=db('ad')
            ->select();
        foreach($adList as &$val){
            if(strtotime($val['endtime'])<time()){//结束时间小于当前时间
                $state = '已过期';
            }else if(strtotime($val['starttime'])>time()){//开始时间大于当前时间
                $state = '未上架广告';
            }else{
                $state = '使用中';
            }
            $val['state'] = $state;
        }
        $this->assign('adList',$adList);
        return $this->fetch($htmlName);
    }
    public function adAdd(){

    }
    public function adEditData(){
        $editId = isset($_POST['editId'])?$_POST['editId']:"";
        $adList=db('ad')
            ->where('adid',$editId)
            ->select(); //获取有效期广告
        $res = [
          'code'=>1001,
            'msg'=>'查询成功',
            'data'=>$adList
        ];
        return $res;
    }

    public function adDelete(){

    }
}