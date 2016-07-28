<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		
       if(!I('post.')){
       	   $this->display();die;
       }
	   //var_dump(I('post.'));die;
	   
	   $phonecode=I('post.code');
	   $phonecode = "'".$phonecode."'" ;	
	   $code=session('code');

	   if($phonecode!=$code){
	   	   exit("验证码有误");
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
	   cookie("name",$bool['nickname']);
	   session("id",$bool['id']);
       echo 1;  		
            	
		
    }

	public function sendcode(){

		if(!I('post.')){
			exit('无有效提交数据');
		}
	        session('code',null);
		$mobile=I('post.mobile');

				
		if(!preg_match("/^1[34578]\d{9}$/", $mobile)){
			exit("请输入正确的手机号码");			
		}
	    
		 $code = rand(pow(10,(6-1)), pow(10,6)-1);
		// $content="您本次注册的验证码：".$code.",如有打扰请自动忽略【独立说】";
		
		
		// $account=xm000046;$password=123456;
		
		// $url="http://dx.ipyy.net/sms.aspx?action=send&userid=&account=".$account."&password=".$password."&mobile=".$mobile."&content=".$content."&sendTime=&extno=";
		// $ch = curl_init($url) ;
		// curl_setopt($ch, CURLOPT_POST, 1);
		// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		// curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

		// $result = curl_exec($ch) ;
		// curl_close($ch) ;
		

  //      $postObj  = simplexml_load_string($result);
  //      $message  = $postObj->message;
       
  //      if($message!='操作成功'){
  //        	exit('发送失败');
  //      }
           $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";

			 //$mobile_code = random(6,1);
			
		   $post_data = "account=cf_dulishuo&password=8fe9440996ea437beb66aef3af0da48b&mobile=".$mobile."&content=".rawurlencode("您的验证码为：{$code}。仅用于手机登录，请勿告知他人。");
			
			//密码为APIKEY（可以登录用户中心查看）
			$gets =  xml_to_array(Post($post_data, $target));

			if($gets['SubmitResult']['code']==2){
				//$_SESSION['mobile'] = $mobile;
				$code = "'".$code."'" ;
				session('code',$code);
				echo 1 ;
			}

	}
}