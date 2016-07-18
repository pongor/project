<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/12
 * Time: 15:44
 */

namespace Home\Model;


use Think\Model;

class RecordsModel extends Model
{
    protected $tableName = 'internship_records';

    public function getInsert($data){
        return $this->add($data);
    }
    public function getDel($where){
        return $this->where($where)->delete();
    }
    public function getUpdate($where,$data){
        return $this->where($where)->save($data);
    }
    public function getList($where){
        return $this->where($where)->order(' id desc')->select();
    }
    public function getInfo($where){
        return $this->where($where)->find();
    }

}