<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/14
 * Time: 15:38
 */

namespace Backend\Model;


use Think\Model;

class UsersModel extends Model
{
    //获取学生信息列表
    public function getList($where,$order){
        return $this->where($where)->order($order)->select();
    }
    public function getInfo($where){
        return $this->where($where)->find();
    }

}