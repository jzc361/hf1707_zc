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
class Chat extends Controller
{
    public function toIframe($htmlName){
        $empInfo=session('adminEmp');
        //var_dump($adminEmp);exit();
        $this->assign('empInfo',json_encode($empInfo));
        return $this->fetch($htmlName);
    }
}