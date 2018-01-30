<?php
namespace app\admin\controller;

//use \think\View;
use \think\Controller;
use \think\Request;
class FrontManager extends Controller
{

    public function toIframe($htmlName){
        return $this->fetch($htmlName);
    }

}