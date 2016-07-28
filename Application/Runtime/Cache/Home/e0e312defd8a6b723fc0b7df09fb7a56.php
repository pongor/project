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
			        <div class="boxMy2_nav"><img class="imgMy_nav" src="<?php echo ($data['headimg'] ? $data['headimg'] : $data['headimgurl']); ?>" /></div>
			        <span class="boxMytext_nav text_nav">我的</span>
			    </div></a>
			</nav>
			<!--页面内容-->
			<div class="content">
				<div class="practiceCard">
					<!--头部-->
					<header class="header_practiceCard">
						<div class="banner_practiceCard"><img src="<?php echo ($ad["file"]); ?>" /></div>
						<div class="head_practiceCard"><img src="<?php echo ($data['headimg'] ? $data['headimg'] : $data['headimgurl']); ?>" /></div>
					</header>
					<!--内容-->
					<section class="section_practiceCard section_Record">
						<p class="tipText">恭喜入职! 认真记录实习心得哟</p>
						<!--添加记录链接-->
						<a href="<?php echo U('Offer/addrecord');?>"><div class="addRecord">
							<img src="/Public/Home/img/icon-addRecord.png" />
							<p>添加你的实习记录</p>
						</div></a>
						<!--一条记录-->
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?><div class="box_record">
							<!--记录内容-->
							<p class="text_record">
								<?php echo ($r["content"]); ?>
							</p>
							<div class="operaBar_record">
								<!--日期-->
								<span class="deta_record"><?php echo ($r["dates"]); ?></span>
								<!--控制操作栏的icon-->
								<img class="iconShowHidd_record showhiddOpera off" src="/Public/Home/img/icon-showHidd.png" />
								<!--操作栏-->
								<div class="operaBox_record operaRecord">
									<button class="buttonOpera_record buttonEdit_record" onclick="window.location.href='<?php echo U('Offer/updaterecord',array('id'=>$r['id']));?>'">编辑</button><span class="verticalOpera_record"></span>
									<button class="buttonOpera_record buttonDel_record deleteRecord" onclick="del(<?php echo ($r["id"]); ?>)">删除</button>
								</div>
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</section>

				</div>
			</div>
		</div>
<script>
	function del(id){
		$.post('<?php echo U("Offer/del");?>',{'id':id},function (res) {
				var data = $.parseJSON(res);
			if(data.error != 0){
				alert(data.msg);return;
			}
		});
	}
</script>
</body>
</html>