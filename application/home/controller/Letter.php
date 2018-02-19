<?php
namespace app\home\controller;
use \think\Controller;
use \think\Db;
use \think\Request;
use \think\Cache;
use \think\captcha;
class Letter extends Auth
{
    public function __construct(Request $request){
        parent::__construct($request);
    }
    //私信页面
    public function letter(){
//        $data=Db::query("select a.*,count(a.l_user) l_count,count(a.l_read=1 or null) unread,b.headimg from
//            (select *,rever l_user from zc_letter where sender=?
//            union select *,sender l_user from zc_letter where rever=? ORDER BY msgTime desc) a
//            LEFT JOIN zc_user b on a.l_user=b.userid GROUP BY l_user",[$this->zc_user['userid'],$this->zc_user['userid']]);
//        $a=Db::query("select *,rever l_user from zc_letter where sender=?
//            union select *,sender l_user from zc_letter where rever=? ORDER BY msgTime desc" ,[$this->zc_user['userid'],$this->zc_user['userid']]);
        $t_letter=db('letter')
            ->field('*,rever l_user')
            ->where('sender',$this->zc_user['userid'])
            ->union("select *,sender l_user from zc_letter where rever={$this->zc_user['userid']} order by msgTime desc")
            ->select(false);
        $data=Db::table("($t_letter) a")
            ->field("a.*,count(a.l_user) l_count,count(a.l_read=1 and a.sender!={$this->zc_user['userid']} or null) unread,b.headimg,b.username")
            ->join('zc_user b','a.l_user=b.userid')
            ->group('a.l_user')
            ->paginate(5);
//        $data=Db::field('name')
//            ->table('select *,rever l_user from zc_letter where sender=?
//                    union select *,sender l_user from zc_letter where rever=? ORDER BY msgTime desc')
//            ->order('msgTime desc')
//            ->select(false);
        $listCount=Db::table("($t_letter) a")->count('distinct(l_user)');
//        var_dump($listCount);
        $this->assign('letterList',$data);
        $this->assign('listCount',$listCount);

        $this->assign('do',$this->do);
        return $this->fetch();
    }
    //私信记录页面
    public function history(){
        $page=input('?get.page')?input('page'):1;
        $l_user=input('?get.l_user')?input('l_user'):'';
        $userInfo=db('user')->where('userid',$l_user)->field('headimg,username,userid')->find();
        //更新私信为已读
        db('letter')
            ->where("sender={$this->zc_user['userid']} and rever={$l_user}")
            ->whereOr("rever={$this->zc_user['userid']} and sender={$l_user}")
            ->update(['l_read'=>'0']);
        $data=db('letter')
            ->where("sender={$this->zc_user['userid']} and rever={$l_user}")
            ->whereOr("rever={$this->zc_user['userid']} and sender={$l_user}")
            ->order('msgTime desc')
            ->page($page,2)
            ->select();
//            ->paginate(5,false,[
//                'query'=>request()->param()
//            ]);
//        var_dump($data);
        $this->assign('historyList',$data);
        $this->assign('userInfo',$userInfo);
        $this->assign('do',$this->do);
        return $this->fetch();
    }
    //私信记录页面-获取私信记录数据流
    public function historyFlow(){
        $page=input('?get.page')?input('page'):2;
        $l_user=input('?get.l_user')?input('l_user'):'';
        $userInfo=db('user')->where('userid',$l_user)->field('headimg,username,userid')->find();
        $pages=db('letter')
            ->where("sender={$this->zc_user['userid']} and rever={$l_user}")
            ->whereOr("rever={$this->zc_user['userid']} and sender={$l_user}")
            ->count();
        $data=db('letter')
            ->where("sender={$this->zc_user['userid']} and rever={$l_user}")
            ->whereOr("rever={$this->zc_user['userid']} and sender={$l_user}")
            ->order('msgTime desc')
            ->page($page,2)
            ->select();
        $reMsg=[
            'code'=>20007,
            'msg'=>config('Msg')['oper']['select'],
            'data'=>[
                'data'=>$data,
                'pages'=>$pages,
                'userInfo'=>$userInfo
            ]
        ];
        return json($reMsg);
    }
    //打开发送私信窗口
    public  function openLetter(){
        $rever=input('?get.rever')?input('rever'):"";
        if(empty($this->zc_user)){
            $msgResp=[
                'code'=>00000,
                'msg'=>config('msg')['nologin']['nologin'],
                'data'=>''
            ];
        }else if($rever==$this->zc_user['userid']){
            $msgResp=[
                'code'=>70004,
                'msg'=>config('msg')['letter']['selfError'],
                'data'=>''
            ];
        }else{
            $msgResp=[
                'code'=>70005,
                'msg'=>config('msg')['letter']['open'],
                'data'=>''
            ];
            $this->assign('rever',$rever);
        }
        return json($msgResp);
    }
    //发送私信窗口
    public  function letterWindow(){
        $rever=input('?get.rever')?input('rever'):"";
        $this->assign('rever',$rever);
        return $this->fetch();
    }
    //发送私信
    public  function sendLetter(){
        $code=input('?post.sendCode')?input('sendCode'):"";
        $letter=input('?post.letter')?input('letter'):"";
        $rever=input('?get.rever')?input('rever'):"";
        //验证码
        if(!captcha_check($code)){
            //验证失败
            $reMsg=[
                'code'=>70003,
                'msg'=>config('Msg')['letter']['codeFail'],
                'data'=>[]
            ];
            return json($reMsg);
        }
        $res=db('letter')->insert([
            'sender'=>$this->zc_user['userid'],
            'rever'=>$rever,
            'msgTime'=>date('Y-m-d H:i:s'),
            'content'=>$letter
        ]);
        if($res>0){
            $msgResp=[
                'code'=>70001,
                'msg'=>config('msg')['letter']['success'],
                'data'=>''
            ];
        }else{
            $msgResp=[
                'code'=>70002,
                'msg'=>config('msg')['letter']['error'],
                'data'=>''
            ];
        }
        return json($msgResp);
    }
    //删除某联系人所有私信
    public function delLetter(){
        $rever=input('?get.rever')?input('rever'):"";
        if(!empty($rever)){
            $res=db('letter')
                ->where("sender={$this->zc_user['userid']} and rever={$rever}")
                ->whereOr("rever={$this->zc_user['userid']} and sender={$rever}")
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
        }else{
            $msgResp=[
                'code'=>20004,
                'msg'=>config('msg')['oper']['delFail'],
                'data'=>''
            ];
        }
        return json($msgResp);
    }
    //删除某联系人单条私信
    public function delOneLetter(){
        $l_id=input('?get.l_id')?input('l_id'):"";
        if(!empty($l_id)){
            $res=db('letter')
                ->where('l_id',$l_id)
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
        }else{
            $msgResp=[
                'code'=>20004,
                'msg'=>config('msg')['oper']['delFail'],
                'data'=>''
            ];
        }
        return json($msgResp);
    }
    //验证码
    public function captcha(){
        $config =    [
            // 验证码字体大小
            'fontSize'    =>    16,
            // 验证码位数
            'length'      =>    3,
            // 关闭验证码杂点
            'useNoise'    =>    false,
        ];
        $captcha = new Captcha($config);
        return $captcha->entry();
    }

}


