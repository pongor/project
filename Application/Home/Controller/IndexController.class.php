<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends AutuController {
    public function index(){ //103e688b8013ae4e53ecb3b67ae81e33
        //获取学生详情100
        $data = D('Users')->getInfo(array('id'=>$this->user_id));
        $this->assign('data',$data);
        $this->display('home');
    }
    public function checkCode(){
        if(!IS_POST) return ;
        $code = I('post.code');
        $model = D('Codes');
        $result = $model->getInfo("code = '{$code}' and status = 1");
        if($result) {
            $model->getUpdate(array('id'=>$result['id']),array('status'=>0));
            D('Users')->getUpdate(array('id'=>$this->id),array('is_check' => 1));
            session('code',1,31536000);
            echo json_encode(array('error'=>0,'msg'=>'验证成功'));die;
        }else{
            echo json_encode(array('error'=>1,'msg'=>'验证失败'));die;
        }
    }
    //保存用户信息
    public function user(){
        if(!IS_POST) return ;
        $string = $_POST['obj'];
        $arr = explode('&',$string);
        $data = array();
        $str = '';
        for($i=0;$i<count($arr);$i++){
            $str = explode('=',$arr[$i]);
            $data[$str[0]] = urldecode($str[1]);
        }
       $model = D('Users');
        $res = $model->getUpdate(array('id'=>$this->user_id),$data);
        if($res) {
            echo json_encode(array('error'=>0,'msg'=>'信息保存成功'));die;
        }else{
            echo json_encode(array('error'=>1,'msg'=>'信息保存失败'));die;
        }
    }
    public function home(){
        $model = D('Users');
        $data = $model->getInfo(array('id'=>$this->user_id));

        $this->assign('data',$data);
        $this->display('index');
    }
    //公众号
    public function qrcode(){

        $this->display();
    }
}