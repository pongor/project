<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/6/30
 * Time: 15:20
 */

namespace Admin\Controller;


use Think\Controller;

class StudentController extends Controller
{
    public function index(){

        $model = D('Student');
        $p = intval(I('get.p'));
        $page = $p >0  ? ($p-1)*10 : 0;
        $data = $model ->getList('',$page,10);

        $this->assign('page',page('Student','',10));
        $this->assign('list',$data);
        $this->display();
    }
    public function detail(){
        $id = intval(I('get.id'));
        $info = D('Student')->getInfo(array('id'=>$id));
        $Records = D('Records')->getList(array('student_id'=>$id));
        $this->assign('records',$Records);
        $this->assign('data',$info);
        $this->display();
    }
    //修改状态
    public function status(){
        if(!IS_POST){
            return;
        }
        $id = intval(I('post.id'));
        $status = intval(I('post.status'));

        $model = D('Student');
        $res =  $model -> getUpdate(array('id'=>$id),array('status'=>$status));
        if($res){
            echo json_encode(array('error'=>0));die;
        }
    }
}