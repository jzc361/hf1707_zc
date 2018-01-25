<?php
namespace app\home\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
class Publishpro extends Controller
{
//    public function __construct(Request $request)
//    {
//        parent::__construct($request);
//    }

    //跳转到众筹发布页
    public function jumpToProBaseMsg()
    {
        //获取项目分类
        $proSort=Db::table('zc_sort')->select();
        //var_dump($proSort);
        // echo "22";
        $this->assign('proSortList',$proSort);
        //判断是否是回报页面点回来的
        if(isset($_GET['isReturn'])){
            //echo Session::has('proMsg');
            if(Session::has('proMsg')){
                //echo "shi";
                $proMsg=Session::get('proMsg');
                $this->assign([
                    'proTitle'  => $proMsg['proTitle'],
                    'daysNumber'  => $proMsg['daysNumber'],
                    'tolamount'  => $proMsg['tolamount'],
                    'proSort'  => $proMsg['proSort'],
                    'probrief'  => $proMsg['probrief']
                ]);

//                $proMsgStr=json_encode($proMsg);
//                $this->assign('proMsgStr',$proMsgStr);
            }
        }
        return $this->fetch('proBaseMsg');
    }
    //点击下一步，保存项目信息
    public function saveProMsg(){
        $imgFile=$_FILES['imgFile'];
        //var_dump($imgFile);
        //var_dump($_POST);
        Session::set('proMsg',$_POST);
        Session::set('proImg',$imgFile);
        $msgResp=[
            'code'=>20004, //添加成功
            'msg'=>config('msg')['oper']['add'],
            'data'=>[]
        ];
        return json($msgResp);
        //return $this->fetch('addReturn');
    }
    //跳转到回报详情页
    public function jumpToAddReturn(){
        $proMsg=Session::get('proMsg');
       // var_dump($proMsg);
        $this->assign('proTitle',$proMsg['proTitle']);
        return $this->fetch('addReturn');
    }

}
