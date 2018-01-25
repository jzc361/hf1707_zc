<?php
namespace app\publishpro\controller;
use think\Controller;
use think\Db;
class Publishpro extends Controller
{
    //跳转到众筹发布页
    public function jumpToProBaseMsg()
    {
        //获取项目分类
        $proSort=Db::table('zc_sort')->select();
        var_dump($proSort);
        echo "22";
        return $this->fetch('proBaseMsg');
    }
    //跳转到回报详情页
    public function jumpToAddReturn(){
        return $this->fetch('addReturn');
    }
}
