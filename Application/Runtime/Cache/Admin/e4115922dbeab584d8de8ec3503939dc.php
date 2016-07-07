<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>导航栏</title>
    <link rel="stylesheet" href="/project/Public/Admin/css/reset.css" />
    <link rel="stylesheet" href="/project/Public/Admin/css/nav_man.css" />

    <link rel="stylesheet" href="/project/Public/Admin/css/style_man.css" />
    <script type="text/javascript" src="/project/Public/Admin/js/jquery2.1.4.min.js"></script>
    <script type="text/javascript" src="/project/Public/Admin/js/function_man.js"></script>
</head>
	<body>
		<div class="layout_wrap">
			<!--头部-->
			<header class="mod_header">
				<!--组件：标题-->
				<h2 class="cell_headerTitle attr_left">验证码 <span></span></h2>
				<form class="attr_right" action='<?php echo U("Code/generate");?>' method="get">
					<input class="cell_inputShort" type="text" name="number" placeholder="请输入" />
					<button class="cell_buttonSend" type="submit">生成</button>
				</form>
				
			</header>
			<!--内容-->
			<section class="mod_section">
				<!--模块：表格-->
				<table class="mod_table">
					<!--表头-->
					<thead class="mod_thead">
						<!--注意！TWT_Act专为设置宽度而设，TWT＊后面的＊为百分比的数字，总和应是100-->
						<tr class="TWT_Act">
							<td class="TWT20">验证码</td>
							<td class="TWT20">状态</td>
							<td class="TWT30">生成时间</td>
							<td class="TWT30">使用时间</td>
						</tr>
					</thead>
					<!--表内容-->
					<tbody class="mod_tbody">
						<tr class="mod_trMargin">
						</tr>
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
							<td><?php echo ($data["code"]); ?></td>
							<?php if($data['status'] == 1){ ?>
							<td class="unused">未使用</td>
							<?php }else{ ?>
							<td>已使用</td>
							<?php } ?>

							<td><?php echo (date('Y/m/d H:i:s',$data["at_time"])); ?></td>
							<td><?php if($data['ut_time'] >0){ echo (date('Y/m/d H:i:s',$data["ut_time"])); ?> <?php }else{ ?> ---- <?php } ?></td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>



					</tbody>
				</table>
				<!--页码-->
				<div class="mod_slew">
					<!--总页数-->
					<?php echo ($page["page"]); ?>
				</div>
			</section>
		</div>
		</body>
</html>