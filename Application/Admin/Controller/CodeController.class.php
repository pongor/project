<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/6/30
 * Time: 16:38
 */

namespace Admin\Controller;


use Think\Controller;

class CodeController extends Controller
{
    public function index(){
        $model = D('Codes');
        $p = intval(I('get.p'));
        $page = $p >0  ? ($p-1)*10 : 0;
        $data = $model ->getList('',$page,10);

        $this->assign('page',page('Codes','',10));
        $this->assign('list',$data);
        $this->display();
    }

    public function generate(){
        $number = intval(I('get.number'));

        if($number <= 0){
            return false;
        }

        $str = '234567890qwertyuiopasdfghjkzxcvbnm';
        $data = array();

        for($i=0;$i<$number;$i++){
            $temp = '';
            for($j=0;$j<6;$j++){
                $temp .= $str[rand(0,strlen($str)-1)];
            }
            $data[$i]['code'] = $temp;
            $data[$i]['status'] = 1;
            $data[$i]['at_time'] = time();
        }
        $model = D('Codes');
        if($model->getAddAll($data)){
            $this->success('成功生成',U('Code/index'));
        }

    }
}