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
        $allRole = Db::name('role')->select();
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
            return $res;
        }else{
            return $res;
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
            return $res;
        }else{
            return $res;
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
                //

                    if ($updatemenu != 0) {
                        $res = [
                            'code' => '20005',
                            'msg' => config('msg')['oper']['update'],
                            'data' => ''
                        ];
                        return $res;
                    }
            }
            else{
                return $res;
            }

        }
    }

    //角色/////////////////////////////

    //员工//////////////////////////////

    //查询所有员工
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
            return $res;
        }else{
            return $res;
        }
    }
}