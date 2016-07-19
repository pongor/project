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
    <a href="<?php echo U('Offer/index');?>"><div class="tab_nav">
        <img class="imgPractice_nav" src="/project/Public/Home/img/icon-practiceChecked.png" />
        <span class="textChecked_nav">实习</span>
    </div></a>
    <a href="<?php echo U('Index/index');?>"><div class="tab_nav">
        <div class="boxMy2_nav"><img class="imgMy_nav" src="/project/Public/Home/img/icon-head3.jpg" /></div>
        <span class="boxMytext_nav text_nav">我的</span>
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
						<span class="name_header"><?php echo ($data["name"]); ?></span>
						<!--简介／描述-->
						<p class="intro_header"><?php echo ($data["desc"]); ?></p>
						<!--tab-->
						<div class="tabBar_header">
							<div class="tab_header myInfo checkedTab_header">个人信息</div>
							<div class="tab_header myResume">我的简历</div>
						</div>
					</header>
					<!--内容-->
					<section class="section">
						<!--个人信息-->
						<div class="information myInfo-block">
							<a href="<?php echo U('Index/home');?>"><img class="btnEdit" src="/project/Public/Home/img/btn-edit.png"></a>
							<img class="iconInfo" src="/project/Public/Home/img/icon-info-phone.png" />
							<p class="textInfo"><?php echo ($data["mobile"]); ?></p>
							<img class="iconInfo" src="/project/Public/Home/img/icon-info-grade.png" />
							<p class="textInfo"><?php echo ($data["grade"]); ?></p>
							<img class="iconInfo" src="/project/Public/Home/img/icon-info-college.png" />
							<p class="textInfo"><?php echo ($data["school"]); ?></p>
							<img class="iconInfo" src="/project/Public/Home/img/icon-info-major.png" />
							<p class="textInfo"><?php echo ($data["major"]); ?></p>
							<img class="iconInfo" src="/project/Public/Home/img/icon-info-time.png" />
							<p class="textInfo noMargin">可实习时间 <?php echo ($data["intern"]); ?>-<?php echo ($data["enddate"]); ?></p>
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
				</div>
			</section>
		</div>
<script>
	$(function () {
		<?php  if($data['resume']){ ?>
			$('.Lookat_resume').css('display','block');
			$('.Upload_resume').css('display','none');
			$('.tiptop').css('display','none');
		<?php }else{ $url = U("Offer/upload"); ?>
		$('.UploadResume_btn').click(function(){
			window.location.href="<?php echo ($url); ?>";
		});
		<?php } ?>
	});
</script>
</body>
</html>