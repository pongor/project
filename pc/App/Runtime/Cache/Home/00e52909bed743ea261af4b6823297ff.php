<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>实习独立说</title>
		<link rel="stylesheet" href="/Public/Home/css/reset.css" />
		<link rel="stylesheet" href="/Public/Home/css/style.css" />
		<script type="text/javascript" src="/Public/Home/js/jquery1.9.1.js"></script>
		<script type="text/javascript" src="/Public/Home/js/function.js"></script>
	</head>
	<body>
		<div class="wrap">
			<div class="codeBox">
				<img class="logo_code" src="/Public/Home/img/Logo.png" />
				<div class="inputBox_code marginTop_code">
					<span>手机号</span>
					<input class="input_code long" type="tel" maxlength="11" id="phone" />
				</div>
				<div class="inputBox_code">
					<span>验证码</span>
					<input class="input_code short" type="tel" id="code" />
					<button id="mobile" class="btnShort_code on">发送验证码</button>
				</div>
				<div class="tipBox_code">
					<p style="display: none;"><img src="/Public/Home/img/icon-tip.png" /><span>您的验证码填写错误</span></p>
				</div>
				<button class="btnLang_code" id="submit_btn">确认登录</button>
			</div>
		</div>
	</body>
	<script>
	    $("#mobile").click(function(){
		
		    var mobile = $("#phone").val();
			//alert(mobile);return false;
			validatemobile(mobile);
		})
		
		function validatemobile(mobile) 
		   { 
			   if(mobile.length==0) 
			   { 
				  alert('请输入手机号码！'); 
				  //document.form1.mobile.focus(); 
				  return false; 
			   }     
			   if(mobile.length!=11) 
			   { 
				   alert('请输入有效的手机号码！'); 
				  // document.form1.mobile.focus(); 
				   return false; 
			   } 
				
			   var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[3,6,7,8]{1}))+\d{8})$/; 
			   if(!myreg.exec(mobile)) 
			   { 
				   alert('请输入有效的手机号码！'); 
				   
				   return false; 
			   }else{
					 $.ajax({
							url:'<?php echo U("Home/Index/sendcode");?>',
							type:'post',
							data:{'mobile':mobile},
							aysnc:true,
							success: function(data) {
									//console.log(data);return false;
									//alert(data);
                                    if(data != '1'){
									   alert("发送失败,请稍后再试");
									}else{
									   alert("短信验证码已发送,10分钟内有效");
									   //alert("请输入验证码567890");
										/**
										 * 验证码倒计时
										 */
											var countdown = 60;
											var val = document.getElementById('mobile');
											function settime(){
												if(countdown == 0){
													val.removeAttribute("disabled");
													val.innerHTML = "获取验证码";
													countdown = 60;
													return;
												}else{
													val.setAttribute("disabled",true);
													val.innerHTML = "重新发送"+"("+countdown+")";
													countdown--;
												}
												
												setTimeout(function(){
													settime();
												},1000)
											}
											settime();	
									
									}									
							}
					})		       
			   } 
		   }
	</script>
	<script>
        $("#submit_btn").click(function(){
        	
            var phone = $("#phone").val();
            if(!phone){
            	$("#phone").css({"border-color":"red"});
            	
				setTimeout(function(){
				    $("#phone").attr("value",'');
            	    $("#phone").css({"border-color":"#cac8c5"});
            	    				    
				},1500)
            	return false;
            }

             var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[3,6,7,8]{1}))+\d{8})$/; 
			   if(!myreg.exec(phone)) 
			   { 
				   alert('请输入有效的手机号码！'); 
				   
				   return false; 
			   }

			var code = $("#code").val();
            if(!code){
			    $("#code").attr("type","text");
            	$("#code").css({"border-color":"red"});
            	
				setTimeout(function(){
				    $("#code").attr("value",'');
            	    $("#code").css({"border-color":"#cac8c5"});
            	    
                    			    
				},1500)
            	return false;
            }
			   
			   if(code.length!=6) 
			   { 
				   alert('请输入有效的验证码！'); 
				   return false; 
			   } 
				
			   var myreg = /^[0-9]{6}$/; 
			   if(!myreg.exec(code)) 
			   { 
				   alert('请输入有效的验证码！'); 				   
				   return false; 
			   }
			
			 $.ajax({
					url:'<?php echo U("Home/Index/index");?>',
					type:'post',
					data:{'phone':phone,'code':code},
					success: function(data) {

							if(data != '1' ){
								console.log(data);
								alert(data);
							}else{

							    //alert('登陆成功');
								window.location.href="/Home/Post/index";
							}

									
					}
			})  			

        })
		
	</script>
</html>