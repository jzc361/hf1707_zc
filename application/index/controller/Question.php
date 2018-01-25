<?php
namespace app\index\controller;
//use \think\View;
use \think\Controller;
class Question extends  Controller
{
    public function deleteWj()
    {
//        return view('hello');
        return $this->fetch('personalView');
    }

}

