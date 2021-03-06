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
            <div class="boxMy2_nav"><img class="imgMy_nav" src="<?php echo ($selfimg); ?>" /></div>
            <span class="boxMytext_nav text_nav">我的</span>
        </div></a>
    </nav>
			<!--页面内容-->
			<section class="content">
				<!--页面主要内容-->
				<div class="main">
					<!--头部-->
					<header class="header">
						<!--占位-->
						<div class="QRcodeBox_header">
						</div>
						<!--头像-->
						<div class="head_header"><img src="<?php echo ($data['headimg']?$data['headimg']:$data['headimgurl']); ?>"  /></div>
						<!--名字-->
						<span class="name_header"><?php echo ($data['name']?$data['name']:$data['nickname']); ?></span>
						<!--简介／描述-->
						<p class="intro2_header"><?php echo ($data["grade"]); ?><span> | </span><?php echo ($data["major"]); ?><span> | </span><?php echo ($data["school"]); ?></p>
					</header>
					<!--内容-->
					<section class="section">
						<!--个人信息-->
						<div class="information_appraise myInfo-block">
							<!--编辑链接-->
							<a href="<?php echo U('Personnel/comment',array('mode'=>'show','id'=>$data['id']));?>"><img class="btnEdit" src="/Public/Backend/img/btn-edit.png"></a>
							
							<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?><!--描述-->
							<div class="apprBar_appraise clearfix">
								<div class="tickBox_appraise"><!--勾选图标--><img src="/Public/Backend/img/icon-tick.png" style="display:<?php if(in_array($l['id'],$pro)){ echo 'block';}else{echo 'none';} ?>"/></div>
								<div class="textBox_appraise width_apprBar_appraise">
									<p class="text_appraise"><?php echo ($l["content"]); ?></p>
								</div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>



							<!--评价-->
                    <!-- <div class="textareaBox2_edit">
                        <textarea maxlength="140" name="appraise" placeholder="暂未评价"><?php echo ($content); ?></textarea>
                    </div> -->
                   			<div class="comment_appraise">
								<?php echo ($content); ?>
							</div>
						</div>
					</section>
				</div>
			</section>
		</div>
	</body>
</html>