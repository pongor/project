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
					<img class="imgPractice_nav" src="img/icon-practice.png" />
					<span class="text_nav">实习</span>
				</div></a>
				<a href="home_stu.html"><div class="tab_nav">
					<div class="boxMy_nav"><img class="imgMy_nav" src="img/icon-head3.jpg" /></div>
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
						<div class="head_header"><img src="/project/Public/Home/img/icon-head3.jpg" /></div>
						<!--名字-->
						<span class="name_header">刘水音</span>
						<!--简介／描述-->
						<p class="intro_header">40字以内描述一下自己是个什么样的高端人才<br/>让企业值得拥有你，知道自己的能力与目标很重要</p>
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
							<a href="editInfo_stu.html"><img class="btnEdit" src="/project/Public/Home/img/btn-edit.png"></a>
							<img class="iconInfo" src="/project/Public/Home/img/icon-info-phone.png" />
							<p class="textInfo">13826482728</p>
							<img class="iconInfo" src="/project/Public/Home/img/icon-info-grade.png" />
							<p class="textInfo">大四</p>
							<img class="iconInfo" src="/project/Public/Home/img/icon-info-college.png" />
							<p class="textInfo">中国传媒大学</p>
							<img class="iconInfo" src="/project/Public/Home/img/icon-info-major.png" />
							<p class="textInfo">新闻传播学</p>
							<img class="iconInfo" src="/project/Public/Home/img/icon-info-time.png" />
							<p class="textInfo noMargin">可实习时间 2016/07/20-2016/09/20</p>
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
</body>
</html>