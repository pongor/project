<?php

/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/13
 * Time: 15:08
 */
namespace Backend\Model;
use Think\Model;
class CompanyModel extends Model
{
    public function getUpdate($where,$data){
        return $this->where($where)->save($data);
    }
    public function getInfo($where){
        return $this->where($where)->find();
    }
    public function getInsert($data){
        return $this->add($data);
    }

}