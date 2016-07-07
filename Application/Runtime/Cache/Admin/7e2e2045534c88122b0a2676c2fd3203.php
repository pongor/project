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
				<h2 class="cell_headerTitle attr_left">行业 <span></span></h2>
				<button class="cell_buttonSend attr_right addButton" type="button">添加行业</button>
			</header>
			<!--内容-->
			<section class="mod_section">
				<!--模块：表格-->
				<table class="mod_table">
					<!--表头-->
					<thead class="mod_thead">
						<!--注意！TWT_Act专为设置宽度而设，TWT＊后面的＊为百分比的数字，总和应是100-->
						<tr class="TWT_Act">
							<td class="TWT30">行业名称</td>
							<td class="TWT50">文件</td>
							<td class="TWT20">上传</td>
						</tr>
					</thead>
					<!--表内容-->
					<tbody class="mod_tbody targettbody">
						<tr class="mod_trMargin">
						</tr>
						<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
							<td><input class="cell_inputLang" type="text" placeholder="请输入行业名称" value="<?php echo ($list["name"]); ?>" onchange="update(this.value,<?php echo ($list["id"]); ?>);"></td>
							<td><!--上传的图片--><img class="banner_trade" id="img_<?php echo ($list["id"]); ?>" src="/project<?php echo ($list["file"]); ?>" width="360" height="197" /></td>
							<td><button class="cell_button2" type="button" onclick="$('#'+'file_<?php echo ($list["id"]); ?>').click();">上传</button>
								<input type="file" name="file" style="display: none" id="file_<?php echo ($list["id"]); ?>" onchange="upLoad('./upload/hangye/','Industry',<?php echo ($list["id"]); ?>)">
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
				<!--页码-->
				<div class="mod_slew">
					<?php echo ($page["page"]); ?>
				</div>
			</section>
			<!--底部-->
			<footer class="mod_footer">
				<!--元件：按钮－蓝-->
				<button class="cell_buttonBlue attr_marLef40" type="button">保存</button>
				<!--元件：按钮－灰-->
				<button class="cell_buttonGrey" type="button">取消</button>				
			</footer>
			<!--模版区-->
			<div class="model">
				<table>
					<tr class="modeladd">
						<td><input class="cell_inputLang" type="text" placeholder="请输入行业名称" value="" onblur="add(this.value)"></td>
						<td><!--上传的图片--></td>
						<td><button class="cell_button2" type="button">上传</button></td>
					</tr>
				</table>
			</div>
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
			//修改名称
			function update(name,id) {
				if(id <= 0) {
					return false;
				}
				$.post('<?php echo U("Index/update");?>',{'name':name,'id':id},function (data){
					var obj = $.parseJSON(data);
					if(obj.error == 0){
						window.location.reload();
					}else{
						alert(obj.msg);return false;
					}
				});
			}
			//添加行业名称
			function add(obj){
				if(obj==''){
					return false;
				}

				$.post('<?php echo U("Index/industry");?>',{'name':obj},function(res){
						var data = $.parseJSON(res);
					alert(res);
					if(data.error == 0){
						window.location.reload();
					}else{
						alert(data.msg);return;
					}
				});
			}
		</script>
		</body>
</html>