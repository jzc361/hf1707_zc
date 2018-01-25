<?php

/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/12/10
 * Time: 18:23
 */
class UserModel extends Model{
    function uploadImg($u_id,$path){
        $sql="update t_user set avatarUrl={$path} where u_id={$u_id}";
        $this->db->dealSql($sql);
        return $this->db->isSuccess();
    }
    function getUser($start,$size){
        $sql="select * from t_user ORDER BY u_id desc LIMIT {$start},{$size}";
        $data=$this->db->getData($sql);
        return $data;
    }
    function getState($u_id){
        $sql="select u_state from t_user where u_id=?";
        $values=[$u_id];
        $rows=$this->db->getPrepareData($sql,'i',$values);
        return $rows;
    }
    function changeState($u_id,$u_state){
        $sql="update t_user set u_state=? where u_id=?";
        $values=[$u_state,$u_id];
        $res=$this->db->prepareSql($sql,'si',$values);
        return $res;
    }
    function resetPwd($id){
        $sql="update t_user set u_pwd='e10adc3949ba59abbe56e057f20f883e' where u_id=?";
        $values=[$id];
        $res=$this->db->prepareSql($sql,'i',$values);
        return $res;
    }

}