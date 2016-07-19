<?php

/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/7
 * Time: 18:00
 */
namespace Home\Model;
use Think\Model;
class UsersModel extends \Think\Model
{
    //保存用户信息
    public function getAdd($data){
        return $this->add($data);
    }
    //查询用户是否存在
    public function getInfo($where){
        return $this->where($where)->find();
    }
    //更新用户信息
    public function getUpdate($where,$data){
        return $this->where($where)->save($data);
    }
}