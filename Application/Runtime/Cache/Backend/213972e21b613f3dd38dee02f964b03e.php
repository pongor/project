<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>实习独立说</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="/Public/Backend/css/reset.css" type="text/css" rel="stylesheet"/>
    <link href="/Public/Backend/css/style.css" type="text/css" rel="stylesheet" />
    <script src="/Public/Backend/js/jquery2.1.4.min.js"></script>
    <script src="/Public/Backend/js/font.js"></script>
    <script src="/Public/Backend/js/function.js"></script>
</head>
<body>
		<div class="wrap">
			<!--导航栏-->
		<nav class="nav">
    <div class="bg_nav"></div>
    <a href="<?php echo U('Personnel/index');?>"><div class="tab2_nav">
        <img class="imgPractice_nav" src="/Public/Backend/img/icon-talent.png" />
        <span class="text_nav">人才</span>
    </div></a>
    <a href="<?php echo U('Personnel/student');?>"><div class="tab2_nav">
        <img class="imgPractice_nav" src="/Public/Backend/img/icon-appraise.png" />
        <span class="text_nav">实习评价</span>
    </div></a>
    <a href="<?php echo U('Index/index');?>"><div class="tab2_nav">
        <div class="boxMy_nav"><img class="imgMy_nav" src="<?php echo ($data['headimg'] ? $data['headimg'] :$data['headimgurl']); ?>" /></div>
        <span class="boxMytext_nav textChecked_nav">我的</span>
    </div></a>
</nav>
			<!--页面内容-->
			<section class="content">
				<!--页面主要内容-->
				<div class="main">
					<!--头部-->
					<header class="header">
						<!--公众号二维码链接-->
						<div class="QRcodeBox_header">
							<a href="QRcode_etp.html"><div class="QRcode_header">
								<img src="/Public/Backend/img/icon-QRcode.png" />
								<span>独立说公号</span>
							</div></a>
						</div>
						<!--头像-->
						<div class="head_header"><img src="<?php echo ($data['headimg'] ? $data['headimg'] : $data['headimgurl']); ?>" /></div>
						<!--名字-->
						<span class="name_header"><?php echo ($data['name']?$data['name']:$data['nickname']); ?></span>
						<!--tab-->
						<div class="tabBar_header">
							<div class="tab2_header checkedTab_header">个人信息</div>
						</div>
					</header>
					<!--内容-->

					<section class="section">
						<form method="post" class="from">
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
								<input class="input_edit" name="phone" type="tel" maxlength="11" value="<?php echo ($data["phone"]); ?>" />
							</div>
							<!--公司-->
							<div class="inputBox_edit width_100">
								<span class="inputTitle1_edit">公司</span>
								<input class="input_edit" name="company"  value="<?php echo ($data["company"]); ?>"/>
							</div>
							<!--部门-->
							<div class="inputBox_edit width_100">
								<span class="inputTitle1_edit">部门</span>
								<input class="input_edit" name="department" value="<?php echo ($data["department"]); ?>"/>
							</div>
							<!--职位-->
							<div class="inputBox_edit width_100">
								<span class="inputTitle1_edit">职位</span>
								<input class="input_edit" name="postition" value="<?php echo ($data["postition"]); ?>"/>
							</div>
							<p class="tip_edit"></p>
							<!--保存按钮-->
							<button type="button" class="button-red saveInfo_etp">保存信息</button>
						</div>
					</form>
						<!--简历部分-->
						<div class="resume myResume-block" style="display: none;">
							<!--未上传-->
							<div class="Upload_resume">
								<img src="/Public/Backend/img/icon-UploadResume.png" />
								<button class="button-red UploadResume_btn">上传我的简历</button>
							</div>
							<!--已上传-->
							<div class="Lookat_resume" style="display: none;">
								<button class="button-resume margin_23467r LookatResume_btn">刘水音简历.PDF</button>
								<button class="button-red" onclick="window.location.href='uploadInPC_stu.html'">重新上传简历</button>
							</div>
						</div>
					</section>

				</div>
			</section>
		</div>
<script>
	$(function(){
		/**
		 * editInfo_etp.html
		 * 点击保存时进行验证
		 *
		 */
		$('.saveInfo_etp').click(function(){
			var phoneReg = /^1[34578]\d{9}$/; //手机正则
			if($("input[name='name']").val() == ''){
				$('.tip_edit').html('请填写真实姓名');
				return false;
			}else if( !phoneReg.exec($("input[name='phone']").val()) ){
				$('.tip_edit').html('请填写正确手机号');
				return false;
			}else if($("input[name='company']").val() == ''){
				$('.tip_edit').html('请填写公司');
				return false;
			}else if($("input[name='department']").val() == ''){
				$('.tip_edit').html('请填写部门');
				return false;
			}else if($("input[name='postition']").val() == ''){
				$('.tip_edit').html('请填写职位');
				return false;
			}else{
				$('.tip_edit').html('');
				var str = $('.from').serialize();
				$.post('<?php echo U("Index/saves");?>',{'str':str},function (res) {
					var data = $.parseJSON(res);
					if(data.error == 0){
						window.location.href="<?php echo U('Index/index');?>";
					}
				});
			}
		});
	});
</script>
</body>
</html>