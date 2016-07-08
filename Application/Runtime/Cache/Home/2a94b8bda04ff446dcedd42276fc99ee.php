<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>实习独立说</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="/project/Public/Home/css/reset.css" type="text/css" rel="stylesheet"/>
    <link href="/project/Public/Home/css/style.css" type="text/css" rel="stylesheet" />
    <script src="/project/Public/Home/js/jquery2.1.4.min.js"></script>
    <script src="/project/Public/Home/js/font.js"></script>
    <script src="/project/Public/Home/js/function.js"></script>
</head>
<body>
		<div class="wrap">
			<!--导航栏-->
			<nav class="nav">
				<div class="bg_nav"></div>
				<a href="offer_stu.html"><div class="tab_nav">
					<img class="imgPractice_nav" src="/project/Public/Home/img/icon-practice.png" />
					<span class="text_nav">实习</span>
				</div></a>
				<a href="home_stu.html"><div class="tab_nav">
					<div class="boxMy_nav"><img class="imgMy_nav" src="<?php echo ($data["headimgurl"]); ?>" /></div>
					<span class="boxMytext_nav textChecked_nav">我的</span>
				</div></a>
			</nav>
			<!--页面内容-->
			<section class="content">
				<!--顶部提示栏-->
				<div class="tiptop BGtiptop"><table><tr><td>
					完善个人信息才能让企业看到你哦
				</td></tr></table></div>
				<!--页面主要内容-->
				<div class="main">
					<!--头部-->
					<header class="header">
						<!--公众号二维码链接-->
						<div class="QRcodeBox_header">
							<a href="QRcode.html"><div class="QRcode_header">
								<img src="/project/Public/Home/img/icon-QRcode.png" />
								<span>独立说公号</span>
							</div></a>
						</div>
						<!--头像-->
						<div class="head_header"><img src="<?php echo ($data["headimgurl"]); ?>" /></div>
						<!--名字-->
						<span class="name_header"><?php echo ($data["nickname"]); ?></span>
						<!--简介／描述-->
						<p class="intro_header"><?php if($data['desc'] == ''){ ?>40字以内描述一下自己是个什么样的高端人才<br/>让企业值得拥有你，知道自己的能力与目标很重要<?php }else{ ?> <?php echo ($data["desc"]); } ?></p>
						<!--tab-->
						<div class="tabBar_header">
							<div class="tab_header myInfo checkedTab_header">个人信息</div>
							<div class="tab_header myResume">我的简历</div>
						</div>
					</header>
					<!--内容-->
					<form class="form" method="post">
					<section class="section">
						<!--编辑信息-->
						<div class="editInfo clearfix myInfo-block">
							<!--姓名-->
							<div class="inputBox_edit width_100">
								<span class="inputTitle1_edit">姓名</span>
								<input class="input_edit" name="name" value="<?php echo ($data["name"]); ?>" />
							</div>
							<!--手机-->
							<div class="inputBox_edit width_100">
								<span class="inputTitle1_edit">手机</span>
								<input class="input_edit" name="mobile" value="<?php echo ($data["mobile"]); ?>" type="tel" maxlength="11" />
							</div>
							<!--年级-->
							<div class="inputBox_edit width_100">
								<span class="inputTitle1_edit">年级</span>
								<input class="input_edit" name="grade" value="<?php echo ($data["grade"]); ?>" />
							</div>
							<!--学校-->
							<div class="inputBox_edit width_100">
								<span class="inputTitle1_edit">学校</span>
								<input class="input_edit" name="school" value="<?php echo ($data["school"]); ?>" />
							</div>
							<!--专业-->
							<div class="inputBox_edit width_100">
								<span class="inputTitle1_edit">专业</span>
								<input class="input_edit" name="major" value="<?php echo ($data["major"]); ?>" />
							</div>
							<!--优先实习时间-->
							<div class="clearfix">
								<!--开始时间-->
								<div class="inputBox_edit width_11r left">
									<span class="inputTitle2_edit">优先实习时间</span>
									<input class="input2_edit" name="intern" value="<?php echo ($data["intern"]); ?>" />
								</div>
								<!--结束时间-->
								<img class="arrow_edit" src="/project/Public/Home/img/icon-arrow.png" />
								<div class="inputBox_edit width_452r left">
									<input class="input2_edit" name="enddate" value="<?php echo ($data["enddate"]); ?>" />
								</div>
							</div>
							<!--自我描述-->
							<div class="textareaBox_edit">
								<textarea maxlength="40" name="desc" placeholder="40字以内描述一下自己是个什么样的高端人才，让企业值得拥有你，知道自己的能力很重要"><?php echo ($data["desc"]); ?></textarea>
								<span class="valueLength_edit"><span class="trueLength">0</span>/40</span>
							</div>
							<p class="tip_edit"></p>
							<!--保存按钮-->
							<button class="button-red saveInfo">保存信息</button>
						</div>

						<!--简历部分-->
						<div class="resume myResume-block" style="display: none;">
							<!--未上传-->
							<div class="Upload_resume">
								<img src="/project/Public/Home/img/icon-UploadResume.png" />
								<button class="button-red UploadResume_btn">上传我的简历</button>
							</div>
							<!--已上传-->
							<div class="Lookat_resume" style="display: none;">
								<button class="button-resume margin_23467r LookatResume_btn">刘水音简历.PDF</button>
								<button class="button-red" onclick="window.location.href='uploadInPC_stu.html'">重新上传简历</button>
							</div>
						</div>
					</section>
					</form>
				</div>
			</section>
			<div class="popup" <?php if(session('code')){ ?> style="display:none" <?php } ?> >
				<div class="bg_popup"></div>
				<div class="box_popup box_popup_editInfo">
					<p class="tiltle_code_popup">请输入官方验证码</p>
					<div class="inputBox_code_popup"><input type="tel" name="password" maxlength="6" unselectable="off" /></div>
					<button class="button-red login">登&nbsp;&nbsp;&nbsp;录</button>
				</div>
			</div>
		</div>
