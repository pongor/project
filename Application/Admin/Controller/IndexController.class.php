<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

        $this->display();
    }
    public function left(){
        $this->display();
    }
    public function right(){
        $model = D('Industry');
        $p = intval(I('get.p'));
        $page = $p >0  ? ($p-1)*10 : 0;
       $res =  $model->getList(array('valid'=>1),$page,10);
        $this->assign('data',$res);
        $this->assign('page',page('Industry',array('valid'=>1),10));
        $this->display();
    }
    //添加行业
    public function industry(){
        if(!IS_POST){
            return ;
        }
        $name = I('post.name');
        if(!$name){
            echo json_encode(array('error'=>1,'msg'=>'数据错误'));die;
        }
        $model = D('Industry');
        $data = [
            'name' => $name,
            'valid' => 1,
            'at_time' => time()
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
        if($id <= 0){
            echo json_encode(array('error'=>1,'msg'=>'参数错误'));die;
        }
        $model = D('Industry');
        $data = [   'name' => $name];
        $res = $model -> getUpdate(array('id'=> $id),$data);
        if($res){
            echo json_encode(array('error'=>0,'msg'=>'修改成功'));die;
        }else{
            echo json_encode(array('error'=>1,'msg'=>'数据错误'));die;
        }
    }
    //所有的文件上传操作
    public function upload(){
         $path = I('post.path');
        $model_name = I('post.model');
        $id = intval(I('post.id'));

        if($id <= 0) {
            echo json_encode(array('error'=>1,'msg'=>'参数错误'));die;
        }
        mkDirs($path);
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     $path; // 设置附件上传根目录
        $upload->savePath   =    './'.$id.'/';
        $upload->saveName  =     time().'_'.mt_rand();
        // 上传文件
        $info   =   $upload->uploadOne($_FILES['file']);
        if(!$info) {// 上传错误提示错误信息
            echo json_encode(array('error'=>1,'msg'=>$upload->getError()));die;
        }else{// 上传成功
            $file = $info['savepath'].$info['savename'];
        }
        $file =  ltrim($path,'.').ltrim($file,'./');
        $model = D($model_name);
        $data = [
            'file' => $file
        ];
        $res = $model->getUpdate(array('id'=>$id),$data);
        if($res){
            echo json_encode(array('error'=>0,'msg'=>'文件上传成功','file'=>$file));die;
        }else{
            echo json_encode(array('error'=>2,'msg'=>'保存失败，请刷新后重新上传'));die;
        }
    }
}