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
}