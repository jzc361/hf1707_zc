<?php
namespace app\home\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use \think\File;
class Publishpro extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    //跳转到众筹发布页
    public function jumpToProBaseMsg()
    {
        //获取项目分类
        $proSort=Db::table('zc_sort')->select();
        $this->assign('proSortList',$proSort);
        //判断是否是回报页面点回来的
//        if(isset($_GET['isReturn'])){
//            //echo Session::has('proMsg');
//            if(Session::has('proMsg')){
//                //echo "shi";
//                $proMsg=Session::get('proMsg');
//                $this->assign([
//                    'proTitle'  => $proMsg['proTitle'],
//                    'daysNumber'  => $proMsg['daysNumber'],
//                    'tolamount'  => $proMsg['tolamount'],
//                    'proSort'  => $proMsg['proSort'],
//                    'probrief'  => $proMsg['probrief']
//                ]);
//
////                $proMsgStr=json_encode($proMsg);
////                $this->assign('proMsgStr',$proMsgStr);
//            }
//        }
        return $this->fetch('proBaseMsg');
    }
    //点击下一步，保存项目信息
    public function saveProMsg(){
        //上传预览图
        $file = request()->file('imgFile');
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $path = ROOT_PATH . 'public/static/img/home/project';
            $info = $file->move($path);
            if($info){
                // 成功上传后 获取上传信息
                $imgPath=$info->getSaveName();
                $promsg=input('post.');
                array_push($promsg,$imgPath);
                Session::set('proMsg',$promsg);
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
        //var_dump($imgFile);

       // Session::set('proImg',$imgFile);
        $msgResp=[
            'code'=>20004, //添加成功
            'msg'=>config('msg')['oper']['add'],
            'data'=>[]
        ];
        return json($msgResp);
    }
    //跳转到回报详情页
    public function jumpToAddReturn(){
        $proMsg=Session::get('proMsg');
        //var_dump($proMsg);
        $this->assign('proTitle',$proMsg['proTitle']);
        return $this->fetch('addReturn');
    }
    //保存回报数据
    public function saveReturnMsg(){
       // $imgFile=$_FILES['imgFile'];
        //上传回报图片
        $file = request()->file('imgFile');
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $path = ROOT_PATH .'public/static/img/home/project';
            $info = $file->move($path);
            if($info){
                // 成功上传后 获取上传信息
                $imgPath=$info->getSaveName();
                $return=input('post.');
                array_push($return,$imgPath);
                //如果存在returnMsg就追加，如果不存在就新建session
                if(Session::has('returnMsg')){
                    $returnMsg=Session::get('returnMsg');
                    array_push($returnMsg,$return);
                    Session::set('returnMsg',$returnMsg); //追加完重新定义
                }
                else{
                    Session::set('returnMsg',[$return]);
                }
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }

        //$returnMsg1=Session::get('returnMsg');
       // var_dump($returnMsg1);
        $msgResp=[
            'code'=>20004, //添加成功
            'msg'=>config('msg')['oper']['add'],
            'data'=>[]
        ];
        return json($msgResp);
    }
    //提交审核
    public function sumbitPro(){
        $proMsg=Session::get('proMsg'); // 项目基本信息
        $returnMsg=Session::get('returnMsg');//回报信息
       // Session::delete('proMsg');
        //Session::delete('returnMsg');
        //插入众筹项目表
        $data = [
            'projectname' =>$proMsg['proTitle'],
            'intro' =>$proMsg['proDetails'],
            'imgs' =>$proMsg[0],
            'tolamount' =>$proMsg['tolamount'],
            'statename' =>'审核中',
            'sortid' =>$proMsg['proSort']
           // 'userid' =>,
        ];
        $maxProId=Db::name('project')->insertGetId($data);
        Session::delete('proMsg');
        //插入回报表
        for($i=0;$i<count($returnMsg);$i++)
        {
            $returnData=[
                'projectid'=>$maxProId,
                'introduce'=>$returnMsg[$i]['returnDetails'],
                'imgs'=>$returnMsg[$i][0],
                'price'=>$returnMsg[$i]['price'],
                'limitcount'=>$returnMsg[$i]['limitpart'],
            ];
            $res=Db::name('prodetails')->insertGetId($returnData);
        }
        Session::delete('returnMsg');
        //var_dump($proMsg);
       // var_dump($returnMsg);
        $msgResp=[
            'code'=>20009, //发布成功，等待审核
            'msg'=>config('msg')['publishPro']['publish'],
            'data'=>[]
        ];
        return json($msgResp);
    }
}
