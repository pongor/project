<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends AutuController {
    public function index(){ //103e688b8013ae4e53ecb3b67ae81e33
        //获取学生详情100
        $user_id= $this->user_id;
       
        if(!$user_id){
            redirect(U('Login/index'));
        }
        //$data = D('Users')->getInfo(array('id'=>$this->user_id));
        $data=M('Users')->where('id='.$user_id)->find();
        if(!$data)  redirect(U('Login/index'));
        //echo $this->user_id;die; 
        $this->assign('data',$data);


        if($data['complete']==1){
             $this->display('home');    
        }else{
            $this->display('index');
        }
    }
    public function checkCode(){
        if(!IS_POST) return ;
        //dump(I('post.'));die;
        $code = I('post.code');
        $uid = intval(I('post.uid'));
        $model = D('Codes');
        $result = $model->getInfo("code = '{$code}' and status = 1");
        if($result) {
            $model->getUpdate(array('id'=>$result['id']),array('status'=>0));
            D('Users')->getUpdate(array('id'=>$uid),array('is_check' => 1));
            
            $bool=M('Users')->where('id='.$uid)->setField('is_check',1);
            if($bool){
                exit(M('Users')->getLastSql());
            }
            
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
       // dump(I('post.'));die;
        $arr = explode('&',$string);
        $data = array();
        $str = '';
        for($i=0;$i<count($arr);$i++){
            $str = explode('=',$arr[$i]);
            $data[$str[0]] = urldecode($str[1]);
        }
        $data['complete']=1;
        $model = D('Users');
        $user_id=$this->user_id;
        $score=M('Users')->where('id='.$user_id)->getField('status');
        if($data['name']&&($data['mobile'])&&($data['grade'])&&($data['school'])&&($data['major'])&&($data['address'])&&($data['intern'])&&($data['enddate'])&&($data['desc'])){
            
            //基本信息保存完整为1 ,简历保存完整为2 ,同时都有为3 ,初始信息为0
            if($score ==1){
                $data['status'] = 1 ;
            }elseif($score ==2){
                $data['status'] = 3 ;
            }elseif($score ==3){
                $data['status'] = 3 ;
            }else{
                $data['status'] = 1 ;
            }   
        }else{
            //基本信息保存完整为1 ,简历保存完整为2 ,同时都有为3 ,初始信息为0
            if($score ==1){
                $data['status'] = 0 ;
            }elseif($score ==2){
                $data['status'] = 2 ;
            }elseif($score ==3){
                $data['status'] = 2 ;
            }else{
                $data['status'] = 0 ;
            }             
        }
        //dump($data);
        // if(($data['address']=='')||($data['address']=='可实习地点')){
        //     dump( $data['address']); //die;
        // }else{
        //     dump( $data['address']);
        // }
        
        $intern=$data['intern'];
        if(stripos($intern,'/')!==false){
            $arr1=explode('/', $intern);
            $intern=$arr1[2].'.'.$arr1[1].'.'.$arr1[0];
        }

        $data['intern']=$intern;

        $enddate=$data['enddate'];
        if(stripos($enddate,'/')!==false){
            $arr1=explode('/', $enddate);
            $enddate=$arr1[2].'.'.$arr1[1].'.'.$arr1[0];
        }

        $data['enddate']=$enddate;
        $res = $model->getUpdate(array('id'=>$this->user_id),$data);
        if(!($res===false)) {
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

    public function readPdf(){
       
        $user_id=$this->user_id;
        $info=M("Users")->where('id='.$user_id)->getField('resume');
        if(!$info){
            $this->error('该同学没有上传简历','/','2');
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

    public function qrcode(){
        $user_id=$this->user_id;
        $imgurl=M("Users")->where('id='.$user_id)->find();
        $this->assign('data',$imgurl);
        $this->display('QRcode');
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
    public function upload(){
        //$id = intval(I('post.caseId'));
        $id=$this->user_id;
        
        $path = I('post.path');
        $x=explode("/", $path);
        
        $savepath='./upload/headerimg/home/';
        
        $field = I('post.field');
    
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     8*1024*1024 ;// 设置附件上传大小
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
            //exit('文件上传失败');
            //$msg=$this->$upload->getError();
            echo '错误';
        }else{
            
            $data['headimg']='./upload/headerimg/home/'.$info['savename'];
            $image = new \Think\Image(); 
            $image->open($data['headimg']);// 生成一个缩放后填充大小150*150的缩略图并保存为thumb.jpg
            //echo $width = $image->width(); die;
            $image->thumb(150, 150,\Think\Image::IMAGE_THUMB_CENTER)->save('./upload/headerimg/home/'.$id.'.thumb.jpg');
            unlink($data['headimg']);
            $data['headimg']='/upload/headerimg/home/'.$id.'.thumb.jpg';
            $bool=M('Users')->where('id='.$id)->save($data);
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