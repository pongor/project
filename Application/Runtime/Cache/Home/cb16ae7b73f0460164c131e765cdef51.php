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
			        <img class="imgPractice_nav" src="/Public/Home/img/icon-practiceChecked.png" />
			        <span class="textChecked_nav">实习</span>
			    </div></a>
			    <a href="<?php echo U('Index/index');?>"><div class="tab_nav tab_off_nav">
			        <div class="boxMy2_nav"><img class="imgMy_nav" src="<?php echo ($data['headimg']?$data['headimg']:$data['headimgurl']); ?>" /></div>
			        <span class="boxMytext_nav text_nav">我的</span>
			    </div></a>
			</nav>
			<!--页面内容-->
			<div class="content">
				<div class="height_oneScreen">
					<div class="main_noInvitation">
						<img src="/Public/Home/img/icon-noInvitation.png" />
						<p class="tipText">你还没有实习邀请哦！</p>
						<p class="tipText">先去优化简历吧</p>
					</div>
				</div>
			</div>
		</div>
</body>
</html>