<?php
class LoginModel extends Model{
//    public function autoLogin($userId){
//        $sql="SELECT * from t_emp where e_account='{$userId}'";
//        $rows=$this->db->getData($sql);
//        return $rows;
//    }
    public function updateLocation(){

        $sql="SELECT e_state from t_emp where e_account=?";
        $rows=$this->db->getPrepareData($sql,'s',$values);
        return $rows;
    }
    public function weLogin($userInfo,$location){
        $newUser='wjx_'.time();
        $sql="INSERT into t_user VALUES(DEFAULT,'{$newUser}',DEFAULT,now(),'{$userInfo['nickName']}','{$userInfo['avatarUrl']}','{$userInfo['gender']}','{$userInfo['city']}','{$userInfo['province']}','{$userInfo['country']}',{$location['latitude']},{$location['longitude']},'{$userInfo['openid']}')";
        $res=$this->db->dealSql($sql);
        return $this->db->isSuccess();
    }

    public function getState($account){
        $values=[$account];
        $sql="SELECT e_state from t_emp where e_account=?";
        $rows=$this->db->getPrepareData($sql,'s',$values);
        return $rows;
    }
    public function login($account,$password){
//        $account="test' or 1=1 -- ";
//        $account=addslashes($account);
//        $sql = "SELECT * from t_emp where e_account='{$account}' and e_pwd='{$password}'";
//        $rows=$this->db->getData($sql);
        $values=[$account,$password];
        $sql="SELECT a.*,b.* from t_emp a,t_role b where a.e_role=b.r_id and a.e_account=? and a.e_pwd=? and a.e_state='使用'";
        $rows=$this->db->getPrepareData($sql,'ss',$values);
        return $rows;
    }
    public function menu($role){
        $sql="SELECT DISTINCT a.* from t_menu a LEFT JOIN t_perm c on a.m_id=c.p_menu  LEFT JOIN t_emp b on c.p_role=b.e_role WHERE c.p_role={$role} ORDER BY a.m_id";
        $rows=$this->db->getData($sql);
        return $rows;
    }
    public function updatePwd($e_id,$e_pwd){
        $sql="update t_emp set e_pwd=? where e_id=?";
        $values=[$e_pwd,$e_id];
        $res=$this->db->prepareSql($sql,'si',$values);
        return $res;
    }

//    public function updateAutoLogin($random,$userId){
//        $sql = "UPDATE t_emp SET e_autoLogin='{$random}' WHERE e_account='{$userId}';";
//        $this->db->dealSql($sql);//更新用户自动登录码
//        return $this->db->isSuccess();
//    }
//    public function updateLoginTime($loginTime,$userId){
//        $sql = "UPDATE t_emp SET e_loginTime='{$loginTime}' WHERE e_account='{$userId}';";
//        $this->db->dealSql($sql);//更新用户自动登录码
//        return $this->db->isSuccess();
//    }
//    public function tmenu(){
//        $sql="SELECT * from t_tmenu";
//        $rows=$this->db->getData($sql);
//        return $rows;
//    }

}