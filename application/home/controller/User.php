<?php
namespace app\home\controller;
//use \think\View;
use \think\Controller;
use \think\Db;
use \think\Request;
use \think\Session;
use \think\Cache;

class User extends Auth
{
    //跳转用户中心
    public function user()
    {
        return $this->fetch('userView');
    }
    //支持的项目页面
    public function support()
    {
        //获取分页项目
////////////////
        $zc_user=[];
        $zc_user['userid']=10001;//(测试用)
//////////////
        $supportList=db('orders a,zc_project b')
            ->where('a.projectid=b.projectid')
            ->where('a.userid',$zc_user['userid'])
            ->order('a.orderstime desc')
            ->paginate(5);
        $this->assign('supportList',$supportList);
        return $this->fetch('support');
    }
    //我的项目页面
    public function myProject()
    {
        return $this->fetch('myProject');
    }
    //关注的项目页面
    public function focus()
    {

        //获取分页项目
////////////////
        $zc_user=[];
        $zc_user['userid']=10001;//(测试用)
//////////////
        $focusList=db('focuspro a')
            ->field('*,sum(c.curcount) sum_curcount,datediff(b.endtime,NOW()) resttime')
            ->join('zc_project b','a.projectid=b.projectid')
            ->join('zc_prodetails c','a.projectid=c.projectid')
            ->group('a.projectid')
            ->order('a.focustime desc')
            ->paginate(5);
        $this->assign('focusList',$focusList);
        return $this->fetch('focus');
    }
    //资金管理页面
    public function money()
    {
        return $this->fetch('money');
    }
    //个人设置页面
    public function settings()
    {
////////////////
        $zc_user=[];
        $zc_user['userid']=10001;//(测试用)
//////////////
        $data=db('user')
            ->where('userid',$zc_user['userid'])
            ->find();
        //session保存个人信息
        Session::set('zc_user',$data);
        $this->assign('zc_user',$data);
        return $this->fetch('settings');
    }
    //收货地址页面
    public function address()
    {
        return $this->fetch('address');
    }
    //个人设置页面-获取省市区
    public function getAddr(){
////////////////
        $zc_user=[];
        $zc_user['userid']=10001;//(测试用)
        $zc_user['province']=350000;//(测试用)
        $zc_user['city']=350100;//(测试用)
        $zc_user['county']=350102;//(测试用)
 //////////////
        $data=db('region')
            ->where('type',0)
            ->whereOr('pid',$zc_user['province'])
            ->whereOr('pid',$zc_user['city'])
            ->select();
        if($data){
            $msgResp=[
                'code'=>20007,
                'msg'=>config('msg')['oper']['select'],
                'data'=>$data
            ];
        }else{
            $msgResp=[
                'code'=>20008,
                'msg'=>config('msg')['oper']['selectFail'],
                'data'=>$data
            ];
        }

        return json($msgResp);

    }
    //个人设置页面-获取城市
    public function getCity(){
        $provinceId=input('?get.province')?input('province'):'';
        $data=db('region')
            ->where('pid',$provinceId)
            ->select();
        if($data){
            $msgResp=[
                'code'=>20007,
                'msg'=>config('msg')['oper']['select'],
                'data'=>$data
            ];
        }else{
            $msgResp=[
                'code'=>20008,
                'msg'=>config('msg')['oper']['selectFail'],
                'data'=>$data
            ];
        }

        return json($msgResp);

    }
    //个人设置页面-获取地区
    public function getCounty(){
        $cityId=input('?get.city')?input('city'):'';
        $data=db('region')
            ->where('pid',$cityId)
            ->select();
        if($data){
            $msgResp=[
                'code'=>20007,
                'msg'=>config('msg')['oper']['select'],
                'data'=>$data
            ];
        }else{
            $msgResp=[
                'code'=>20008,
                'msg'=>config('msg')['oper']['selectFail'],
                'data'=>$data
            ];
        }
        return json($msgResp);

    }
    //头像上传
    public function headImg(){
////////////////
        $zc_user=[];
        $zc_user['userid']=10001;//(测试用)
//////////////
        //上传预览图
        $file = request()->file('headImg');
        // 移动到框架应用根目录/public/static/img/home/headImg/ 目录下
        if($file){
            $path = ROOT_PATH . 'public/static/img/home/headImg';
            $info = $file->move($path);
            if($info){
                // 成功上传后 获取上传信息
                $imgPath='__STATIC__/img/home/headImg/'.$info->getSaveName();
                db('user')
                    ->where('userid',$zc_user['userid'])
                    ->update(['headimg' => $imgPath]);
                $msgResp=[
                    'code'=>20005,
                    'msg'=>config('msg')['oper']['update'],
                    'data'=>$imgPath
                ];
            }else{
                // 上传失败获取错误信息
                $msgResp=[
                    'code'=>20006,
                    'msg'=>config('msg')['oper']['updateFail'],
                    'data'=>$file->getError()
                ];
            }
            return $msgResp;
        }
    }
    //更新用户信息
    public function updateInfo(){

    }
    //test
    public function test()
    {
        return $this->fetch('money');
    }
    //
}


