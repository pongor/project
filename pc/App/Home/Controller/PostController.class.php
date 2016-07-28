<?php
namespace Home\Controller;
use Think\Controller;
class PostController extends Controller {

    public function index(){
		$data['nickname'] = cookie("name");
		$data['id']=    session("id");
		$bool=M('Users')->where($data)->find();
		if(!$bool){
		     $this->error('Please login first !','/',2);
		}
		$this->assign('info',$bool);
        $this->display('Post/postfile');
    }
		
	public function postfile(){
		$data['nickname'] = cookie("name");
		$data['id']= (int)session("id");
		$bool=M('Users')->where($data)->find();
		if(!$bool){
		     $this->error('Please login first !','Home/Index/index',2);
		}


    	$id = intval(I('post.caseId'));
        //var_dump($id);exit;
        $path = I('post.path');
        $x=explode("/", $path);
        //var_dump($x);exit;
        $savepath='./upload/tmp/'.$x[3].'/'.$id.'.pdf';
        //echo $savepath;
		    $field = I('post.field');
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('pdf');// 设置附件上传类型
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
        }else{
			$oldname = $savepath ;
			$newpath = './upload/../../upload/file/';
			self::mkDirs($newpath);
			$newname = $newpath.$bool['id'].'.pdf';
			$bool2 = rename(iconv('UTF-8','GBK',$oldname), iconv('UTF-8','GBK',$newname));
            
			if (!$bool2) {		   
				exit('文件移动失败');
			}
            
        }
        $score=M('Users')->where('id='.$data['id'])->getField('status');
        //基本信息保存完整为1 ,简历保存完整为2 ,同时都有为3 ,初始信息为0
        if($score ==1){
            $mUser['status'] = 3 ;
        }elseif($score ==2){
            $mUser['status'] = 2 ;
        }elseif($score ==3){
            $mUser['status'] = 3 ;
        }else{
            $mUser['status'] = 2 ;
        }        
        $mUser['resume']='./upload/../../upload/file/'.$bool['id'].'.pdf';
        $mUser['pdfname']=$info['name'];
        $mUser['pdfsize']=ceil($info['size']/1024);
        $mUser['uptime']=time();

		$bool=M('Users')->where('id='.$data['id'])->save($mUser);
		//dump($data);
		if($bool===false){
			 exit('Insert into database faild');
	          
		}else{
             echo 1;	  
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

    public function delete(){
 		$data['nickname'] = cookie("name");
		$data['id']=    session("id");
		$bool=M('Users')->where($data)->find();
		if(!$bool){
		     $this->error('Please login first !','/',2);
		}

		$filepath=$bool['resume'];
		$bool=unlink($filepath);
        
        $score=M('Users')->where('id='.$data['id'])->getField('status');
        //基本信息保存完整为1 ,简历保存完整为2 ,同时都有为3 ,初始信息为0
        if($score ==1){
            $data['status'] = 1 ;
        }elseif($score ==2){
            $data['status'] = 0 ;
        }elseif($score ==3){
            $data['status'] = 1 ;
        }else{
            $data['status'] = 0 ;
        } 

		if($bool){
			$data['resume']='';
			$data['uptime']='';
			$data['pdfname']='';
			$data['pdfsize']='';
			$bool=M('Users')->save($data);
		}else{
			exit('Delete is failed');
		}

		if($bool){
			echo 1 ;die;
		}else{
			exit('更新数据出错');
		}
   	
    }

}