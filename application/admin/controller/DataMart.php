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
use \think\Db;
use think\Paginator;
class DataMart extends Controller
{

    public function toIframe($htmlName){
        return $this->fetch($htmlName);
    }


    //获取众筹类型页面初始化数据

    public function getZcType(){

        //获取查询条件(年份/类型)
        $year = isset($_POST['year'])?$_POST['year']:date('Y');
        $type = isset($_POST['type'])?$_POST['type']:"普通众筹";

        //拼接年份通配
        $year = $year.'%';

        //查询类别ID,类别名称,统计数量(cun),开始时间,项目类型
        $allSort = db::query('SELECT
                a.sortid,
                a.sortname,
                COUNT(b.sortid) cun,
                b.begintime,
                b.projecttype
            FROM
                zc_sort a

            LEFT JOIN (
                SELECT
                    sortid,
                    begintime,
                    projecttype
                FROM
                    zc_project
                WHERE
                    begintime LIKE ? and projecttype=?
            ) b ON a.sortid = b.sortid

            GROUP BY a.sortid

        ',[$year,$type]);
//
        $res = [
            'code'=>20008,
            'msg'=>config('msg')['oper']['selectFail'],
            'data'=>$allSort
        ];
        //查询成功--
        if(count($allSort)>0){
            $res = [
                'code'=>20007,
                'msg'=>config('msg')['oper']['select'],
                'data'=>$allSort
            ];
        }
        return $res;

    }
    //获取所有众筹状态数据相关年份
    public function zcYeras(){
        $yearData = db('project')
            ->field('MIN(begintime) as begin')  //,MAX(endtime) as end
            ->select();
        $begin = $yearData[0]['begin'];
        //$end = $yearData[0]['end'];

        $begin = substr($begin,0,4);
        //$end = substr($end,0,4);
        $res = [
            'code'=>20008,
            'msg'=>config('msg')['oper']['selectFail'],
            'data'=>''
        ];

        if(count($yearData)>0){
            $allyear = [];
            $statrNo = 0;
            for($i=date('Y');$i>=$begin;$i--){

                $allyear[$statrNo]['year'] = $i;
                $statrNo++;
            }
            $res['code']=20007;
            $res['msg']=config('msg')['oper']['select'];
            $res['data']=$allyear;
        }
        return $res;
    }

}