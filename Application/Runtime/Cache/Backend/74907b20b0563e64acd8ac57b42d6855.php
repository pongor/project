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
		        <img class="imgPractice_nav" src="/Public/Backend/img/icon-appraiseChecked.png" />
		        <span class="textChecked_nav">实习评价</span>
		    </div></a>
		    <a href="<?php echo U('Index/index');?>"><div class="tab2_nav">
		        <div class="boxMy2_nav"><img class="imgMy_nav" src="<?php echo ($info); ?>" /></div>
		        <span class="boxMytext_nav text_nav">我的</span>
		    </div></a>
		</nav>
			<!--页面内容-->
			<div class="content">
				<div class="height_oneScreen">
					<div class="main_noInvitation">
						<img src="/Public/Backend/img/icon-noInvitation.png" />
						<p class="tipText">您还没有招收实习生哦！</p>
						<p class="tipText">去人才库看看吧</p>
					</div>
				</div>
			</div>
		</div>
</body>
</html>