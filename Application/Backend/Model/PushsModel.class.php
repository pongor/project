<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/14
 * Time: 17:50
 */

namespace Backend\Model;


use Think\Model;

class PushsModel extends Model
{
    public function getInfo($where){
        return $this->where($where)->find();
    }
    public function getInsert($data){
        return $this->add($data);
    }
    //获取所有企业发送offer的用户
    public function getOffer($where){
        return $this->where($where)->join(" left join users as u on u.id = pushs.user_id ")->field("Pushs.user_status,Pushs.status,u.nickname,u.id,u.grade,u.school,u.major,headimgurl")->select();

    }

}