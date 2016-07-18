<?php
namespace Backend\Controller;
use Backend\Controller\AutuController;
use Think\Controller;
class IndexController extends AutuController {
    public function index(){
        $model = D('Company');
        $r = $model -> getInfo(array('id' => $this->user_id));
        $this->assign('data',$r);
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
        $model = D('Company');
        $r = $model -> getUpdate(array('id'=>$this->user_id),$data);
        if($r){
            echo json_encode(array('error'=>0,'msg'=>'修改成功'));die;
        }else{
            echo json_encode(array('error'=>0));die;
        }
    }
}