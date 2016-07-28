<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>实习独立说</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="/Public/Home/css/reset.css" type="text/css" rel="stylesheet"/>
    <link href="/Public/Home/css/style.css" type="text/css" rel="stylesheet" />
    <script src="/Public/Home/js/jquery2.1.4.min.js"></script>
    <script src="/Public/Home/js/font.js"></script>
    <script src="/Public/Home/js/function.js"></script>
</head>
<body>
		<div class="wrap">
			<!--导航栏-->
			<nav class="nav">
    <div class="bg_nav"></div>
    <a href="<?php echo U('Offer/index');?>"><div class="tab_nav tab_on_nav">
        <img class="imgPractice_nav" src="/Public/Home/img/icon-practice.png" />
        <span class="text_nav">实习</span>
    </div></a>
    <a href="<?php echo U('Index/index');?>"><div class="tab_nav tab_off_nav">
        <div class="boxMy_nav"><img class="imgMy_nav" src="<?php echo ($data['headimg']?$data['headimg']:$data['headimgurl']); ?>" /></div>
        <span class="boxMytext_nav  textChecked_nav">我的</span>
    </div></a>
</nav>
			<!--页面内容-->
			<div class="content">
				<div class="height_oneScreen">
					<!--顶部提示栏-->
					<div class="tiptop BGtiptop"><table><tr><td>
						在电脑上编辑
					</td></tr></table></div>
					<!--内容-->
					<div class="main_editInPc">
						<img src="/Public/Home/img/icon-UploadResumeInPC.png" />
						<p class="tipText">请用PC浏览器打开以下网址<br />http://cv.dulishuo.com<br />并用手机号登录上传简历</p>
						<button class="button-red" onclick="window.location.href='<?php echo U('Index/index');?>'">已在电脑上完成上传</button>
					</div>
				</div>
			</div>
		</div>
</body>
</html>