<?php
namespace app\publishpro\controller;
use think\Controller;
class Publishpro extends Controller
{
    public function jumpToProBaseMsg()
    {
        return $this->fetch('proBaseMsg');
    }

    public function jumpToAddReturn(){
        return $this->fetch('addReturn');
    }
}
