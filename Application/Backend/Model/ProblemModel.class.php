<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/18
 * Time: 10:28
 */

namespace Backend\Model;


use Think\Model;

class ProblemModel extends Model
{
    protected $tableName  = 'judge_questions';

    public function getList($where){
        return $this->where($where)->order(' orders asc ')->select();
    }
    public function getInsert($data){

        return $this->execute($data);

    }
    public function getSql($sql){
        return $this->query($sql);
    }

}