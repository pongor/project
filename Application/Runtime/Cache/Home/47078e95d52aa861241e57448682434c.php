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
			<div class="content">
				<!--offer卡片-->
				<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="practiceCard">
					<!--头部-->
					<header class="header_practiceCard">
						<div class="banner_practiceCard"><img src="/project/<?php echo ($data["files"]); ?>" /></div>
						<div class="head_practiceCard"><img src="<?php echo ($data['headimg'] ? $data['headimg'] :$data['headimgurl']); ?>" /></div>
					</header>
					<!--内容-->
					<section class="section_practiceCard">
						<p class="tip1_practiceCard">恭喜您通过了<?php echo ($data["company"]); ?>的面试<br/>快接受实习offer吧</p>
						<!--接受按钮-->
						<button class="button-red-short acceptOffer"><input type="hidden" value="<?php echo ($data["company_id"]); ?>"> 接&nbsp;&nbsp;受</button>
					</section>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
				<!--offer卡片-->
			</div>
			<!--确认接受弹出框-->
			<div class="popup" style="display: none;">
				<div class="bg_popup"></div>
				<div class="box_popup box_popup_offer">
					<img class="icon_popup_offer" src="/project/Public/Home/img/icon-accept.png" />
					<p class="tipText text_popup_offer">确认接受OFFER吗？</p>
					<!-- 接受 -->
					<button class="button-red" id="button-red">确&nbsp;&nbsp;&nbsp;认</button>
					<!-- 关闭弹出框 -->
					<img class="close_popup_offer closeOffer" src="/project/Public/Home/img/btn-close.png" />
				</div>
			</div>
		</div>
<input type="hidden" id="company" value="">
<script>
	$(function () {
		$('.acceptOffer').click(function(){
			var company = $(this).find('input').val();
			$('#company').val(company);
		});
		$('#button-red').click(function(){
			var company_id = $('#company').val();

			$.post('<?php echo U("Offer/accept");?>',{'id':company_id},function (data) {
				var obj = $.parseJSON(data);
				if(obj.error == 0 ){
				 //	$('.popup').css('display','none');
				 window.location.href="<?php echo U('Offer/record');?>";return;
				}else{
					alert(obj.msg);return;
				}
			});

		});
	});
</script>
</body>
</html>