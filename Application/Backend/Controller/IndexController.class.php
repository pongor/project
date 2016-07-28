<?php
namespace Backend\Controller;
use Backend\Controller\AutuController;
use Think\Controller;
class IndexController extends AutuController {

    public function index(){
        $model = D('Company');       
        $r = $model -> getInfo(array('id' => $this->user_id));
       if(!$r) redirect(U('Login/index'));
      
        $this->assign('data',$r);
        if(!$r['complete']){
            redirect(U('Index/edit'));
            die;
        }
        $this->display();
    }
    public function edit(){
        $model = D('Company');
        $r = $model -> getInfo(array('id' => $this->user_id));
        $this->assign('data',$r);
        $this->display();
    }
    public function saves(){
        if(!IS_POST) return;
        $string = trim($_POST['str']);
        if(!$string) return;
        $arr = explode('&',$string);
        $data = array();
        $str = '';
        for($i=0;$i<count($arr);$i++){
            $str = explode('=',$arr[$i]);
            $data[$str[0]] = urldecode($str[1]);
        }
        $data['complete']=1;
        $model = D('Company');
        $r = $model -> getUpdate(array('id'=>$this->user_id),$data);
        if($r){
            echo json_encode(array('error'=>0,'msg'=>'修改成功'));die;
        }else{
            echo json_encode(array('error'=>0));die;
        }
    }

    public function qrcode(){
        $user_id=$this->user_id;
        $info=M("Company")->where('id='.$user_id)->find();
        $this->assign('data',$info);
        $this->display('QRcode_etp');
    }

    public function upload(){
        //$id = intval(I('post.caseId'));
        $id=$this->user_id;
        
        $path = I('post.path');
        $x=explode("/", $path);
        
        $savepath='./upload/headerimg/backend/';
        
        $field = I('post.field');
    
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     5*1024*1024 ;// 设置附件上传大小
        $upload->exts      =     array('jpeg','png','jpg');// 设置附件上传类型
        $upload->autoSub = false;//关闭子目录
        self::mkDirs($path);
        $upload->rootPath  =  $path; // 设置附件上传根目录
        //$upload->saveName = time().'_'.mt_rand();
        $upload->saveName =(string)$id;
        $upload->replace=true;
        $info   =   $upload->uploadOne($_FILES[$field]);
        //dump($info);die;
        if(!$info){
            exit('文件上传失败');
            //echo $this->error($upload->getError());
        }else{
            
            $data['headimg']='/upload/headerimg/backend/'.$info['savename'];
            //$data['id']=$id;

            $bool=M('Company')->where('id='.$id)->save($data);
            if($bool===false){
                exit('更新数据出错');
            }else{
                echo 1 ;
            }
        }
               
 
    }

    private static function mkDirs($dir){
        if(!is_dir($dir)){
            if(!self::mkDirs(dirname($dir))){
                return false;
            }
            if(!mkdir($dir,0777)){
                return false;
            }
        }
        return true;
    }
}