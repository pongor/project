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
        $data2= $model->getList(array('pushs.user_id'=>$this->user_id,'pushs.user_status'=>1)); //获取用户是否已被录用

        if($data2){
            $model = D('Users');
            $data = $model -> getInfo(array('id'=>$this->user_id));
            $ad = D('Ad');
            $ad = $ad->getInfo();
            //echo '555';
            //获取实习几率
            $record = D('Records');
            $list = $record->getList(array('user_id' => $this->user_id));
            $this->assign('data',$data);
            $this->assign('ad',$ad);
            $this->assign('list',$list);
            //dump($list);die;
            $this->display('record');die;
            //$this->record();
        }elseif($data){
            $user_id=$this->user_id;
            $imgurl=M("Users")->where('id='.$user_id)->getField('headimg');
            $imgurl2=M("Users")->where('id='.$user_id)->getField('headimgurl');
            $imgurl=$imgurl?$imgurl:$imgurl2;
            $this->assign('imgurl',$imgurl);
            $this->assign('list',$data);

            $this->display();die;
        }else{
            $user_id=$this->user_id;
            $imgurl=M("Users")->where('id='.$user_id)->find();
            $this->assign('data',$imgurl);            
        	$this->display('noInvitation_stu');
        }
        
        
        
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
    //添加实习记录   改  :弃用此方法
    public function addrecord(){
        $id = intval(I('get.id'));
        //$id = $this->user_id;

        if($id > 0 ){
            $model = D('Records');
            $data = $model->getInfo(array('id' => $id));
            $this->assign('uid',$id);
            $this->assign('data',$data);
        }
        $this->display();
    }
    //保存添加的实习记录   改 :添加新增实习记录
    public function add(){
        if(!IS_POST) return;
        //$id = intval(I('post.id'));
        $id=$this->user_id;
        $con = I('post.con');
        if(!$con) return;
        $model = D('Records');
        //dump(I('post.'));die;
        if($id > 0 ){
            $mRcorde['dates']=date('Y/m/d');
            $mRcorde['content']=$con ;
            $mRcorde['user_id']=$id ;
            $tmp['user_id']=$id;
            $tmp['user_status']=1;
            $mRcorde['q_id']=M('Pushs')->where($tmp)->getField('company_id');
            $r = $model -> add($mRcorde);
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
    //删除实习记录
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
        $user_id=$this->user_id;
        $imgurl=M("Users")->where('id='.$user_id)->find();
        $this->assign('data',$imgurl);
        $this->display();
    }

    public function updaterecord(){
        $user_id=$this->user_id;
        //dump(I('get.'));die;
        if(!I('get.')){
            $this->display('record');die;
        }
        $pingjia=intval(I('get.id'));
        $info = M('Internship_records')->where('id='.$pingjia)->find();
        $this->assign('pingjia_id',$pingjia);
        $this->assign('data',$info);
        $this->display('updaterecord');
    }

    public function saveupdate(){
        $user_id=$this->user_id;
        if(!I('post.')){
            $this->display('record');die;
        }
        $pingjia_id=intval(I('post.pingjia_id'));
        $data['content']= I('post.con');
        $tmp['user_id']=$user_id;
        $tmp['id']=$pingjia_id;
        $bool = M('Internship_records')->where($tmp)->save($data);
        if($bool){
            echo json_encode(array('error' => 0, 'msg' => '更新成功'));die;
        }else{
            echo json_encode(array('error' => 1, 'msg' => '更新失败'));die;
        }
    }

}