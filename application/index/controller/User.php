<?php
namespace app\index\controller;
//use \think\View;
use \think\Controller;
class User extends  Controller
{
    public function personal()
    {
//        return view('hello');
        return $this->fetch('personalView');
    }
    public function settings()
    {
//        return view('hello');
        return $this->fetch('settingsView');
    }
}

