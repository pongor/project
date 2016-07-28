<?php 

namespace Admin\Model;


use Think\Model;

class UsersModel extends Model
{
    public function getList($where = '',$limit,$page=10){
        return $this->where($where)->order('at_time desc')->limit($limit,$page)->select();
    }
    public function getInfo($where){
        return $this->where($where)->find();
    }
    //更新
    public function getUpdate($where,$data){
        return $this->where($where)->save($data);
    }

}