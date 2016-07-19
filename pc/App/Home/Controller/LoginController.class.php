<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
		
       if(!I('post.')){
       	   $this->display();
       }
	   //var_dump(I('post.'));die;
	   
	   $phonecode=I('post.code');
	   $phonecode = "'".$phonecode."'" ;	
	   $code=session('code');
       
	   if($phonecode!=$code){
	   	   //exit("验证码有误");
		   exit($code.'--'.$phonecode);
	   }
	   
	   session('code',null); 
       	   
	   $data['mobile'] = (I('post.phone'));
       $bool=M('Users')->where($data)->find();
	   
       if(!$bool){
       	    exit('手机号错误');
       } 
	   
       //session('uid',$bool,24*3600);         //服务器存id字段,以方便对登录作校验
       //cookie('uname',$Auser['username'],24*3600);  //客户端存账户字段
	   
	   //一切OK后,返回1
	   cookie("name",$username);
	   session("id",$bool['id']);
       echo 1;  		
            	
		
    }
	public function sendcode(){
		if(!$_POST){
			exit('无有效提交数据');
		}
	    session('code',null);
		$mobile=I('post.mobile');
				
		if(!preg_match("/^1[34578]\d{9}$/", $mobile)){
			exit("请输入正确的手机号码");			
		}
	    
		$code = rand(pow(10,(6-1)), pow(10,6)-1);
		$content="您本次注册的验证码：".$code.",如有打扰请自动忽略【易知星球】";
		
		$account=AA00395;$password=AA00395zse;
		$account=xm000046;$password=123456;
		
		$url="http://dx.ipyy.net/sms.aspx?action=send&userid=&account=".$account."&password=".$password."&mobile=".$mobile."&content=".$content."&sendTime=&extno=";
		$ch = curl_init($url) ;
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

		$result = curl_exec($ch) ;
		curl_close($ch) ;
		

        $postObj  = simplexml_load_string($result);
        $message  = $postObj->message;
        
        if($message!='操作成功'){
        	exit('发送失败');
        }
		
		//$code = 555555;
        $code = "'".$code."'" ;		 
		session('code',$code);
        
        echo 1 ;

	}
}