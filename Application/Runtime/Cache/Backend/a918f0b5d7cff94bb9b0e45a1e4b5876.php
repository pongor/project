<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>实习独立说</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="/project/Public/Backend/css/reset.css" type="text/css" rel="stylesheet"/>
    <link href="/project/Public/Backend/css/style.css" type="text/css" rel="stylesheet" />
    <script src="/project/Public/Backend/js/jquery2.1.4.min.js"></script>
    <script src="/project/Public/Backend/js/font.js"></script>
    <script src="/project/Public/Backend/js/function.js"></script>
</head>
<body>
		<div class="wrap">
			<!--导航栏-->
			<nav class="nav">
    <div class="bg_nav"></div>
    <a href="<?php echo U('Personnel/index');?>"><div class="tab2_nav">
        <img class="imgPractice_nav" src="/project/Public/Backend/img/icon-talent.png" />
        <span class="text_nav">人才</span>
    </div></a>
    <a href="<?php echo U('Personnel/student');?>"><div class="tab2_nav">
        <img class="imgPractice_nav" src="/project/Public/Backend/img/icon-appraise.png" />
        <span class="text_nav">实习评价</span>
    </div></a>
    <a href="<?php echo U('Index/index');?>"><div class="tab2_nav">
        <div class="boxMy_nav"><img class="imgMy_nav" src="/project/Public/Backend/img/icon-head3.jpg" /></div>
        <span class="boxMytext_nav textChecked_nav">我的</span>
    </div></a>
</nav>
			<!--页面内容-->
			<section class="content">
				<div class="main">
					<!--头部-->
					<header class="header">
						<!--公众号二维码链接-->
						<div class="QRcodeBox_header">
							<a href="QRcode_etp.html"><div class="QRcode_header">
								<img src="/project/Public/Backend/img/icon-QRcode.png" />
								<span>独立说公号</span>
							</div></a>
						</div>
						<!--头像-->
						<div class="head_header"><img src="<?php echo ($data['headimg'] ? $data['headimg'] :$data['headimgurl']); ?>" /></div>
						<!--名字-->
						<span class="name_header"><?php echo ($data["name"]); ?></span>
						<!--tab-->
						<div class="tabBar_header">
							<div class="tab2_header checkedTab_header">个人信息</div>
						</div>
					</header>
					<!--内容-->
					<section class="section">
						<!--个人信息-->
						<div class="information_etp">
							<a href="<?php echo U('Index/edit');?>"><img class="btnEdit" src="/project/Public/Backend/img/btn-edit.png"></a>
							<img class="iconInfo" src="/project/Public/Backend/img/icon-info-phone.png" />
							<p class="textInfo"><?php echo ($data["phone"]); ?></p>
							<img class="iconInfo" src="/project/Public/Backend/img/icon-info-firm.png" />
							<p class="textInfo"><?php echo ($data["company"]); ?></p>
							<img class="iconInfo" src="/project/Public/Backend/img/icon-info-department.png" />
							<p class="textInfo"><?php echo ($data["department"]); ?></p>
							<img class="iconInfo" src="/project/Public/Backend/img/icon-info-position.png" />
							<p class="textInfo"><?php echo ($data["postition"]); ?></p>
						</div>
					</section>
				</div>
			</section>
		</div>
</body>
</html>