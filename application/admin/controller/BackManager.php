<?php
namespace app\admin\controller;

//use \think\View;
use \think\Controller;
use \think\Request;
class BackManager extends Controller
{

    public function toIframe($htmlName){
        return $this->fetch($htmlName);
    }
}