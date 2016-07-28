<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>导航栏</title>
    <link rel="stylesheet" href="/Public/Admin/css/reset.css" />
    <link rel="stylesheet" href="/Public/Admin/css/nav_man.css" />

    <link rel="stylesheet" href="/Public/Admin/css/style_man.css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery2.1.4.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/function_man.js"></script>
</head>
	<body>
		<div class="layout_wrap">
			<!--头部-->
			<header class="mod_header">
				<!--组件：标题-->
				<h2 class="cell_headerTitle attr_left">学生详情－<?php echo ($data["name"]); ?> <span></span></h2>
				<button class="cell_buttonSend attr_right" type="button" onclick="window.location.href='<?php echo ($data["resume"]); ?>'"> 下载简历</button>
			</header>
			<!--内容-->
			<section class="mod_section">
				<!--模块：表格-->
				<table class="mod_table">
					<!--表头-->
					<thead class="mod_thead">
						<!--注意！TWT_Act专为设置宽度而设，TWT＊后面的＊为百分比的数字，总和应是100-->
						<tr class="TWT_Act">
							<td class="TWT100" colspan="2" style="color: #0b1e7f;">实习记录</td>
						</tr>
					</thead>
					<!--表内容-->
					<tbody class="mod_tbody targettbody">
						<tr class="mod_trMargin">
						</tr>
						<?php if(is_array($records)): $i = 0; $__LIST__ = $records;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr class="TWT_Act">
							<td class="TWT20"><?php echo ($data["dates"]); ?></td>
							<td class="TWT80"><span><?php echo ($data["content"]); ?></span></td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
				<!--模块：表格-->
				<table class="mod_table">
					<!--表头-->
					<thead class="mod_thead">
						<!--注意！TWT_Act专为设置宽度而设，TWT＊后面的＊为百分比的数字，总和应是100-->
						<tr class="TWT_Act">
							<td class="TWT100" style="color: #0d5117;">导师评价</td>
						</tr>
					</thead>
					<!--表内容-->
					<tbody class="mod_tbody targettbody">
						<tr class="mod_trMargin">
						</tr>
						<tr>
							<td><input class="cell_checkbox-3" type="checkbox" checked="checked" disabled="disabled">学生在实习中表现出关心他人团结集体</td>
						</tr>
						<tr>
							<td><input class="cell_checkbox-3" type="checkbox" disabled="disabled">学生在实习中表现出在实习中表现出关心他关心他人团结集体</td>
						</tr>
						<tr>
							<td><input class="cell_checkbox-3" type="checkbox" checked="checked" disabled="disabled">学生在实习中表现出关心他人团结集体团结集体</td>
						</tr>
						<tr>
							<td><input class="cell_checkbox-3" type="checkbox" checked="checked" disabled="disabled">学生在实习中表现出关心团结集体团结集体团结集体团结集体他人团结集体</td>
						</tr>
						<tr>
							<td><span>实习中表现出了优秀的团队合作能力实习中表现出了优秀的团队合作能力实习中表现出了出了优秀的团队合作能力实习中表现出了优秀的团队合作能力实习中表现出了优秀的团队合作能力实习中表现出了出了优秀的团队合作能力实习中表现出了优秀的团队合作能力实习中表现出了优秀的团队合作能力实习中表现出了出了优秀的团队合作能力实习中表现出了优秀的团队合作能力实习中表现出了优秀的团队合作能力实习中表现出了优秀的团队合作能力实习中表现出了优秀的团队合作能力</span></td>
						</tr>
					</tbody>
				</table>
			</section>
			<!--底部-->
			<footer class="mod_footer">
				<!--元件：按钮－蓝-->
				<button class="cell_buttonBlue attr_marLef40" type="button" onclick="self.location='studentList_man.html';">返回列表</button>		
			</footer>
		</div>
		</body>
</html>