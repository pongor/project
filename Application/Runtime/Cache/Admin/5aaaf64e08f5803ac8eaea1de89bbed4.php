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
				<h2 class="cell_headerTitle attr_left">判断题 <span></span></h2>
				<button class="cell_buttonSend attr_right addButton" type="button">添加题目</button>
			</header>
			<!--内容-->
			<section class="mod_section">
				<!--模块：表格-->
				<table class="mod_table">
					<!--表头-->
					<thead class="mod_thead">
						<!--注意！TWT_Act专为设置宽度而设，TWT＊后面的＊为百分比的数字，总和应是100-->
						<tr class="TWT_Act">
							<td class="TWT80">题目内容</td>
							<td class="TWT10">是否启用</td>
							<td class="TWT10">顺序</td>

						</tr>
					</thead>
					<!--表内容-->
					<tbody class="mod_tbody targettbody">
						<tr class="mod_trMargin">
						</tr>
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
							<td><input class="cell_inputLang" type="text" placeholder="请输入题目" value="<?php echo ($data["content"]); ?>" onchange="update(this.value,<?php echo ($data["id"]); ?>,'content')"></td>
							<td><input type="checkbox" value="1" id="check_<?php echo ($data["id"]); ?>" onclick="checkeds(<?php echo ($data["id"]); ?>)" <?php echo $data['status'] == 1 ? 'checked' : ''; ?> ></td>
							<td><input class="cell_inputShort2" type="text" value="<?php echo ($data["orders"]); ?>" onchange="update(this.value,<?php echo ($data["id"]); ?>,'orders')"></td>

						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
				<!--页码-->
				<div class="mod_slew">
					<!--总页数-->
					<?php echo ($page["page"]); ?>
				</div>
			</section>
			<!--底部-->
			<footer class="mod_footer">
				<!--元件：按钮－蓝-->
				<button class="cell_buttonBlue attr_marLef40" type="button" >保存</button>
				<!--元件：按钮－灰-->
				<button class="cell_buttonGrey" type="button">取消</button>				
			</footer>
			<!--模版区-->
			<div class="model">
				<table>
					<tr class="modeladd">
						<td><input class="cell_inputLang" type="text" placeholder="请输入题目" value="" onchange="add(this.value)"></td>
						<td><input type="checkbox"></td>
						<td><input class="cell_inputShort2" type="text" value=""></td>
					</tr>
				</table>
			</div>
		</div>
		<script>
			function update(name,id,filed) {
				if(id <= 0) {
					return false;
				}

				$.post('<?php echo U("Judge/update");?>',{'name':name,'id':id,'field':filed},function (data){
					var obj = $.parseJSON(data);
					if(obj.error == 0){
						window.location.reload();
					}else{
						alert(obj.msg);return false;
					}
				});
			}
			function checkeds(id) {
				var chek = ($('#check_'+id).is(':checked'));
				if(chek){
					var values = 1;
				}else{
					var values = 0;
				}
				$.post('<?php echo U("Judge/update");?>',{'name':values,'id':id,'field':'status'},function (data){
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

				$.post('<?php echo U("Judge/add");?>',{'name':obj},function(res){
					var data = $.parseJSON(res);

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