<script>
	$(function(){
		$('.login').click(function(){
			if($("input[name='password']").val().length == 6){
				var code = $("input[name='password']").val();
				$.post('<?php echo U("Index/checkCode");?>',{'code':code},function (res) {
					 var data = $.parseJSON(res);
					if(data.error == 0 ){
						$('.popup').css('display','none');
						return true;
					}else{
						alert(data.msg);
						return false;
					}
				});

			}
		});
		/**
		 * editInfo_stu.html
		 * 点击保存时进行验证
		 *
		 */
		$('.saveInfo').click(function(){
			var phoneReg = /^1[34578]\d{9}$/; //手机正则
			if($("input[name='name']").val() == ''){
				$('.tip_edit').html('请填写真实姓名');
				return false;
			}else if( !phoneReg.exec($("input[name='mobile']").val()) ){
				$('.tip_edit').html('请填写正确手机号');
				return false;
			}else if($("input[name='grade']").val() == ''){
				$('.tip_edit').html('请填写年级');
				return false;
			}else if($("input[name='college']").val() == ''){
				$('.tip_edit').html('请填写学校');
				return false;
			}else if($("input[name='major']").val() == ''){
				$('.tip_edit').html('请填写专业');
				return false;
			}else if($("input[name='startTime']").val() == ''){
				$('.tip_edit').html('请填写可开始实习时间截点');
				return false;
			}else if($("input[name='endTime']").val() == ''){
				$('.tip_edit').html('请填写实习结束时间截点');
				return false;
			}else if($("textarea[name='intro']").val() == ''){
				$('.tip_edit').html('请填写自我描述');
				return false;
			}else{
				$('.tip_edit').html('');
				var json = $("form").serialize();
				$.post('<?php echo U("Index/user");?>',{'obj':json},function (result) {
					var info = $.parseJSON(result);
					if(info.error == 0){
						window.location.href="<?php echo U('Index/index');?>";
					}else{
						alert(info.msg);
						return ;
					}
				});
			}
		});
	});

</script>
</body>
</html>