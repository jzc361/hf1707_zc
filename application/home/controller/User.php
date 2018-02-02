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
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

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

        $keyword=input('?get.keyword')?input('get.keyword'):'';
        session('keyword',$keyword);
        $this->assign('keyword',$keyword);
        //获取当前用户发布的项目
        $usermsg=session("zc_user");
        $userid=$usermsg['userid'];
        $proList=db('project a')
            ->join('state b','a.stateid=b.stateid')
            ->field('a.projectid,a.projectname,a.projectimg,b.statename,a.failreason')
            ->where('userid',$userid)
            ->where('a.projectname','like','%'.$keyword.'%')
            ->order('a.createtime desc')
            ->paginate(2,false,$config = ['query'=>array('keyword'=>$keyword)]);
        //var_dump($proList);
        $this->assign('proList',$proList);
        return $this->fetch('myProject');
    }

    //查看审核失败理由
    public function showReason(){
        $reason='';
        $projectid=input('?get.projectid')?input('get.projectid'):'';
       // var_dump($projectid) ;
        if(!empty($projectid)){
            $reason=db('project')->field('failreason')->where('projectid',$projectid)->find();
            $reason=$reason['failreason'];
        }
        echo $reason;
        //var_dump($reason);
        //$this->assign('failreason',$reason);
        //return $this->fetch('failReason');

    }
    //删除项目
    public function deletePro(){
        $projectid=input('?get.projectid')?input('get.projectid'):'';
        $res=db('project')->field('projectname')->where('projectid',$projectid)->find();
        if($res!=NULL){
            //删除项目
            $isdel=db('project')->where('projectid',$projectid)->delete();
            if($isdel){
                $msgResp=[
                    'code'=>20003, //删除成功
                    'msg'=>config('msg')['oper']['del'],
                    'data'=>[]
                ];
            }
            else{
                $msgResp=[
                    'code'=>20004,//删除失败
                    'msg'=>config('msg')['oper']['delFail'],
                    'data'=>[]
                ];
            }
        }

        return json($msgResp);
       // var_dump($res);
    }
    //查看详情
    public function showDetails(){
        $projectid=input('get.id');
        //echo $projectid;
        $promsg=Db::table('zc_project')
            ->alias('a')
            ->join('zc_state c','a.stateid=c.stateid')
            ->join('zc_user d','a.userid=d.userid')
            ->where('projectid',$projectid)
            ->select();
//        $promsg=Db::name('project')->where('projectid',$projectid)->select();
        $returnmsg=Db::name('prodetails')->where('projectid',$projectid)->select();
        // echo "<pre>";
        //  var_dump($promsg);exit();
        // var_dump($returnmsg);exit();
        $this->assign([
            'promsg'=>$promsg,
            'returnmsg'=>$returnmsg
        ]);
        return $this->fetch('proDetails');
    }
    //修改开始时间与结束时间
    public function updateStartTime(){
        $projectid=input('?post.projectid')?input('post.projectid'):'';
        $starttime=input('?post.starttime')?input('post.starttime'):'';
        //获取该项目的众筹天数
        $daysnumber=db('project')->field('daysnumber')->where('projectid',$projectid)->find();
        $daysnumber=$daysnumber['daysnumber'];
        //转换时间获取结束时间
        $startStamp=strtotime($starttime);
        $endStamp=$startStamp+86400*$daysnumber;
        $endtime=date("Y-m-d H:i:s",$endStamp);
        //更新数据库
        $res=db('project')
            ->where('projectid',$projectid)
            ->update(['begintime'=> $starttime,'endtime'=>$endtime]);

        if($res){
            //更改成功
            $msgResp=[
                'code'=>20005, //更新成功
                'msg'=>config('msg')['oper']['update'],
                'data'=>[]
            ];
        }
        else{
            //更改失败
            $msgResp=[
                'code'=>20006, //更新失败
                'msg'=>config('msg')['oper']['updateFail'],
                'data'=>[]
            ];
        }
        return json($msgResp);
    }
    //查看项目日志
    public function showLog(){
        $proid=input('get.id');
        $condition=['projectid'=>$proid];
        $pro=db('project')->where($condition)->field('projectid,projectname')->find();
        $log=Db::table('zc_prolog')
            ->alias('a')
            ->join('zc_user b','a.userid=b.userid')
            ->where($condition)
            ->order('logtime','desc')
            ->field('a.*,b.userid,b.username')
            ->select();
        //项目进度
        $this->assign('pro',$pro);
        $this->assign('prolog',$log);
        return $this->fetch('proLog');
    }
    //更新日志
    public function updateLog(){
        $userid=session('zc_user')['userid'];
        $proid=input('?get.projectid')?input('get.projectid'):"";
        //上传图片
        $file = request()->file('imgFile');
        $logMsg=input('post.');
        //var_dump($file);//var_dump($logMsg);
        //用户未登录
        if(!$userid){
            $reMsg=[
                'code'=>00000,
                'msg'=>config('Msg')['nologin']['nologin'],
                'data'=>$proid
            ];
            return json($reMsg);
        }
        //内容为空，提示
        if(!$file&&!$logMsg['prologinfo']){
            $reMsg=[
                'code'=>50003,
                'msg'=>config('Msg')['prolog']['null'],
                'data'=>$proid
            ];
            return json($reMsg);
        }
        $condition=[
            'projectid'=>$proid,
            'userid'=>$userid,
            'logtime'=>date('Y-m-d H:i:s',time()),
            'prologinfo'=>$logMsg['prologinfo'],
            'logimg'=>''
        ];
        //有图片上传
        if($file){
            $path = ROOT_PATH . 'public/static/img/home/logimg/pro'.$proid;
            $info = $file->move($path);
            if($info){
                //图片上传成功，获取上传信息
                $imgPath=$info->getSaveName();
                $condition['logimg']='img/home/logimg/pro'.$proid.'/'.$imgPath;
            }
        }
        //var_dump($condition);
        $res=db('prolog')->insert($condition);
        if($res){
            //更新成功
            $reMsg=[
                'code'=>50001,
                'msg'=>config('Msg')['prolog']['success'],
                'data'=>$proid
            ];
            return json($reMsg);
        }else{
            //更新失败
            $reMsg=[
                'code'=>50002,
                'msg'=>config('Msg')['prolog']['error'],
                'data'=>$proid
            ];
            return json($reMsg);
        }
    }
    //查看支持记录
    public function showSupRecord(){
        $proid=input('get.id');
        $condition=['projectid'=>$proid];
        $order=[];//订单信息数组
        //$prodetails=[];
        //项目名
        $projectname=db('project')->where($condition)->field('projectname')->find();
        //var_dump($projectname);exit;
        //回报信息
        //$prodetails=db('prodetails')->where($condition)->select();
        //var_dump($prodetails);exit;
        //项目下的所有订单
        $orderList=db('orders')
            ->where($condition)
            //->paginate(2);
            ->select();
        //var_dump($orderList);//exit;
        foreach($orderList as $key=>$value){
            $supUserid=$value['userid'];//订单内的用户id
            $supUseraddid=$value['addressid'];
            $supProdetailsid=$value['prodetailsid'];
            //查询地址表数据
            $condition1=[
                'a.userid'=>$supUserid,
                'addressid'=>$supUseraddid
            ];
            //订单内用户的地址信息
            $useradd=db('address a')
                ->field('a.*,b.name province_name,c.name city_name,d.name county_name,e.username')
                ->join('zc_region b','a.province=b.id')
                ->join('zc_region c','a.city=c.id')
                ->join('zc_region d','a.county=d.id')
                ->join('zc_user e','a.userid=e.userid')//获取用户名
                ->where($condition1)
                ->find();
            //var_dump($useradd);
            //用户地址插入订单数组
            $value['address']=$useradd;
            //获取回报信息
            $condition2=['prodetailsid'=>$supProdetailsid];
            $prodetailsList=db('prodetails')->where($condition2)->find();
            //var_dump($prodetailsList);
            $value['prodetails']=$prodetailsList;
            //array_push($prodetails,$prodetailsList);
            //var_dump($value);
            //订单信息插入order数组
            array_push($order,$value);
        }

        //echo gettype($orderList);
        //var_dump($orderList);exit;
        //echo gettype($order);
        //var_dump($order);exit;
        //var_dump($prodetails);exit;
        //exit;
        $this->assign('projectname',$projectname);//项目名
        //$this->assign('prodetails',$prodetails);//回报信息
        $this->assign('order',$order);//订单信息
        $this->assign('orderList',$orderList);
        return $this->fetch('proSupRecord');
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
        ////////////////
        $zc_user=[];
        $zc_user['userid']=10001;//(测试用)
        //////////////
        $data=db('address a')
            ->field('a.*,b.name province_name,c.name city_name,d.name county_name')
            ->join('zc_region b','a.province=b.id')
            ->join('zc_region c','a.city=c.id')
            ->join('zc_region d','a.county=d.id')
            ->where('a.userid',$zc_user['userid'])
            ->select();
//        var_dump($data);
        $this->assign('addrList',$data);
        return $this->fetch('address');
    }
    //个人设置页面-获取省份
    public function getProvince(){
        $data=db('region')
            ->where('type',0)
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
    //个人设置页面-获取省市区
    public function getAddr(){
////////////////
//        $zc_user=Session::get('zc_user');

        $zc_user=[];
        $zc_user['userid']=10001;//(测试用)
        $zc_user=db('user')
            ->where('userid',10001)
            ->find();//(测试用)
//        $zc_user['province']=350000;//(测试用)
//        $zc_user['city']=350100;//(测试用)
//        $zc_user['county']=350102;//(测试用)
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
            return json($msgResp);
        }
    }
    //更新用户信息
    public function updateInfo(){
        ////////////////
        $zc_user=[];
        $zc_user['userid']=10001;//(测试用)
//////////////
        $sex=input('?post.sex')?input('sex'):'';
        $province=input('?post.province')?input('province'):'';
        $city=input('?post.city')?input('city'):'';
        $county=input('?post.county')?input('county'):'';
        $res=db('user')
            ->where('userid',$zc_user['userid'])
            ->update(['sex' => $sex,'province'=>$province,'city'=>$city,'county'=>$county]);
        if($res>0){

        }else{
            $msgResp=[
                'code'=>20006,
                'msg'=>config('msg')['oper']['updateFail'],
                'data'=>''
            ];
        }
        return json($msgResp);
    }
    //添加地址
    public function insertAddress(){
        ////////////////
        $zc_user=[];
        $zc_user['userid']=10001;//(测试用)
        //////////////

        $reverName=input('?post.reverName')?input('reverName'):'';
        $province=input('?post.province')?input('province'):'';
        $city=input('?post.city')?input('city'):'';
        $county=input('?post.county')?input('county'):'';
        $detailAddr=input('?post.detailAddr')?input('detailAddr'):'';
//        $Postcode=input('?post.Postcode')?input('Postcode'):'';
        $telephone=input('?post.telephone')?input('telephone'):'';
        $data=[
            'userid'=>$zc_user['userid'],
            'revername'=>$reverName,
            'province'=>$province,
            'city'=>$city,
            'county'=>$county,
            'addressdetails'=>$detailAddr,
            'revertel'=>$telephone
        ];
        $res=db('address')->insert($data);
        if($res>0){
            $msgResp=[
                'code'=>20001,
                'msg'=>config('msg')['oper']['add'],
                'data'=>''
            ];
        }else{
            $msgResp=[
                'code'=>20002,
                'msg'=>config('msg')['oper']['addFail'],
                'data'=>''
            ];
        }
        return json($msgResp);
    }
    //删除地址
    public function deleteAddress(){
////////////////
        $zc_user=[];
        $zc_user['userid']=10001;//(测试用)
//////////////
        $id=input('?post.id')?input('id'):'';
        $res=db('address')
            ->where('addressid',$id)
            ->where('userid',$zc_user['userid'])
            ->delete();
        if($res>0){
            $msgResp=[
                'code'=>20003,
                'msg'=>config('msg')['oper']['del'],
                'data'=>''
            ];
        }else{
            $msgResp=[
                'code'=>20004,
                'msg'=>config('msg')['oper']['delFail'],
                'data'=>''
            ];
        }
        return json($msgResp);
    }
    //修改地址
    public function updateAddress(){
        $reverName=input('?post.reverName')?input('reverName'):'';
        $province=input('?post.province')?input('province'):'';
        $city=input('?post.city')?input('city'):'';
        $county=input('?post.county')?input('county'):'';
        $detailAddr=input('?post.detailAddr')?input('detailAddr'):'';
        $Postcode=input('?post.Postcode')?input('Postcode'):'';
        $telephone=input('?post.telephone')?input('telephone'):'';
        $data=[
            'revername'=>$reverName,
            'rovince'=>$province,
            'city'=>$city,
            'county'=>$county,
            'detailAddr'=>$detailAddr,
            'Postcode'=>$Postcode,
            'telephone'=>$telephone
        ];
        $res=db('address')->update($data);
        if($res>0){
            $msgResp=[
                'code'=>20001,
                'msg'=>config('msg')['oper']['add'],
                'data'=>''
            ];
        }else{
            $msgResp=[
                'code'=>20002,
                'msg'=>config('msg')['oper']['addFail'],
                'data'=>''
            ];
        }
        return json($msgResp);
    }
    //获取收货地址
    public function selectAddress(){
////////////////
//        $zc_user=Session::get('zc_user');
        $id=input('?post.id')?input('id'):'';
        $zc_user=[];
        $zc_user['userid']=10001;//(测试用)
        $addrData=db('address')
            ->where('userid',10001)
            ->where('addressid',$id)
            ->find();//(测试用)
//        $zc_user['province']=350000;//(测试用)
//        $zc_user['city']=350100;//(测试用)
//        $zc_user['county']=350102;//(测试用)
        //////////////
        $regionData=db('region')
            ->where('type',0)
            ->whereOr('pid',$addrData['province'])
            ->whereOr('pid',$addrData['city'])
            ->select();
        if($regionData && $addrData){

            $msgResp=[
                'code'=>20007,
                'msg'=>config('msg')['oper']['select'],
                'data'=>[$regionData,$addrData]
            ];
        }else{
            $msgResp=[
                'code'=>20008,
                'msg'=>config('msg')['oper']['selectFail'],
                'data'=>''
            ];
        }

        return json($msgResp);

    }
    //test
    public function test()
    {
        return $this->fetch('money');
    }
    //
}


