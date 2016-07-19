<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/14
 * Time: 17:59
 */

namespace Backend\Model;


use Think\Model;

class HouseModel extends Model
{
    public function getInsert($data){
        return $this->add($data);
    }
    public function getDel($where){
        return $this->where($where)->delete();
    }
    public function getInfo($where){
        return $this->where($where)->find();
    }

}