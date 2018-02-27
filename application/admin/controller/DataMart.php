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
        //获取页面初始化数据
        //当前时间(年)
        $nowtime = time();
        $year =  date('Y', $nowtime);

        //查询数据
        $getData = db('project')
            ->field('b.statename,a.begintime,a.endtime,a.projecttype')
            ->alias('a')
            ->join('state b','a.stateid=b.stateid')
            ->where('a.begintime','like',$year.'%')
            ->select();

        $res = [
            'code'=>20008,
            'msg'=>config('msg')['oper']['selectFail'],
            'data'=>$getData
        ];
        //查询成功--
        if(count($getData)>0){
            $res = [
                'code'=>20007,
                'msg'=>config('msg')['oper']['select'],
                'data'=>$getData
            ];
        }
        return $res;
    }

    //获取所有众筹状态数据相关年份
    public function zcYeras(){
        $yearData = db('project')
            ->field('MIN(begintime) as begin,MAX(endtime) as end')
            ->select();
        $begin = $yearData[0]['begin'];
        $end = $yearData[0]['end'];

        $begin = substr($begin,0,4);
        $end = substr($end,0,4);
        $res = [
            'code'=>20008,
            'msg'=>config('msg')['oper']['selectFail'],
            'data'=>""
        ];

        if(count($yearData)>0){
//            for($i=$begin;$i<=$end;$i++){
//                $res[0]['data'].=$i;
//            }
            $res['code']=20007;
            $res['msg']=config('msg')['oper']['select'];
        }

        var_dump($res);
        exit;
        $res = [
            'code'=>20008,
            'msg'=>config('msg')['oper']['selectFail'],
            'data'=>$yearData
        ];
        //查询成功--

        return $res;
    }

}