<?php
/**
 * Created by PhpStorm.
 * User: HD阳
 * Date: 2018/1/30
 * Time: 11:38
 */

namespace app\admin\controller;


use \think\Controller;
use \think\Request;
class DataMart extends Controller
{

    public function toIframe($htmlName){
        return $this->fetch($htmlName);
    }

    public function readyData(){
        $nowtime = time();
        $year =  date('Y', $nowtime);
        //project begintime endtime stateid projecttype
        //state stateid statename
        $where = [
            'a.begintime'=>2018
        ];
        $getData = db('project')
            ->alias('a')
            ->join('state','b','a.stateid=b.stateid')
            ->where('a.begintime','like',$year.'%')
            ->select();
        var_dump($getData);
        exit;
    }

}