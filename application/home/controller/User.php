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
        $this->zc_user=[];
        $this->zc_user['userid']=10001;//(测试用)
//////////////
        $supportList=db('orders a,zc_project b')
            ->where('a.projectid=b.projectid')
            ->where('a.userid',$this->zc_user['userid'])
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
        $this->zc_user=[];
        $this->zc_user['userid']=10001;//(测试用)
//////////////
        $focusList=db('focuspro a')
            ->field('*,count(d.ordersid) surport_count,datediff(b.endtime,NOW()) resttime')
            ->join('zc_project b','a.projectid=b.projectid','left')
            ->join('zc_prodetails c','a.projectid=c.projectid','left')
            ->join('zc_orders d','a.projectid=d.projectid','left')
            ->where('a.userid',$this->zc_user['userid'])
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
        $this->zc_user=[];
        $this->zc_user['userid']=10001;//(测试用)
//////////////
        $data=db('user')
            ->where('userid',$this->zc_user['userid'])
            ->find();
        //session保存个人信息
        Session::set('zc_user',$data);
        $this->assign('zc_user',$data);
        return $this->fetch('settings');
    }
    //收货地址页面
    public function address()
    {
        $data=db('address a')
            ->field('a.*,b.name province_name,c.name city_name,d.name county_name')
            ->join('zc_region b','a.province=b.id')
            ->join('zc_region c','a.city=c.id')
            ->join('zc_region d','a.county=d.id')
            ->where('a.userid',$this->zc_user['userid'])
            ->select();
        $this->assign('addrList',json_encode($data));
        return $this->fetch('address');
    }
    //获取收货地址列表
    public function getAddrList()
    {
        ////////////////
        $this->zc_user=[];
        $this->zc_user['userid']=10001;//(测试用)
        //////////////
        $data=db('address a')
            ->field('a.*,b.name province_name,c.name city_name,d.name county_name')
            ->join('zc_region b','a.province=b.id')
            ->join('zc_region c','a.city=c.id')
            ->join('zc_region d','a.county=d.id')
            ->where('a.userid',$this->zc_user['userid'])
            ->select();
//        var_dump($data);
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
//        $this->zc_user=Session::get('zc_user');

        $this->zc_user=[];
        $this->zc_user['userid']=10001;//(测试用)
        $this->zc_user=db('user')
            ->where('userid',10001)
            ->find();//(测试用)
//        $this->zc_user['province']=350000;//(测试用)
//        $this->zc_user['city']=350100;//(测试用)
//        $this->zc_user['county']=350102;//(测试用)
 //////////////
        $data=db('region')
            ->where('type',0)
            ->whereOr('pid',$this->zc_user['province'])
            ->whereOr('pid',$this->zc_user['city'])
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
    //个人设置页面-头像上传
    public function headImg(){
////////////////
        $this->zc_user=[];
        $this->zc_user['userid']=10001;//(测试用)
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
                    ->where('userid',$this->zc_user['userid'])
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
        $this->zc_user=[];
        $this->zc_user['userid']=10001;//(测试用)
//////////////
        $sex=input('?post.sex')?input('sex'):'';
        $province=input('?post.province')?input('province'):'';
        $city=input('?post.city')?input('city'):'';
        $county=input('?post.county')?input('county'):'';
        $res=db('user')
            ->where('userid',$this->zc_user['userid'])
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
        $this->zc_user=[];
        $this->zc_user['userid']=10001;//(测试用)
        //////////////

        $reverName=input('?post.reverName')?input('reverName'):'';
        $province=input('?post.province')?input('province'):'';
        $city=input('?post.city')?input('city'):'';
        $county=input('?post.county')?input('county'):'';
        $detailAddr=input('?post.detailAddr')?input('detailAddr'):'';
//        $Postcode=input('?post.Postcode')?input('Postcode'):'';
        $telephone=input('?post.telephone')?input('telephone'):'';
        $data=[
            'userid'=>$this->zc_user['userid'],
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
        $this->zc_user=[];
        $this->zc_user['userid']=10001;//(测试用)
//////////////
        $id=input('?post.id')?input('id'):'';
        $res=db('address')
            ->where('addressid',$id)
            ->where('userid',$this->zc_user['userid'])
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
//        $this->zc_user=Session::get('zc_user');
        $id=input('?post.id')?input('id'):'';
        $this->zc_user=[];
        $this->zc_user['userid']=10001;//(测试用)
        $addrData=db('address')
            ->where('userid',10001)
            ->where('addressid',$id)
            ->find();//(测试用)
//        $this->zc_user['province']=350000;//(测试用)
//        $this->zc_user['city']=350100;//(测试用)
//        $this->zc_user['county']=350102;//(测试用)
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




    //关注的项目页面-取消关注
    public function cancelFocus()
    {
        $this->zc_user=[];
        $this->zc_user['userid']=10001;//(测试用)
        $focusId=input('?get.id')?input('id'):'';
        $res=db('focuspro')
            ->where('userid', $this->zc_user['userid'])
            ->where('focusid', $focusId)
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
    //
}


