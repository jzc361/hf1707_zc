<?php
namespace app\home\controller;
//use \think\View;
use \think\Controller;
use \think\Db;
use \think\Request;
use \think\Session;
use \think\Cache;

class Index extends  Controller
{
    //跳转首页
    public function index()
    {
        //获取banner
        $adList=db('ad')->where('starttime','<=',date('Y-m-d H:i:s'))->where('endtime','>',date('Y-m-d H:i:s'))->select(); //获取有效期广告
        //热门众筹
        $hotList=db('project')->where('begintime','<=',date('Y-m-d H:i:s'))->where('endtime','>',date('Y-m-d H:i:s'))->order('focuscount desc')->limit(4)->field('*,datediff(endtime,NOW()) resttime')->select();
        //最新众筹
        $newList=db('project')->where('begintime','<=',date('Y-m-d H:i:s'))->where('endtime','>',date('Y-m-d H:i:s'))->order('createtime desc')->limit(3)->field('*,datediff(endtime,NOW()) resttime')->select();
        //即将下架
        $oldList=db('project')->where('begintime','<=',date('Y-m-d H:i:s'))->where('endtime','>',date('Y-m-d H:i:s'))->order('endtime')->limit(3)->field('*,datediff(endtime,NOW()) resttime')->select();

        $this->assign('adList',$adList);
        $this->assign('hotList',$hotList);
        $this->assign('newList',$newList);
        $this->assign('oldList',$oldList);

        $this->assign('today',time());
        return $this->fetch('mainView');
    }

