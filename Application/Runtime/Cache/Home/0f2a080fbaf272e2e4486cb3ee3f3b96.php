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
			<inclide file="Public:nav" />
			<!--页面内容-->
			<div class="content">
				<div class="height_oneScreen">

					<div class="main_editRecord">
						<div class="textareaBox_editRecord">
							<textarea id="clearTxt"><?php echo ($data['content']); ?></textarea>
						</div>
						<button class="button-red">保存记录</button>
					</div>
				</div>
			</div>
		</div>
<script>
	$(function(){
		$('.button-red').click(function(){
			
			var con = $('textarea').val();
			var id = '<?php echo ($uid); ?>';
			//alert(id);
			$.post("<?php echo U('Offer/add');?>",{'con':con,'id':id},function(res){
				//alert(res);return false;
				var data = $.parseJSON(res);
				if(data.error == 0) {
					window.location.href="<?php echo U('Offer/record');?>";
				}else{
					alert(data.msg);return;
				}
			});
		});

		$("#clearTxt").focus(function(){
			$(this).val('');
		})
	});
</script>

</body>
</html>