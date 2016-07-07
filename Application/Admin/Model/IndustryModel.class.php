<?php

/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/6/29
 * Time: 17:12
 */
namespace Admin\Model;
use Think\Model;
class IndustryModel extends Model
{
    public function getList($where = '',$limit,$page=10){
        return $this->where($where)->order('at_time desc')->limit($limit,$page)->select();
    }
    //添加信息
    public function getadd($data){
        return $this->add($data);
    }
    //更新信息
    public function getUpdate($where,$data){
        return $this->where($where)->save($data);
    }
    //获取单挑信息
    public function getFields($where){
        $res = $this->where($where)->find();
        if(!$res){
            return '';
        }

        return isset($res['name']) ? $res['name'] : '';
    }
}