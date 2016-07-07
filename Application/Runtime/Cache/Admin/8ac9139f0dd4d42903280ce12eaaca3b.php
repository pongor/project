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
				<h2 class="cell_headerTitle attr_left">学生 <span></span></h2>
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
							<td class="TWT5">年级</td>
							<td class="TWT21">学校</td>
							<td class="TWT21">专业</td>
							<td class="TWT15">可实习时间</td>
							<td class="TWT5">详情</td>
							<td class="TWT7">状态</td>
						</tr>
					</thead>
					<!--表内容-->
					<tbody class="mod_tbody">
						<tr class="mod_trMargin">
						</tr>
				<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
							<td><?php echo ($data["id"]); ?></td>
							<td><?php echo ($data["name"]); ?></td>
							<td><?php echo ($data["phone"]); ?></td>
							<td><?php echo ($data["grade"]); ?></td>
							<td><?php echo ($data["school"]); ?></td>
							<td><?php echo ($data["major"]); ?></td>
							<td><?php echo ($data["internship_time"]); ?></td>
							<td><a href="<?php echo U('Student/detail',array('id'=>$data['id']));?>">查看</a></td>
							<td class="display <?php echo $data['status'] == 0 ? 'unused' :'';?>" onclick="status(<?php echo ($data["id"]); ?>,<?php echo $data['status'] == 1 ? 0 : 1 ?>)">不显示</td>
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
				$.post('<?php echo U("Student/status");?>',{'id':id,'status':status},function (res) {
					var data = $.parseJSON(res);
					if(data.error != 0) {
						alert(data.msg);return;
					}
				});
			}
		</script>
</body>
</html>