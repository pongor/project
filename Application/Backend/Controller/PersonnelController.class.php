<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/13
 * Time: 18:19
 */

namespace Backend\Controller;
use Think\Controller;


class PersonnelController extends AutuController
{
     public function __construct()
    {   
        parent::__construct();
        if(D('Company')->where('id='.$this->user_id)->find()){
            
        }else{
             redirect(U('Login/index'));return ;
        }

    }
    public function index(){
        $model = D('Users');
        $data['is_check']=1;
        $data['status']=3;
        
       
        $sql = "select u.id,u.nickname,u.name,u.headimgurl,u.at_time,u.grade,u.school,u.headimg,u.major,u.address,u.intern,u.enddate,(select id from  pushs where user_id = u.id and user_status = 1) as status_l from users as u  where  u.status = 3 and u.show = 1 order by status_l asc,u.at_time desc";
      //   $r=$model->where($data)->field('id,nickname,name,headimgurl,grade,school,major,intern,enddate')->select();
        $r = D('users')->query($sql);
        
        //$r = $model->getList(" is_check = 1 and resume!= '' and status = 1");
        foreach ($r as $key => $value) {
        	if(isset($value['id']) && $value['id'] > 0){
             $map['user_id']=$value['id'];
             $map['user_status']=1;
             $bool=M('Pushs')->where($map)->find();
             if($bool){
                $r[$key]['user_status']=1 ;
             }else{
                $r[$key]['user_status']=0 ;
             }
         }
        }
        $this->assign('list',$r);

        //dump($r);
        //$sql = "select u.* from house as h left JOIN  users as u on u.id = h.user_id WHERE h.company_id = $this->user_id order by h.at_time desc";       
        //$model = D('Problem');
        //$r = $model->getSql($sql); //收藏
        $info = M("Company")->where('id='.$this->user_id)->getField('headimg');
        $xxxx= M("Company")->where('id='.$this->user_id)->getField('headimgurl');
        $info = $info ? $info :$xxxx;
        $this->assign('info',$info);
        $this->assign('user_id',$this->user_id);
        //$this->assign('ress',$r);
        //dump($r);//die;
        $this->display('studentList_etp');
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
        //$data['user_status']=M("Pushs")->where('user_id='.$id)->getField('user_status');
        $map['user_id']=$id;
        $map['user_status']=1;
        $bool = M("Pushs")->where($map)->find();
        //dump($bool);die;
        if($bool){
            //如果存在就是被录取了,接下来获取录取人的id
             $company_id=$bool['company_id'];
             $nb='nb';
             $this->assign('nb',$nb);

        }else{
            //如果不存在就是没被录取,那就看是否有本人信息
            $tmp['user_id']=$id;
            $tmp['company_id']=$this->user_id;
            $bool=M('Pushs')->where($tmp)->getField('user_status');
            if($bool==3){
                $data['result'] ='yifasong';
            }else{
                $data['result'] ='weifasong';
            }
        }
        //dump($data);die;
        $this->assign('data',$data);
        $selfimg=M("Company")->where('id='.$this->user_id)->getField('headimgurl');
        $this->assign('selfimg',$selfimg);
        $this->assign('id',$this->user_id);
        //dump($data);
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
        $user_id= $this->user_id;
        $data =  $model->getOffer('pushs.company_id = '.$user_id);
        $info = M("Company")->where('id='.$this->user_id)->getField('headimgurl');
        //dump($data);
        $this->assign('info',$info);
        $this->assign('data',$data);
        if(empty($data)){
            $this->display('no_stu');die;
        }
        //dump($data);
        $model=M('Pushs');
        foreach ($data as $key => $value) {
        	if(isset($value['id']) && $value['id'] > 0){
        	$tmp['user_id']=$value['id'];
            $tmp['user_status']=1;
        	$bool=$model->where($tmp)->find();
            
        	if($bool){
        		
        		if($user_id==$bool['company_id']){
        			$data[$key]['user_status']=1;   //被自己录取
                    $data[$key]['comment']=M('Comment_records')->where('user_id='.$value['id'])->getField('content');
        		}else{
                    $data[$key]['user_status']=2;   //被他人录取
                }

        	}else{
        		$data[$key]['user_status']=3 ;     	//未被任何人录取	 
        	 }
            }
        }
        $this->assign('data',$data);
        $this->display();
    }
    //评价学生
    public function comment(){
        $id = intval(I('get.id'));
        if($id <= 0 ) die('系统错误............');
        $model = D('Users');
        $Problem = D('Problem');
        $user_id=$this->user_id;
        $list = $Problem->getList(array('status = 1'));
        $data = $model->getInfo(array('id'=>$id));
        $res = M('internship_records')->where(array('user_id'=>$id,'q_id'=>$this->user_id))->find();
        $selfimg=M("Company")->where('id='.$this->user_id)->getField('headimgurl');
        
        $model=M('Comment_records');

        $tmp['user_id']=$id;
        $tmp['com_id']=$this->user_id;
        $content=$model->where($tmp)->find();
        $content=$content['content'];  
        
        $this->assign('content',$content);
        $this->assign('selfimg',$selfimg);
        $this->assign('data',$data);
        $this->assign('list',$list);
       

        if(!I('get.mode')){
        	$res=unserialize($res['comment']);
            $this->assign('pro',$res);
            $this->display('save');die;
        }
        $this->assign('pro',$res);
        $this->display();
    }
    //保存评价的信息
    public function commentsave(){
        if(!IS_POST) return ;
        $blem = serialize($_POST['blem']);
        $user_id = intval(I('post.id'));
        //$comtent = $_POST['appraise'];
        $data['com_id']=$this->user_id;
        $data['user_id']=$user_id;


        //先查询是否存在对该学生的评价,存在就更新,不存在就添加
        $bool=M('Comment_records')->where($data)->find();
        if($bool){
             $data['content']=I('post.appraise');
             $bool=M('Comment_records')->where('id='.$bool['id'])->save($data); 
        }else{
             $data['content']=I('post.appraise');
             $bool=M('Comment_records')->add($data);
        }
        
        if($bool===false){
            exit('更新教师对学生的评价错误');
        }
        $map['status'] = 1 ;
        M("Pushs")->where('user_id='.$user_id)->save($map);

        $xyz = M('internship_records');

        
        $res = $xyz->where(array('user_id'=>$user_id,'q_id'=>$this->user_id))->find();
       // dump($xyz->_sql());die;
        //dump($res);//die;

        if($res){ //更新
            //$sql = "update internship_records set comment='{$blem}' where id = {$res['id']}";
            //$model = D('Problem');
            //$r = $model->getInsert($sql);
            //dump($res);die;
            $map='';
            $map['user_id']=$user_id;
            $map['dates']=date('Y/m/d');
            $map['comment']=$blem;
            $map['q_id']=$this->user_id;

            $r=$xyz->where('id='.$res['id'])->save($map);
            //dump($xyz->_sql());die;
        }else{ //新增
            //$sql = "insert into internship_records (id,user_id,dates,comment,q_id,student_id) values( null,{$user_id},'".date('Y/m/d')."','{$blem}',{$this->user_id},{$user_id})'";
            $map='';
            $map['user_id']=$user_id;
            $map['dates']=date('Y/m/d');
            $map['comment']=$blem;
            $map['q_id']=$this->user_id;
            $r=$xyz->add($map);
            //$model = D('Problem');
            //$r = $model->getInsert($sql);
        }
        if($r!==false){
            redirect(U('Personnel/comment',array('id'=>$user_id)));die;
        }else{
            
            echo '<script>alert("保存失败")</script>';die;
            //echo '<script>window.history.back();</script>';die;
        }
    }
    public function save(){
        //$user_id=session('user_id');
        $id = intval(I('get.id'));
        $model = D('Users');
        $Problem = D('Problem');
        $res = M('internship_records')->where(array('user_id'=>$id,'q_id'=>$this->user_id))->find();
        //dump($res);
        $list = $Problem->getList(array('status = 1'));
        $data = $model->getInfo(array('id'=>$id));
        $model=M('Comment_records');
        $content=$model->where('user_id='.$id)->find();
        $content=$content['content']; 
        $selfimg=M("Company")->where('id='.$this->user_id)->getField('headimgurl');
        $this->assign('selfimg',$selfimg);      
        $this->assign('content',$content);
        $this->assign('data',$data);
        $this->assign('list',$list);
        $this->assign('ign',isset($res['content']) ? $res['content'] : '');
        $this->assign('pro',isset($res['comment']) ?  unserialize($res['comment']) : '');
        $this->display();
    }
    public function collect(){
        $model = D('Users');
        $info = M("Company")->where('id='.$this->user_id)->getField('headimgurl');
        $this->assign('info',$info);
        //$r=$model->field('id,nickname,name,headimgurl,grade,school,major,intern,enddate')->select();
        //$r = $model->getList(" is_check = 1 and resume!= '' and status = 1");
        //$this->assign('list',$r);
        $sql = "select u.* from house as h left JOIN  users as u on u.id = h.user_id WHERE h.company_id = $this->user_id order by h.at_time desc";       
        $model = D('Problem');

        $r = $model->getSql($sql); //收藏
        $this->assign('user_id',$this->user_id);
        $this->assign('ress',$r);
        $this->display('studentcollectionList_etp');
    }

    public function readPdf(){
       


        $user_id=intval(I('get.uid'));
        $info=M("Users")->where('id='.$user_id)->getField('resume');
        if(!$info){
            $this->error('该同学没有上传简历','/Backend/Personnel/detail/id/'.$user_id,'2');
        }

        $type=$this->get_device_type();
       
        if($type == 'android'){
             $this->redirect('Login/test',array('pdf' => $user_id));die;
        }  
        $file=$file='./upload/file/'.$user_id.'.pdf';
        
        header('Content-type: application/pdf'); 
        header('filename='.$file); 
        readfile($file);
    }

    function get_device_type()
        {
         //全部变成小写字母
         $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
         $type = 'other';
         //分别进行判断
         if(strpos($agent, 'iphone') || strpos($agent, 'ipad'))
        {
         $type = 'ios';
         } 
          
         if(strpos($agent, 'android'))
        {
         $type = 'android';
         }
         return $type;
        }
}
