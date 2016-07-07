<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/6/30
 * Time: 15:43
 */

namespace Admin\Model;


use Think\Model;

class RecordsModel extends Model
{
    protected $tableName = 'internship_records';

    public function getList($where){
        return $this->where($where)->select();
    }
}