<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/6/30
 * Time: 16:43
 */

namespace Admin\Model;


use Think\Model;

class CodesModel extends Model
{
    public function getList($where = '',$limit,$page=10){
        return $this->where($where)->order('at_time asc')->limit($limit,$page)->select();
    }

    public function getAddAll($data){
        return $this->addAll($data);
    }
}