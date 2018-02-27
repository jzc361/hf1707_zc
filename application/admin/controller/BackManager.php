<?php
namespace app\admin\controller;

//use \think\View;
use \think\Controller;
use \think\Request;
use \think\Db;
use \think\Session;
class Backmanager extends Controller
{

    public function toIframe($htmlName){
        return $this->fetch($htmlName);
    }

    //查询所有角色
    public function allRole(){
        $allRole = Db::name('emp')
            ->alias('a')
            ->join('role b','a.roleid = b.roleid')
            ->select();
        if(count($allRole)>0){
            $res = [
                'code'=>20007,
                'msg'=>config('msg')['oper']['select'],
                'data'=>$allRole
            ];
        }else{
            $res = [
                'code'=>20008,
                'msg'=>config('msg')['oper']['selectFail'],
                'data'=>$allRole
            ];
        }
        return json($res);
    }


    //角色删除
    public function roleDel(){
        $rid = isset($_POST['rid'])?$_POST['rid']:'';
        $res = [
            'code'=>20004,
            'msg'=>config('msg')['oper']['delFail'],
            'data'=>''
        ];

        if($rid!=''){
            //条件
            $where = [
                'roleid'=>$rid
            ];
            //返回值
            $data = db('role')->where($where)->delete();

            if($data!=0){//删除成功
                $res = [
                    'code'=>20003,
                    'msg'=>config('msg')['oper']['del'],
                    'data'=>''
                ];
            }
            return json($res);
        }else{
            return json($res);
        }
    }

    //角色修改
    public function roleEditData(){
        $rid = isset($_POST['rid'])?$_POST['rid']:'';
        $res = [
            'code'=>20008,
            'msg'=>config('msg')['oper']['selectFail'],
            'data'=>''
        ];

        if($rid!=''){
            //条件
            $where = [
                'roleid'=>$rid
            ];
            //返回值

            $menuData = Db::name('backmenu')
                ->field('menuname,menuid,menufid')
                ->select();

            $roleData = Db::name('limit')
                ->alias('a')
                ->join('role b','a.roleid= b.roleid')
                ->where('b.roleid',$rid)
                ->select();
            if($roleData!=''){
                $res = [
                    'code'=>20007,
                    'msg'=>config('msg')['oper']['select'],
                    'data'=>[$menuData,$roleData]
                ];
            }
            return json($res);
        }else{
            return json($res);
        }
    }

    //角色信息修改
    public function roleEdit(){
        //角色id
        $roleid = isset($_POST['roleid'])?$_POST['roleid']:'';

        //角色名
        $rolename = isset($_POST['rolename'])?$_POST['rolename']:'';

        //角色介绍
        $roledetails = isset($_POST['roledetails'])?$_POST['roledetails']:'';

        //返回值
        $res = [
            'code'=>'20006',
            'msg'=>config('msg')['oper']['updateFail'],
            'data'=>''
        ];
        //菜单id
        $menuid = isset($_POST['menuid'])?$_POST['menuid']:'';
        if($roleid==''||$rolename==''||$roledetails==''){
            return $res;
        }else{

            //删除旧数据
            $delRes = db('limit')
                ->where('roleid',$roleid)
                ->delete();
            //更新数据
            //插入数据
            if($delRes!=0) {
                $newmenudata = [];
                foreach ($menuid as $val) {

                    $newmenudata[] = ['roleid' => $roleid, 'menuid' => $val['menuid']];
                }
                $updatemenu = db('limit')->insertAll($newmenudata);

                //更新角色表
                $updaterole = db('role')->where('roleid', $roleid)->update(['rolename' => $rolename, 'roledetails' => $roledetails]);
                //判断更新的返回值与类型
                if($updaterole===false){
                    return json($res);
                }else{
                    if ($updatemenu != 0) {
                        $res = [
                            'code' => '20005',
                            'msg' => config('msg')['oper']['update'],
                            'data' => ''
                        ];
                        return json($res);
                    }
                }
            }
            else{
                return json($res);
            }

        }
    }


    //获取所有菜单数据

    public function getRoleMenu(){
        $menudata = db('backmenu')
            ->select();
        $res = [
            'code'=>20008,
            'msg'=>config('msg')['oper']['selectFail'],
            'data'=>''
        ];
        if($menudata!=''){
            $res = [
                'code'=>20007,
                'msg'=>config('msg')['oper']['select'],
                'data'=>$menudata
            ];
        }
        return json($res);
    }

    //角色添加

    //验证角色唯一性
    public function checkRole(){
            $rolenem = isset($_POST['rolename'])?$_POST['rolename']:"";
            $allRole = Db::name('role')
                ->where('rolename',$rolenem)
                ->select();
            if(count($allRole)>0){
                $res = [
                    'code'=>20007,
                    'msg'=>config('msg')['oper']['select'],
                    'data'=>$allRole
                ];
            }else{
                $res = [
                    'code'=>20008,
                    'msg'=>config('msg')['oper']['selectFail'],
                    'data'=>$allRole
                ];
            }
            return json($res);
        }
    //添加角色
    public function roleAdd(){
        $rolename = isset($_POST['rolename'])?$_POST['rolename']:"";
        $roleintro = isset($_POST['roleintro'])?$_POST['roleintro']:"";
        $rolemenu = isset($_POST['rolemenu'])?$_POST['rolemenu']:"";

        $res = [
            'code' => '20006',
            'msg' => config('msg')['oper']['updateFail'],
            'data' => ''
        ];
        //插入新角色
        $roleRes = Db::name('role')
            ->data(['rolename'=>$rolename,'roledetails'=>$roleintro])
            ->insert();
        //insert succeed
        if($roleRes!=0){

            $newId = Db::name('role')
                ->field('roleid')
                ->where('rolename',$rolename)
                ->find();

            if($newId!=null){
                //find succeed
                $menuinfo = [];
                foreach($rolemenu as $name){
                    //要新增的数据集
                    $menuinfo []= ['menuid' => $name['menuid'], 'roleid' =>$newId];
                }
                //foreach success

                $roleRes = Db::name('limit')->insertAll($menuinfo);

                if($roleRes!=0){
                    $res = [
                        'code' => '20005',
                        'msg' => config('msg')['oper']['update'],
                        'data' => ''
                    ];
                }
            }
        }

        return json($res);
    }




    //角色/////////////////////////////

    //员工//////////////////////////////

    //查询所有员工信息
    public function allEmp(){
        $allEmp = Db::name('emp')
            ->alias('a')
            ->join('role b','a.roleid = b.roleid')
            ->select();
        if(count($allEmp)>0){
            $res = [
                'code'=>20007,
                'msg'=>config('msg')['oper']['select'],
                'data'=>$allEmp
            ];
        }else{
            $res = [
                'code'=>20008,
                'msg'=>config('msg')['oper']['selectFail'],
                'data'=>$allEmp
            ];
        }
        return json($res);
    }

    //员工删除
    public function empDel(){
        $rid = isset($_POST['rid'])?$_POST['rid']:'';
        $res = [
            'code'=>20004,
            'msg'=>config('msg')['oper']['delFail'],
            'data'=>''
        ];

        if($rid!=''){
            //条件
            $where = [
                'empid'=>$rid
            ];
            //返回值
            $data = db('emp')->where($where)->delete();

            if($data!=0){//删除成功
                $res = [
                    'code'=>20003,
                    'msg'=>config('msg')['oper']['del'],
                    'data'=>''
                ];
            }
            return json($res);
        }else{
            return json($res);
        }
    }
}