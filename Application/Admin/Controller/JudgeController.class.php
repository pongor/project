<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/6/30
 * Time: 15:51
 */

namespace Admin\Controller;


use Think\Controller;

class JudgeController extends Controller
{
    public function index(){
        $model = D('Judge');

        $model = D('Judge');
        $p = intval(I('get.p'));
        $page = $p >0  ? ($p-1)*10 : 0;
        $data = $model ->getList('',$page,10);

        $this->assign('page',page('Judge','',10));
        $this->assign('list',$data);
        $this->display();
    }
    //添加问题
    public function add(){
        if(!IS_POST){
            return ;
        }
        $name = I('post.name');
        if(!$name){
            echo json_encode(array('error'=>1,'msg'=>'数据错误'));die;
        }
        $model = D('Judge');
        $data = [
            'content' => $name,
            'orders' => 0,
            'status' => 1
        ];
        $id = $model->getAdd($data);
        if($id){
            echo json_encode(array('error'=>0,'msg'=>'添加成功'));die;
        }
    }
    //修改名称
    public function update(){
        if(!IS_POST){
            return false;
        }
        $name = I('post.name');
        $id = intval(I('post.id'));
        $field = I('post.field');
        if($id <= 0){
            echo json_encode(array('error'=>1,'msg'=>'参数错误'));die;
        }
        $model = D('Judge');
        $data = [   $field => $name];
        $res = $model -> getUpdate(array('id'=> $id),$data);
        if($res){
            echo json_encode(array('error'=>0,'msg'=>'修改成功'));die;
        }else{
            echo json_encode(array('error'=>1,'msg'=>'数据错误'));die;
        }
    }
}