<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/13
 * Time: 18:19
 */

namespace Backend\Controller;


class PersonnelController extends AutuController
{
    public function index(){
        $model = D('Users');
        $r = $model->getList(" is_check = 1 and resume!= '' and status = 1");
        $this->assign('list',$r);
       $sql = "select u.* from house as h left JOIN  users as u on u.id = h.user_id WHERE h.company_id = $this->user_id order by h.at_time desc";
        $model = D('Problem');
        $r = $model->getSql($sql); //收藏

        $this->assign('user_id',$this->user_id);
        $this->assign('ress',$r);
        $this->display();
    }
    //收藏处理
    public function house(){
        if(!IS_POST) return;
        $id = intval(I('post.id'));
        if($id <= 0) return;
        $model = D('House');

        $res = $model ->getInfo(array('user_id' => $id,'company_id' => $this->user_id));

        if($res){ //删除收藏
            $r = $model->getDel(array('user_id' => $id,'company_id' => $this->user_id));
            $del = 0;
        }else{  //添加收藏
            $data = [
                'company_id'    =>  $this->user_id,
                'user_id'       =>  $id,
                'at_time'       =>  time()
            ];
            $del = 1;
            $r = $model->getInsert($data);
        }

        if($r){
            echo json_encode(array('error' => 0,'msg' => '添加删除成功','del'=>$del));die;
        }else{
            echo json_encode(array('error' => 1,'msg' => '添加删除失败'));die;
        }
    }
    //学生详情
    public function detail($id=0){
        if($id <= 0) return;
       $model = D('Users');
       $data =  $model->getInfo(array('id'=>$id));
        $this->assign('data',$data);
        $this->assign('id',$this->user_id);
        $this->display();

    }
    //验证企业信息是否完善
    public function offer(){
        if(!IS_POST) return;
        $model = D('Company');
        $res = $model -> getInfo(array('id' =>$this->user_id));
        if($res['name'] && $res['phone'] && $res['company'] && $res['department'] && $res['postition']){
            echo json_encode(array('error' => 0,'msg'=>''));die;
        }else{
            echo json_encode(array('error' =>1,'msg'=>'请先完善个人信息'));die;
        }
    }
    //企业发送offer
    public function sendoffer(){
        if(!IS_POST) return ;
        $model = D('Pushs');
        $id = intval(I('post.id'));
        if($id <= 0) return;
        $data = [
            'company_id'    =>  $this->user_id,
            'user_id'       =>  $id,
            'at_time'       =>  time()
        ];
        $res = $model->getInfo(array('company_id' =>$this->user_id,'user_id' => $id));
        if($res){
            echo json_encode(array('error' => 1,'msg' => '已经发送过邀请了'));die;
        }
        $r = $model->getInsert($data);
        if($r){
            echo json_encode(array('error' => 0,'msg' => '发送成功'));die;
        }else{
            echo json_encode(array('error' => 1,'msg' => '发送失败'));die;
        }
    }
    public function student(){
        $model = D('Pushs');
       $data =  $model->getOffer('pushs.company_id = '.$this->user_id);
        $this->assign('data',$data);
        $this->display();
    }
    //评价学生
    public function comment(){
        $id = intval(I('get.id'));
        if($id <= 0 ) die('系统错误............');
        $model = D('Users');
        $Problem = D('Problem');
        $list = $Problem->getList(array('status = 1'));
        $data = $model->getInfo(array('id'=>$id));
        $res = M('internship_records')->where(array('user_id'=>$id,'q_id'=>$this->user_id))->find();
        $this->assign('data',$data);
        $this->assign('list',$list);
        $this->assign('pro',$res);
        $this->display();
    }
    //保存评价的信息
    public function commentsave(){
        if(!IS_POST) return ;
        $blem = serialize($_POST['blem']);
        $comtent = $_POST['appraise'];
        $user_id = intval(I('post.id'));
        $res = M('internship_records')->where(array('user_id'=>$user_id,'q_id'=>$this->user_id))->find();

        if($res){ //添加
            $sql = "update internship_records set content='{$comtent}',comment='{$blem}' where id = {$res['id']}";
            $model = D('Problem');
            $r = $model->getInsert($sql);
        }else{ //新增
            $sql = "insert into internship_records (user_id,dates,content,comment,q_id,student_id) values({$user_id},'".date('Y/m/d')."','{$comtent}','{$blem}',{$this->user_id},{$user_id})";
            $model = D('Problem');
            $r = $model->getInsert($sql);
        }
        if($r){
            redirect(U('Personnel/save',array('id'=>$user_id)));die;
        }else{
            echo '<script>alert("保存失败")</script>';
            echo '<script>window.history.back();</script>';die;
        }
    }
    public function save(){
        $id = intval(I('get.id'));
        $model = D('Users');
        $Problem = D('Problem');
        $res = M('internship_records')->where(array('user_id'=>$id,'q_id'=>$this->user_id))->find();
        $list = $Problem->getList(array('status = 1'));
        $data = $model->getInfo(array('id'=>$id));
        $this->assign('data',$data);
        $this->assign('list',$list);
        $this->assign('ign',isset($res['content']) ? $res['content'] : '');
        $this->assign('pro',isset($res['comment']) ?  unserialize($res['comment']) : '');
        $this->display();
    }

}