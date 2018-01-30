<?php
namespace app\admin\controller;

//use \think\View;
use \think\Controller;
use \think\Request;
class Controll extends Controller
{
    public function welcome(){
        return $this->fetch('welcome');
    }

    public function toIframe($htmlName){
        return $this->fetch($htmlName);
    }

}