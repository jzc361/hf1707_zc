<?php

/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/12/10
 * Time: 18:23
 */
class QuestionModel extends Model{
    public function insertQuestion($q_id,$questionArr){
        $sqlArr=[];
        foreach($questionArr as $value){    //(DEFAULT,'题目1',1),
            $sqlArr[]="INSERT into t_question VALUES(DEFAULT,'{$value->q_name}',{$q_id})";
            foreach($value->q_options as $val){
                $sqlArr[]="INSERT into t_option VALUES(DEFAULT,'{$val->o_name}',(select MAX(q_id) from t_question))";
            }
        }
        $res=$this->db->dealSqlArr($sqlArr);
        return $res;
    }

}