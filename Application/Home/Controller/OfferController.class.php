<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/11
 * Time: 15:06
 */

namespace Home\Controller;


use Think\Controller;

class OfferController extends AutuController
{
    public function index(){
        //获取学生获得的通过的面试邀请
        $model = D('Pushs');
        $data = $model->getList(array('pushs.user_id'=>$this->user_id,'pushs.user_status'=>3)); //获取到用户所有的待处理邀请
       
        $this->assign('list',$data);
        $this->display();
    }

    //接受企业邀请
    public function accept(){
        if(!IS_POST) return;
        $id = intval(I('post.id')); //企业id
        if($id <= 0) return;
        $model = D('pushs');
        $res = $model->getUpdate("user_id= $this->user_id and company_id =$id","user_status = 1");
        if($res){
            echo json_encode(array('error'=>0,'msg'=>'以成功接受offer'));die;
        }else{
            echo json_encode(array('error'=>1,'msg'=>'未找到企业发送的offer申请'));die;
        }
    }
    //实习记录
    public function record(){
        $model = D('Users');
        $data = $model -> getInfo(array('id'=>$this->user_id));
        $ad = D('Ad');
        $ad = $ad->getInfo();
        //获取实习几率
        $record = D('Records');
        $list = $record->getList(array('user_id' => $this->user_id));
        $this->assign('data',$data);
        $this->assign('ad',$ad);
        $this->assign('list',$list);
        $this->display();
    }
    //天假实习记录
    public function addrecord(){
        $id = intval(I('get.id'));
        if($id > 0 ){
            $model = D('Records');
            $data = $model->getInfo(array('id' => $id));
            $this->assign('data',$data);
        }
        $this->display();
    }
    //保存天假的实习记录
    public function add(){
        if(!IS_POST) return;
        $id = intval(I('post.id'));
        $con = I('post.con');
        if(!$con) return;
        $model = D('Records');
        if($id > 0 ){
            $r = $model -> getUpdate(array('id' => $id),array('content' => $con));
            if($r){
                echo json_encode(array('error' => 0, 'msg' => '修改成功'));die;
            }else{
                echo json_encode(array('error' =>1,'msg' => '修改失败'));die;
            }
        }
        $data = [
            'user_id'   =>  $this->user_id,
            'student_id'=> $this->user_id,
            'dates'     =>  date('Y/m/d'),
            'content'   =>  $con
        ];
        $res = $model->getInsert($data);
        if($res){
            echo json_encode(array('error' => 0, 'msg' => '添加成功'));die;
        }else{
            echo json_encode(array('error' =>1,'msg' => '添加失败'));die;
        }

    }
    //删除实习几率
    public function del(){
        if(!IS_POST) return;
        $id = intval(I('post.id'));
        $model = D('Records');
        $r = $model->getDel(array('id'=>$id,'user_id' => $this->user_id));
        if($r){
            echo json_encode(array('error' => 0, 'msg' => '删除成功'));die;
        }else{
            echo json_encode(array('error' =>1,'msg' => '删除失败'));die;
        }
    }
    public function upload(){
        $this->display();
    }

}