<?php
namespace Home\Controller;
use Think\Controller;
class PostController extends Controller {
    public function index(){
        $this->display('Post/postfile');
    }
	

	
	public function postfile(){
    	$id = intval($_POST['caseId']);
        //var_dump($id);exit;
        $path = $_POST['path'];
        $x=explode("/", $path);
        //var_dump($x);exit;
        $savepath='./upload/tmp/'.$x[3].'/'.$id.'.pdf';
        //echo $savepath;
		    $field = $_POST['field'];
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
        if(!$info){
            exit('文件上传失败');
        }else{
			$oldname = $savepath ;
			$newpath = './upload/../../upload/file/';
			self::mkDirs($newpath);
			$newname = $newpath.'许松'.'.pdf';
			$bool = rename(iconv('UTF-8','GBK',$oldname), iconv('UTF-8','GBK',$newname));
            
			//$bool=rename($oldname,$newname);
			   if ($bool) {		   
				   echo 1 ;
			   }else{
				   echo '文件移动失败';
				   
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