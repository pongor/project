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
				<h2 class="cell_headerTitle attr_left">企业 <span></span></h2>
			</header>
			<!--内容-->
			<section class="mod_section">
				<!--模块：表格-->
				<table class="mod_table">
					<!--表头-->
					<thead class="mod_thead">
						<!--注意！TWT_Act专为设置宽度而设，TWT＊后面的＊为百分比的数字，总和应是100-->
						<tr class="TWT_Act">
							<td class="TWT5">编号</td>
							<td class="TWT10">姓名</td>
							<td class="TWT11">手机</td>
							<td class="TWT15">行业</td>
							<td class="TWT23">公司</td>
							<td class="TWT12">部门</td>
							<td class="TWT12">岗位</td>
							<td class="TWT5">详情</td>
							<td class="TWT7">状态</td>
						</tr>
					</thead>
					<!--表内容-->
					<tbody class="mod_tbody">
						<tr class="mod_trMargin">
						</tr>
					<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
							<td><?php echo ($list["id"]); ?></td>
							<td><?php echo ($list["name"]); ?></td>
							<td><?php echo ($list["phone"]); ?></td>
							<td><?php
 echo D('Industry')->getFields(array('id'=>$list['industry_id'])); ?></td>
							<td><?php echo ($list["company"]); ?></td>
							<td><?php echo ($list["department"]); ?></td>
							<td><?php echo ($list["postition"]); ?></td>
							<td><a href="<?php echo U('Company/Detail',array('id'=>$list['id']));?>">查看</a></td>
							<td class="display <?php echo $list['status'] == 0 ? 'unused' :'';?>" onclick="status(<?php echo ($list["id"]); ?>,<?php echo $list['status'] == 1 ? 0 : 1 ?>)">禁用</td>
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
		<script>
			function status(id,status){
				$.post('<?php echo U("Company/status");?>',{'id':id,'status':status},function (res) {
					var data = $.parseJSON(res);
					if(data.error != 0) {
						alert(data.msg);return;
					}
				});
			}
		</script>
</body>
</html>