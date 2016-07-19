<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>实习独立说</title>
		<link rel="stylesheet" href="/Public/Home/css/reset.css" />
		<link rel="stylesheet" href="/Public/Home/css/style.css" />
		<script type="text/javascript" src="/Public/Home/js/jquery1.9.1.js"></script>
		<script type="text/javascript" src="/Public/Home/js/function.js"></script>
		<script type="text/javascript" charset="utf-8" src="/Public/Home/js/ajaxfileupload.js"></script>
	</head>
	<body>
	    <form action="<?php echo U('Post/postfile');?>" method="post" enctype="multipart/form-data" name="forms" id="forms">
		<div class="wrap2">
			<!--标题-->
			<div class="title_send">
				独说实习培训 | 简历上传
			</div>
			<!--内容-->
			<div class="section">
				<p class="title">附件简历</p>
				<!--已上传-->
				<div class="alreadySend" style="display: none;">
					<table>
						<thead>
							<tr>
								<td class="t1">文件名</td>
								<td class="t2">上传时间</td>
								<td class="t3">操作</td>
							</tr>
						</thead>
						<tbody class="tbody">
							<tr>
								<td class="tb1">
									<img src="/Public/Home/img/icon-resume.png" />
									<div>
										<p class="p1">2016刘同学简历2016刘同学简历.PDF</p>
										<p class="p2">32k</p>
									</div>
								</td>
								<td class="tb2"><p>2016.04.20.16:30</p></td>
								<td class="tb3">
									<div>
										<button class="button-red-short">更改</button>
										<button class="button-white-short deleteBtn">删除</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!--未上传-->
				
				<div class="noSend" style="display: block;">
					<img src="/Public/Home/img/icon-bg.png" />
					<p>您还没有上传附件简历（最大可上传8M）<br />仅限PDF件格式</p>
					<input type="file" style="display:none" id="file" name="file" multiple="multiple" onchange="upLoad('./upload/tmp/',this.id)"/>
					<button type="button" class="button-red marginCenter" onclick="javascript:$('#file').click();">上&nbsp;&nbsp;传</button>
					
                    
				</div>
				
			</div>
			<div class="popup" style="display: none;">
				<div class="bg_popup"></div>
				<!--确认删除-->
				<div class="box_popup delete" style="display: none;">
					<div class="title_popup">
						<p>温馨提示</p>
						<!--关闭-->
						<img class="close" src="/Public/Home/img/btn-close.png" />
					</div>
					<p class="text1_popup">确认删除该简历附件吗？</p>
					<div class="buttonBox_popup">
						<button class="button-white yes">确&nbsp;&nbsp;定</button>
						<button class="button-red no">取&nbsp;&nbsp;消</button>
					</div>
				</div>
				<!--上传成功-->
				<div class="box_popup success" style="display: none;">
					<div class="title_popup">
						<p>温馨提示</p>
						<!--关闭-->
						<img class="close" src="/Public/Home/img/btn-close.png" />
					</div>
					<p class="text2_popup">您的简历已上传成功<br />请返回手机中继续操作</p>
					<div class="buttonBox2_popup">
						<button class="button-red marginCenter yes">确&nbsp;&nbsp;定</button>
					</div>
				</div>
				<!--上传失败-->
				<div class="box_popup" style="display: none;">
					<div class="title_popup">
						<p>温馨提示</p>
						<!--关闭-->
						<img class="close" src="/Public/Home/img/btn-close.png" />
					</div>
					<p class="text3_popup">您的简历上传失败<br />请返回网页端页面重新上传</p>
					<div class="buttonBox2_popup">
						<button class="button-red marginCenter close">确&nbsp;&nbsp;定</button>
					</div>
				</div>
			</div>
		</div>
		</form>
	</body>
<script>
	function upLoad(path,field)
	{
		var id = 3 ;
		
		$.ajaxFileUpload
		({
			url: '<?php echo U("Post/postfile");?>', //用于文件上传的服务器端请求地址
			type: 'post',
			data: { 'path':path,'field':field,'caseId':id}, //此参数非常严谨，写错一个引号都不行
			secureuri: false, //一般设置为false
			fileElementId: field, //文件上传空间的id属性  <input type="file" id="file" name="file" />
			dataType: 'content', //返回值类型 一般设置为json
			success: function (data)  //服务器成功响应处理函数
			{
				
				
				if(data == '1')
				{
					alert('上传成功');
				}
				else
				{
                    alert('上传失败');

				}

			}
			// error: function (data, status, e)//服务器响应失败处理函数
			// {
			//    // alert(e);
			// }
		});//这是ajax1结束Tags
		//return false;
	}
</script>
</html>