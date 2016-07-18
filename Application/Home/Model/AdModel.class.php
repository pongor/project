<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/12
 * Time: 15:17
 */

namespace Home\Model;


use Think\Model;

class AdModel extends Model
{
    protected $tableName = 'advertisement';

    public function getInfo(){
        return $this->where('file != "" ')->order('orders asc')->find();
    }

}