<?php
namespace app\home\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use \think\File;
class Chatwithser extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    //聊天页面
    public function showChat(){
        return $this->fetch("chatView");
    }
}
