<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/6/30
 * Time: 15:51
 */

namespace Admin\Model;


use Think\Model;

class JudgeModel extends Model
{
    protected $tableName = 'judge_questions';

    public function getList($where = '',$limit,$page=10){
        return $this->where($where)->order('orders asc')->limit($limit,$page)->select();
    }
    public function getUpdate($where,$data){
        return $this->where($where)->save($data);
    }
    public function getAdd($data){
        return $this->add($data);
    }

}