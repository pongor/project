<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>实习独立说后台管理系统</title>
	</head>
	<html style="min-width: 1024px;">
	<frameset rows="100%" frameborder="0">
		<frameset cols="21%,79%" scrolling="yes">
			<frame src="<?php echo U('Index/left');?>" name="left" scrolling="yes" />
			<frame src="<?php echo U('Index/right');?>" name="right" />
		</frameset>
	</frameset>
	</html>
</html>