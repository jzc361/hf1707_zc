<?php
namespace app\home\controller;
//use \think\View;
use \think\Controller;
use \think\Db;
use \think\Request;
use \think\Session;
use \think\Cache;
use \think\Validate;
class User extends Auth
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    //登录页
    public function showLogin(){
        return $this->fetch('userLogin');
    }
    //注册页
    public function showRegister(){
        return $this->fetch('userRegister');
    }
    //登录
    public function userLogin(){
        $username=input('?post.username')?input('post.username'):"";
        $userpsd=input('?post.userpsd')?md5(input('post.userpsd')):"";
        $code=input('?post.code')?input('code'):"";
        //验证码
        if(!captcha_check($code)){
            //验证失败
            $reMsg=[
                'code'=>10002,
                'msg'=>config('Msg')['login']['codeFail'],
                'data'=>[]
            ];
            return json($reMsg);
        }
        $condition=['username'=>$username,'userpsw'=>$userpsd];
        $data=db('user')->where($condition)->find();
        if(empty($data)){
            //登录失败
            $reMsg=[
                'code'=>10000,
                'msg'=>config('Msg')['login']['fail'],
                'data'=>[]
            ];
            return json($reMsg);
        }else{
            if($data['usestate']=='锁定'){
                //账号被锁定
                $reMsg=[
                    'code'=>10005,
                    'msg'=>config('Msg')['login']['usestateFail'],
                    'data'=>[]
                ];
                return json($reMsg);
            }
            //登录成功
            Session::set('zc_user',$data);
            $reMsg=[
                'code'=>10001,
                'msg'=>config('Msg')['login']['success'],
                'data'=>[$data]
            ];
            return json($reMsg);
        }
    }
    //注册
    public function userRegister(){
        $username=input('?post.username')?input('post.username'):"";
        $userpsd=input('?post.userpsd')?md5(input('post.userpsd')):"";
        $code=input('?post.code')?input('code'):"";
        //验证码
        if(!captcha_check($code)){
            //验证失败
            $reMsg=[
                'code'=>10002,
                'msg'=>config('Msg')['register']['codeFail'],
                'data'=>[]
            ];
            return json($reMsg);
        }
        if($username&&$userpsd){
            $condition=['username'=>$username,'userpsw'=>$userpsd];
            $data=db('user')->where('username',$username)->select();
            if(!empty($data)){
                //账号存在，注册失败
                $reMsg=[
                    'code'=>10014,
                    'msg'=>config('Msg')['register']['fail'],
                    'data'=>[]
                ];
                return json($reMsg);
            }else{
                $res=db('user')->insert($condition);
                if($res){
                    //注册成功
                    $reMsg=[
                        'code'=>10011,
                        'msg'=>config('Msg')['register']['success'],
                        'data'=>[]
                    ];
                    return json($reMsg);
                }
            }
        }
    }
    //退出登录
    public function exitLogin(){
        Session::delete('zc_user');
        return $this->fetch('userLogin');
    }


    //跳转用户中心
    public function user()
    {
        $this->assign('do',$this->do);
        return $this->fetch('userView');
    }
    //支持的项目页面
    public function support()
    {
        //获取分页项目
        $supportList=db('orders a,zc_prodetails b,zc_project c')
            ->where('a.prodetailsid=b.prodetailsid')
            ->where('b.projectid=c.projectid')
            ->where('a.userid',$this->zc_user['userid'])
            ->order('a.orderstime desc')
            ->paginate(5);
        $this->assign('supportList',$supportList);
        return $this->fetch('support');
    }
    //支持的项目页面--项目详情
    public function supportDetail(){
        $orderid=input('?get.id')?input('id'):'';
        $order=db('orders a')
            ->where('a.ordersid',$orderid)
            ->join('zc_prodetails b','a.prodetailsid=b.prodetailsid')
            ->join('zc_project c','b.projectid=c.projectid')
            ->field('a.*,b.introduce,c.projectname')
            ->find();

        $condition=['a.projectid'=>$orderid];
        $log=db('prolog a')
            ->join('zc_user b','a.userid=b.userid')
            ->where($condition)
            ->order('logtime','desc')
            ->field('a.*,b.userid,b.username')
            ->select();

        //项目进度
        $this->assign('order',$order);
        $this->assign('prolog',$log);
        return $this->fetch('supportDetail');
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
        //var_dump($proid);exit;
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
//        var_dump($condition);exit;
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
        $orderList=db('orders a')
            ->join('zc_prodetails b','a.prodetailsid=b.prodetailsid')
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
    public function focus(){
        var_dump(input());
        $page=input('?get.page')?input('page'):"";
        //获取分页项目
        $focusList=db('focuspro a')
            ->field('*,count(d.ordersid) surport_count,datediff(b.endtime,NOW()) resttime')
            ->join('zc_project b','a.projectid=b.projectid','left')
            ->join('zc_prodetails c','a.projectid=c.projectid','left')
            ->join('zc_orders d','c.prodetailsid=d.prodetailsid','left')
            ->where('a.userid',$this->zc_user['userid'])
            ->group('a.projectid')
            ->order('a.focustime desc')
            ->paginate(3,false,[

            ]);
        $this->assign('focusList',$focusList);
        return $this->fetch('focus');
    }
    //资金管理页面
    public function money(){
        $this->assign('money',$this->zc_user['money']);
        return $this->fetch('money');
    }
    //资金管理页面-充值
    public function recharge(){
        $rechargeNum=input('?post.rechargeNum')?input('rechargeNum'):'';
//        var_dump($rechargeNum);
        $validate=Validate::regex($rechargeNum,'/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/');
//        var_dump($rechargeNum,$validate);exit;
        if($validate) {
            // 启动事务
            Db::startTrans();
            try {
                //更新用户信息
                db("user")
                    ->where('userid', $this->zc_user['userid'])
                    ->setInc('money', $rechargeNum);
                //添加充值记录
                $data = [
                    'r_time' => date('Y-m-d H:i:s'),
                    'r_amount' => "{$rechargeNum}",
                    'r_method' => '微信支付',
                    'r_state' => '1',
                    'userid' => "{$this->zc_user['userid']}",
                ];
                db("recharge")
                    ->insert($data);
                // 提交事务
                Db::commit();
                $this->zc_user['money'] += $rechargeNum;
                Session::set('zc_user', $this->zc_user);
                $msgResp = [
                    'code' => 20005,
                    'msg' => config('msg')['oper']['update'],
                    'data' => $this->zc_user['money']
                ];
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                $msgResp = [
                    'code' => 20006, //更新失败
                    'msg' => config('msg')['oper']['updateFail'],
                    'data' => []
                ];
            }
        }else{
            $msgResp=[
                'code'=>20006, //更新失败
                'msg'=>config('msg')['oper']['updateFail'],
                'data'=>[]
            ];
        }
        return json($msgResp);

//            $res=db("user")
//                ->where('userid',$this->zc_user['userid'])
//                ->setInc('money', $rechargeNum);
//
//            if($res>0){
//                $data=[
//                    'r_time'=>'now()',
//                    'r_amount'=>"{$rechargeNum}",
//                    'r_method'=>'微信支付',
//                    'r_state'=>'1',
//                    'userid'=>"{$this->zc_user['userid']}",
//                ];
//                $res2=db("recharge")
//                    ->where('userid',$this->zc_user['userid'])
//                    ->insert($data);
//                if($res2>0){
//
//                }
//
//                $this->zc_user['money']+=$rechargeNum;
//                Session::set('zc_user',$this->zc_user);
//                $msgResp=[
//                    'code'=>20005,
//                    'msg'=>config('msg')['oper']['update'],
//                    'data'=>$this->zc_user['money']
//                ];
//            }else{
//                $msgResp=[
//                    'code'=>20006, //更新失败
//                    'msg'=>config('msg')['oper']['updateFail'],
//                    'data'=>[]
//                ];
//            }
//        }else{
//            $msgResp=[
//                'code'=>20006, //更新失败
//                'msg'=>config('msg')['oper']['updateFail'],
//                'data'=>[]
//            ];
//        }

//        return json($msgResp);
    }
    //资金管理页面-获取充值记录表
    public function getRechargeList(){
        $current=input('?get.pageNow')?input('pageNow'):1;
        $showItem=5;
        $pageSize=5;
        $rowCount=db('recharge')
            ->where('userid',$this->zc_user['userid'])
            ->count();
        $allPage=ceil($rowCount/$pageSize);
        if($allPage<$current){
            $current=$allPage;
        }
        $pageData=[
            'current'=>$current,
            'showItem'=>$showItem,
            'allPage'=>$allPage
        ];
        $data=db('recharge')
            ->where('userid',$this->zc_user['userid'])
            ->order('r_id desc')
            ->page("{$current},{$pageSize}")
            ->select();
        if($data){
            $msgResp=[
                'code'=>20007,
                'msg'=>config('msg')['oper']['select'],
                'data'=>[$data,$pageData]
            ];
        }else{
            $msgResp=[
                'code'=>20008,
                'msg'=>config('msg')['oper']['selectFail'],
                'data'=>[]
            ];
        }
        return json($msgResp);
    }
    //个人设置页面
    public function settings()
    {
        $data=db('user')
            ->where('userid',$this->zc_user['userid'])
            ->find();
        //session保存个人信息
        Session::set('zc_user',$data);
        $this->assign('zc_user',$data);
        return $this->fetch('settings');
    }
    //安全信息页面
    public function security()
    {
        //获取用户信息
        $userid=$this->zc_user['userid'];
        $userInfo=db('user')->where('userid',$userid)->find();
        $this->assign('userInfo',$userInfo);
       // var_dump($userInfo);
        return $this->fetch('security');
    }
    //获取验证码
    public function getTelCode(){
       // Session::delete('sendTime');exit();
        if(Session::has('sendTime')){
            //echo Session::get('sendTime');
            //echo time();
            if(Session::get('sendTime')>time()){ //时间还没到，不能重复获取
                $msgResp=[
                    'code'=>90012,
                    'msg'=>config('msg')['telCode']['fail'],
                    'data'=>[]
                ];

                //exit("请不要重复获取验证码");
            }
            else{
                $telNumber=input('?post.telNumber')?input('post.telNumber'):'';
                if(!empty($telNumber)){
                    //获取验证码
                    $mobile_code = $this->random(4,1);
                    $url="http://106.ihuyi.com/webservice/sms.php?method=Submit&account=C58487377&password=25d7001a93f3521a1e726f67e335f7a3&mobile=".$telNumber."&content=您的验证码是：".$mobile_code."。请不要把验证码泄露给其他人。";
                    $postData=[];
                    $postType="GET";
                    $gets = $this->xml_to_array($this->curlHttp($url,$postData,$postType));
                    if($gets['SubmitResult']['code']==2){
                        //$_SESSION['mobile'] = $telNumber;
                        Session::set('sendTime',time()+5*60);
                       // $_SESSION['sendTime'] = time()+100000;
                        //返回$mobile_code
                        $msgResp=[
                            'code'=>90013,
                            'msg'=>config('msg')['telCode']['success'],
                            'data'=>[$mobile_code,$telNumber]
                        ];
                    }
                }
            }
        }
        else{
            $telNumber=input('?post.telNumber')?input('post.telNumber'):'';
            if(!empty($telNumber)){
                //获取验证码
                $mobile_code = $this->random(4,1);
                $url="http://106.ihuyi.com/webservice/sms.php?method=Submit&account=C58487377&password=25d7001a93f3521a1e726f67e335f7a3&mobile=".$telNumber."&content=您的验证码是：".$mobile_code."。请不要把验证码泄露给其他人。";
                $postData=[];
                $postType="GET";
                $gets = $this->xml_to_array($this->curlHttp($url,$postData,$postType));
                if($gets['SubmitResult']['code']==2){
                    //$_SESSION['mobile'] = $telNumber;
                    Session::set('sendTime',time()+5*60);
                    //返回$mobile_code
                    $msgResp=[
                        'code'=>90013,
                        'msg'=>config('msg')['telCode']['success'],
                        'data'=>[$mobile_code,$telNumber]
                    ];
                }
            }
        }
        return json($msgResp);
    }
    //绑定手机号
    public function addTel(){
        $userid=$this->zc_user['userid'];
        $telNumber=input('?post.telNumber')?input('post.telNumber'):'';
        if(input('get.isUpdate')==0){ //绑定
            if(!empty($telNumber)){
                $res=db('user')->where('userid',$userid)->update(['telephone'=>$telNumber]);
                if($res==1){
                    $msgResp=[
                        'code'=>90015,//绑定成功
                        'msg'=>config('msg')['boundTel']['success'],
                        'data'=>[]
                    ];
                }
                else{
                    $msgResp=[
                        'code'=>90014, //绑定失败
                        'msg'=>config('msg')['boundTel']['fail'],
                        'data'=>[]
                    ];
                }
            }
            else{
                $msgResp=[
                    'code'=>90014, //绑定失败
                    'msg'=>config('msg')['boundTel']['fail'],
                    'data'=>[]
                ];
            }
        }
        else{
            //echo "jss";
            //解绑
            if(!empty($telNumber)){
                $res=db('user')->where('userid',$userid)->update(['telephone'=>null]);
                if($res==1){
                    $msgResp=[
                        'code'=>90017,//解绑成功
                        'msg'=>config('msg')['boundTel']['relievesuccess'],
                        'data'=>[]
                    ];
                }
                else{
                    $msgResp=[
                        'code'=>90016, //解绑失败
                        'msg'=>config('msg')['boundTel']['relievefail'],
                        'data'=>[]
                    ];
                }
            }
            else{
                $msgResp=[
                    'code'=>90016, //解绑失败
                    'msg'=>config('msg')['boundTel']['relievefail'],
                    'data'=>[]
                ];
            }
        }


        return json($msgResp);
    }

  //发送curl
    public function curlHttp($url='',$postData=[],$postType="GET"){
        //初始化curl，才能使用curl的扩展函数,$curl即相当于句柄
        $curl=curl_init();
        //设置常用选项：
        //1.请求的url
        curl_setopt($curl,CURLOPT_URL,$url);
        //2.设置请求的类型
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,$postType);
        //3.请求的数据体结构
//        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
//        curl_setopt($curl,CURLOPT_COOKIE,$cookie);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$postData);
        //跳过https检查
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);

        //4.将请求的结果原样返回
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        $result=curl_exec($curl);
       // curl_close($curl);
        return $result;
    }
    //将 xml数据转换为数组格式。
    public function xml_to_array($xml){
        $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
        if(preg_match_all($reg, $xml, $matches)){
            $count = count($matches[0]);
            for($i = 0; $i < $count; $i++){
                $subxml= $matches[2][$i];
                $key = $matches[1][$i];
                if(preg_match( $reg, $subxml )){
                    $arr[$key] = $this->xml_to_array( $subxml );
                }else{
                    $arr[$key] = $subxml;
                }
            }
        }
        return $arr;
    }
    //random() 函数返回随机整数。
    public function random($length = 6 , $numeric = 0) {
        PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
        if($numeric) {
            $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
        } else {
            $hash = '';
            $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
            $max = strlen($chars) - 1;
            for($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
        }
        return $hash;
    }

    //收货地址页面
    public function address()
    {
        $current=1;
        $showItem=5;
        $pageSize=5;
        $rowCount=db('address')
            ->where('userid',$this->zc_user['userid'])
            ->count();
        $allPage=ceil($rowCount/$pageSize);
        if($allPage<$current){
            $current=$allPage;
        }
        $pageData=[
            'current'=>$current,
            'showItem'=>$showItem,
            'allPage'=>$allPage
        ];
        $data=db('address a')
            ->field('a.*,b.name province_name,c.name city_name,d.name county_name')
            ->join('zc_region b','a.province=b.id')
            ->join('zc_region c','a.city=c.id')
            ->join('zc_region d','a.county=d.id')
            ->where('a.userid',$this->zc_user['userid'])
            ->order('a.isdefault desc,a.addressid')
            ->page("{$current},{$pageSize}")
            ->select();

        $this->assign('addrList',json_encode($data));
        $this->assign('pageData',json_encode($pageData));
        return $this->fetch('address');
    }
    //获取收货地址列表
    public function getAddrList()
    {
        $current=input('?get.pageNow')?input('pageNow'):1;
//        var_dump($current);exit;
        $showItem=5;
        $pageSize=5;
        $rowCount=db('address')
            ->where('userid',$this->zc_user['userid'])
            ->count();
        $allPage=ceil($rowCount/$pageSize);
        if($allPage<$current){
            $current=$allPage;
        }
        $pageData=[
            'current'=>$current,
            'showItem'=>$showItem,
            'allPage'=>$allPage
        ];
        $data=db('address a')
            ->field('a.*,b.name province_name,c.name city_name,d.name county_name')
            ->join('zc_region b','a.province=b.id')
            ->join('zc_region c','a.city=c.id')
            ->join('zc_region d','a.county=d.id')
            ->where('a.userid',$this->zc_user['userid'])
            ->order('a.isdefault desc,a.addressid')
            ->page("{$current},{$pageSize}")
            ->select();
        if($data){
            $msgResp=[
                'code'=>20007,
                'msg'=>config('msg')['oper']['select'],
                'data'=>[$data,$pageData]
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
    //收货地址页面-获取省市区
    public function getCityCounty(){

        $provinceId=input('?post.province')?input('province'):'';
        $cityId=input('?post.city')?input('city'):'';
        $cityList=db('region')
            ->where('pid',$provinceId)
            ->select();
        $countyList=db('region')
            ->where('pid',$cityId)
            ->select();
        if($cityList && $countyList){
            $msgResp=[
                'code'=>20007,
                'msg'=>config('msg')['oper']['select'],
                'data'=>[$cityList,$countyList]
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
    //个人设置更新用户信息
    public function updateInfo(){
        $sex=input('?post.sex')?input('sex'):'';
        $province=input('?post.province')?input('province'):'';
        $city=input('?post.city')?input('city'):'';
        $county=input('?post.county')?input('county'):'';
        $res=db('user')
            ->where('userid',$this->zc_user['userid'])
            ->update(['sex' => $sex,'province'=>$province,'city'=>$city,'county'=>$county]);
        if($res>0){
            //更新session
            $data=db('user')
                ->where('userid',$this->zc_user['userid'])
                ->find();
            $this->zc_user=$data;
            Session::set('zc_user',$data);
            $msgResp=[
                'code'=>20005,
                'msg'=>config('msg')['oper']['updateFail'],
                'data'=>''
            ];
        }else{
            $msgResp=[
                'code'=>20006,
                'msg'=>config('msg')['oper']['updateFail'],
                'data'=>''
            ];
        }
        return json($msgResp);
    }
    //收货地址页面-添加地址
    public function insertAddress(){
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
        $res=db('address')->insertGetId($data);//地址id
        if($res>0){
            $msgResp=[
                'code'=>20001,
                'msg'=>config('msg')['oper']['add'],
                'data'=>$res
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
    //收货地址页面-删除地址
    public function deleteAddress(){
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
    //收货地址页面-修改地址
    public function updateAddress(){
        $id=input('?get.id')?input('id'):'';
        $reverName=input('?post.reverName')?input('reverName'):'';
        $province=input('?post.province')?input('province'):'';
        $city=input('?post.city')?input('city'):'';
        $county=input('?post.county')?input('county'):'';
        $detailAddr=input('?post.detailAddr')?input('detailAddr'):'';
//        $Postcode=input('?post.Postcode')?input('Postcode'):'';
        $telephone=input('?post.telephone')?input('telephone'):'';
        $data=[
            'revername'=>$reverName,
            'province'=>$province,
            'city'=>$city,
            'county'=>$county,
            'addressdetails'=>$detailAddr,
            'revertel'=>$telephone
        ];
        $res=db('address')
            ->where('addressid',$id)
            ->update($data);
        if($res>0){
            $msgResp=[
                'code'=>20005,
                'msg'=>config('msg')['oper']['update'],
                'data'=>''
            ];
        }else{
            $msgResp=[
                'code'=>20006,
                'msg'=>config('msg')['oper']['updateFail'],
                'data'=>''
            ];
        }
        return json($msgResp);
    }
    //收货地址页面-设置默认地址
    public function setDefaultAddress(){
        $id=input('?post.id')?input('id'):'';
        $data1=[
            'isdefault'=>0
        ];
        $data2=[
            'isdefault'=>1
        ];
        //修改原默认地址
        db('address')
            ->where('isdefault',1)
            ->where('userid',$this->zc_user['userid'])
            ->update($data1);
        //设置新默认地址
        $res=db('address')
            ->where('addressid',$id)
            ->where('userid',$this->zc_user['userid'])
            ->update($data2);
        if($res>0){
            $msgResp=[
                'code'=>20005,
                'msg'=>config('msg')['oper']['update'],
                'data'=>''
            ];
        }else{
            $msgResp=[
                'code'=>20006,
                'msg'=>config('msg')['oper']['updateFail'],
                'data'=>''
            ];
        }
        return json($msgResp);
    }

    //关注的项目页面-取消关注
    public function cancelFocus()
    {
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


