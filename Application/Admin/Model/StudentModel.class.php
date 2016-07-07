<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/6/30
 * Time: 15:24
 */

namespace Admin\Model;


use Think\Model;

class StudentModel extends Model
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