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
	<script src="/project/Public/Admin/js/ajaxfileupload.js"></script>
		<div class="layout_wrap">
			<!--头部-->
			<header class="mod_header">
				<!--组件：标题-->
				<h2 class="cell_headerTitle attr_left">企业－详情 <span></span></h2>
			</header>
			<!--内容-->
			<section class="mod_section">
				<!--模块：表格-->
				<table class="mod_table">
					<!--表头-->
					<thead class="mod_thead">
						<!--注意！TWT_Act专为设置宽度而设，TWT＊后面的＊为百分比的数字，总和应是100-->
						<tr class="TWT_Act">
							<td class="TWT7">编号</td>
							<td class="TWT12">姓名</td>
							<td class="TWT13">手机</td>
							<td class="TWT17">行业</td>
							<td class="TWT25">公司</td>
							<td class="TWT13">部门</td>
							<td class="TWT13">岗位</td>
						</tr>
					</thead>
					<!--表内容-->
					<tbody class="mod_tbody">
						<tr class="mod_trMargin">
						</tr>
						<tr>
							<td><?php echo ($data["id"]); ?></td>
							<td><?php echo ($data["name"]); ?></td>
							<td><?php echo ($data["phone"]); ?></td>
							<td><?php
 echo D('Industry')->getFields(array('id'=>$data['industry_id'])); ?></td>
							<td><?php echo ($data["company"]); ?></td>
							<td><?php echo ($data["department"]); ?></td>
							<td><?php echo ($data["postition"]); ?></td>
						</tr>
						<tr>
							<td colspan="7">
								<!--上传的图片-->
								<img class="banner_entprisDtal" id="img_<?php echo ($data["id"]); ?>" src="/project<?php echo ($data["file"]); ?>" />
							</td>
						</tr>
						<tr>
							<td colspan="7"><button class="cell_button2" type="button" onclick="$('#file_<?php echo ($data["id"]); ?>').click();">上传</button></td>
							<input type="file" name="file" id="file_<?php echo ($data["id"]); ?>" style="display: none" onchange="upLoad('./upload/qiye/','Company',<?php echo ($data["id"]); ?>)">

						</tr>
					</tbody>
				</table>
				<div>
					
				</div>
			</section>
			<!--底部-->
			<footer class="mod_footer">
				<!--元件：按钮－蓝-->
				<button class="cell_buttonBlue attr_marLef40" type="button" onclick="self.location='enterpriseList_man.html';">保存</button>
				<!--元件：按钮－灰-->
				<button class="cell_buttonGrey" type="button" onclick="self.location='enterpriseList_man.html';">取消</button>				
			</footer>
		</div>
		<script>
			function upLoad(path,model,id)
			{
				var root = '/project';
				$.ajaxFileUpload
				({
					url: '<?php echo U("Index/upload");?>', //用于文件上传的服务器端请求地址
					type: 'post',
					data: {'path':path,'model':model,'id':id}, //此参数非常严谨，写错一个引号都不行
					secureuri: false, //一般设置为false
					fileElementId: 'file_'+id, //文件上传空间的id属性  <input type="file" id="file" name="file" />
					dataType: 'content', //返回值类型 一般设置为json
					success: function (data, status)  //服务器成功响应处理函数
					{
						var obj = $.parseJSON(data);
						if(obj.error == 0)
						{
							$("#img_"+id).attr('src',root+obj.file);

							$('#file_'+id).bind('change', function () {
								upLoad(path,model,id);
							});
						}
						else
						{
							alert(obj.msg);
						}
					}
					// error: function (data, status, e)//服务器响应失败处理函数
					// {
					//    // alert(e);
					// }
				});//这是ajax1结束Tags
				return false;
			}
		</script>
		</body>
</html>