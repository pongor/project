<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/8
 * Time: 14:32
 */

namespace Home\Model;


use Think\Model;

class CodesModel extends Model
{
    public function getInfo($where){
        return $this->where($where)->find();
    }
    public function getUpdate($where,$data){
        return $this->where($where)->save($data);
    }

}