<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/6/30
 * Time: 16:22
 */

namespace Admin\Controller;


use Think\Controller;

class AdvertisingController extends Controller
{
    public function index(){
        $model = D('Advertisement');
        $p = intval(I('get.p'));
        $page = $p >0  ? ($p-1)*10 : 0;
        $data = $model ->getList('',$page,10);

        $this->assign('page',page('Advertisement','',10));
        $this->assign('list',$data);
        $this->display();
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
        $model = D('advertisement');
        $data = [  $field => $name];
        $res = $model -> getUpdate(array('id'=> $id),$data);

        if($res){
            echo json_encode(array('error'=>0,'msg'=>'修改成功'));die;
        }else{
            echo json_encode(array('error'=>1,'msg'=>'数据错误'));die;
        }
    }

}