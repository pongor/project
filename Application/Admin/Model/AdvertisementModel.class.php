<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/6/30
 * Time: 16:26
 */

namespace Admin\Model;


use Think\Model;

class AdvertisementModel extends Model
{
    public function getList($where = '',$limit,$page=10){
        return $this->where($where)->order('orders asc')->limit($limit,$page)->select();
    }
    //更新信息
    public function getUpdate($where,$data){ ///
        return $this->where($where)->save($data);
    }
}