    /*
    public function showLogin()
    {
        return $this->fetch('loginView');
    }
    //登录判断
    public function login(){
        $msgResp=[
            'code'=>10000,
            'msg'=>config('msg')['login']['error'],
            'data'=>[]
        ];
        $account=input('?post.account')?input('account'):'';
        $password=input('?post.password')?md5(input('password')):'';
        $code=input('?post.code')?input('code'):'';
//        验证码判断
        if(!captcha_check($code)){
            //验证失败
            $msgResp=[
                'code'=>10002,
                'msg'=>config('msg')['login']['codeFail'],
                'data'=>[]
            ];
            return json($msgResp);
        };
//        $res=Db::query('select * from `t_user` where u_id=?',[1]);
//        Db::table('user')->where('id',1)->find();//查询一个数据使用：
//        Db::table('user')->where('id',1)->select();//查询数据集使用
        $where=[
            'u_account'=>$account,
            'u_pwd'=>$password,
        ];
        $res=db('user')->where($where)->find();//查询一个数据使用
        if(empty($res)){

            $msgResp=[
                'code'=>10004,
                'msg'=>config('msg')['login']['fail'],
                'data'=>[]
            ];
            return json($msgResp);
        }

//        $user = User::get(1);// 静态调用
//        var_dump($user->getAttr('name'));
//        var_dump($user->name);
//        var_dump($user['data']);

        Session::set('userInfo',$res);
        //登录成功
        $msgResp=[
            'code'=>10001,
            'msg'=>config('msg')['login']['success'],
            'data'=>[]
        ];
        return json($msgResp);

    }
    //个人中心页面
    public function showPersonal(){
        $userInfo=Session::get('userInfo');
        if(empty($userInfo)){
            $this->error('非法闯入，跳转到首页。。。','index/Index/index',3);
        }
        $data=db('questionnaire')->where('q_user',$userInfo['u_id'])->order('q_id desc')->paginate(3);//查询一个数据使用

//        $data=[1,2,3];
//        $this->assign('data',$data);
        $keyWord=input('?get.keyWord')?input('keyWord'):'';
        $page=$data->render();
        $this->assign('questionnaire',$data);
        $this->assign('keyWord',$keyWord);
        $this->assign('page',$page);
        return $this->fetch('personalView');
    }
    //选择问卷类型页面
    public function showChooseType(){
        $userInfo=Session::get('userInfo');
        if(empty($userInfo)){
            $this->error('非法闯入，跳转到首页。。。','index/Index/index',3);
        }

        return $this->fetch('chooseTypeView');
    }
    //生成问卷页面
    public function showCreate(){
        $userInfo=Session::get('userInfo');
        if(empty($userInfo)){
            $this->error('非法闯入，跳转到首页。。。','index/Index/index',3);
        }

        return $this->fetch('creatView');
    }
    //生成问卷页面
    public function showDesign(){
        $userInfo=Session::get('userInfo');
        if(empty($userInfo)){
            $this->error('非法闯入，跳转到首页。。。','index/Index/index',3);
        }
        $q_id=input('?get.q_id')?input('q_id'):'';
        $data=db('questionnaire')->where('q_id',$q_id)->find();//查询一个数据使用
//        return $this->fetch('designView');
        return $this->fetch('designView',['data'=>$data]);
//        return $this->redirect('designView',['data'=>$data]);
    }
    //添加问卷
    public function createQuestionnaire(){
        $userInfo=Session::get('userInfo');
        if(empty($userInfo)){
            $this->error('非法闯入，跳转到首页。。。','index/Index/index',3);
        }
        $q_title=input('?post.q_title')?input('q_title'):'';
        $u_id=Session::get('userInfo')['u_id'];

//        // 添加单条数据
//        db('user')->insert($q_title);

        $data = ['q_title' => $q_title, 'q_user' => $u_id];
        $res=Db::name('questionnaire')->insertGetId($data);

        if($res>0){
            $msgResp=[
                'code'=>20001,
                'msg'=>config('msg')['oper']['add'],
                'data'=>$res
            ];
            return json($msgResp);
        }else{
            $msgResp=[
                'code'=>20002,
                'msg'=>config('msg')['oper']['addFail'],
                'data'=>$res
            ];
            return json($msgResp);
        }
    }
    //添加问卷题目插入数据库
    public function insertQuestion(){
        $userInfo=Session::get('userInfo');
        if(empty($userInfo)){
            $this->error('非法闯入，跳转到首页。。。','index/Index/index',3);
        }
        $q_id=input('?get.q_id')?input('q_id'):'';
        $questionStr=input('?post.questionStr')?input('questionStr'):'';
        $questionArr=json_decode($questionStr);

//        $data1=['q_name'=>$questionArr[0]->q_name,'q_id'=>$q_id];
//        $id=Db::name('question')->insertGetId($data1);
//        exit();
//        foreach($questionArr as $value){
//            $data1=['q_name'=>$value->q_name,'q_questionnaire'=>$q_id];
//            $id=Db::name('question')->insertGetId($data1);
//            foreach($value->q_options as $val){
//                $data2=['o_name'=>$val->o_name,'o_question'=>$id];
//                Db::name('option')->insert($data2);
//            }
//        }
//        exit();

// 启动事务
        Db::startTrans();
        try{
            foreach($questionArr as $value){
                $data1=['q_name'=>$value->q_name,'q_questionnaire'=>$q_id];
                $id=Db::name('question')->insertGetId($data1);
                foreach($value->q_options as $val){
                    $data2=['o_name'=>$val->o_name,'o_question'=>$id];
                    Db::name('option')->insert($data2);
                }
            }
            // 提交事务
            Db::commit();
            $msgResp=[
                'code'=>20001,
                'msg'=>config('msg')['oper']['add'],
                'data'=>[]
            ];
            return json($msgResp);

        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            $msgResp=[
                'code'=>20002,
                'msg'=>config('msg')['oper']['addFail'],
                'data'=>[]
            ];
            return json($msgResp);
        }
    }
    //删除问卷
    public function deleteWj(){
        $userInfo=Session::get('userInfo');
        if(empty($userInfo)){
            $this->error('非法闯入，跳转到首页。。。','index/Index/index',3);
        }
        $id=input('?get.id')?input('id'):'';
        $where=['q_id'=>$id];
        $res=db('questionnaire')->where($where)->find();
//        var_dump($res);exit;
        if(!empty($res)){
            // 条件删除
            $res=db('questionnaire')->where($where)->delete();

            if(!empty($res)){
                $msgResp=[
                    'code'=>20003,
                    'msg'=>config('msg')['oper']['del'],
                    'data'=>[]
                ];
                return json($msgResp);
            }else{
                $msgResp=[
                    'code'=>20001,
                    'msg'=>config('msg')['oper']['delFail'],
                    'data'=>[]
                ];
                return json($msgResp);
            }
        }
    }
    //搜索问卷
    public function searchWj(){
        $userInfo=Session::get('userInfo');
        if(empty($userInfo)){
            $this->error('非法闯入，跳转到首页。。。','index/Index/index',3);
        }
//        $keyWord=input('?post.keyWord')?input('keyWord'):'';
        $keyWord=input('?get.keyWord')?input('keyWord'):'';
        $pageNow=input('?get.page')?input('page'):'';
        $where=[];
        $whereOr=[];
        if(!empty($keyWord)){
            $where['q_title']=['like',"%{$keyWord}%"];
            $whereOr['q_directions']=['like',"%{$keyWord}%"];
        }
        //查询缓存
        $data=Cache::get("wjx_{$keyWord}_{$pageNow}");
        if(!$data){
            $data=db('questionnaire')
                ->where($where)->whereOr($whereOr)->order('q_id desc')->paginate(3,false,[
                    'query'=> ['keyWord'=>$keyWord],
                ]);

//            ,true,[
//                'query'=> ['keyWord'=>$keyWord],
////                    'path'=>url('/index/Index/searchWj',"?keyWord={$keyWord}")
//            ]


//        $data=db('questionnaire')->field('q_id,q_title,q_directions')
//            ->where('q_title|q_directions','like',"%{$keyWord}%")->fetchSql(true)->paginate(3);
            //设置缓存
            Cache::set("wjx_{$keyWord}_{$pageNow}",$data,3600);
        }
        $page=$data->render();
        $this->assign('questionnaire',$data);
        $this->assign('keyWord',$keyWord);
        $this->assign('page',$page);
        return $this->fetch('personalView');
//        return json($data);

    }

    //秒杀测试
    //添加库存数据
    public function stockAdd(){
        $redis =new \Redis();
        $redisCon=$redis->connect('127.0.0.1',6379);
        $result=$redis->lpush('stock',1);
        var_dump($result);
    }
    //检测库存数据
    public function stockCheck(){
        $redis =new \Redis();
        $redisCon=$redis->connect('127.0.0.1',6379);
        $result=$redis->lsize('stock');
        var_dump($result);
    }
    //模拟并发秒杀，减少库存
    public function redisSK(){
        $redis =new \Redis();
        $redisCon=$redis->connect('127.0.0.1',6379);
        $stock=$redis->lpop('stock');
        if($stock){//只要队列的返回值不是false，那么久表示有库存，可以进行秒杀
            file_put_contents('secondKill.txt','秒杀成功一次',FILE_APPEND);
        }
    }
    */
}


