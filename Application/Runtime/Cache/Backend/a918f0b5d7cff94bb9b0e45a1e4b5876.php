<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>实习独立说</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="/Public/Backend/css/reset.css" type="text/css" rel="stylesheet"/>
    <link href="/Public/Backend/css/style.css" type="text/css" rel="stylesheet" />
    <script src="/Public/Backend/js/jquery2.1.4.min.js"></script>
    <script src="/Public/Backend/js/font.js"></script>
    <script src="/Public/Backend/js/function.js"></script>
</head>
<body>
		<div class="wrap">
			<!--导航栏-->
			<nav class="nav">
    <div class="bg_nav"></div>
    <a href="<?php echo U('Personnel/index');?>"><div class="tab2_nav">
        <img class="imgPractice_nav" src="/Public/Backend/img/icon-talent.png" />
        <span class="text_nav">人才</span>
    </div></a>
    <a href="<?php echo U('Personnel/student');?>"><div class="tab2_nav">
        <img class="imgPractice_nav" src="/Public/Backend/img/icon-appraise.png" />
        <span class="text_nav">实习评价</span>
    </div></a>
    <a href="<?php echo U('Index/index');?>"><div class="tab2_nav">
        <div class="boxMy_nav"><img class="imgMy_nav" src="<?php echo ($data['headimg'] ? $data['headimg'] :$data['headimgurl']); ?>" /></div>
        <span class="boxMytext_nav textChecked_nav">我的</span>
    </div></a>
</nav>
			<!--页面内容-->
			<section class="content">
				<div class="main">
					<!--头部-->
					<header class="header">
						<!--公众号二维码链接-->
						<div class="QRcodeBox_header">
							<a href="<?php echo U('Index/qrcode');?>"><div class="QRcode_header">
								<img src="/Public/Backend/img/icon-QRcode.png" />
								<span>独立说公号</span>
							</div></a>
						</div>
						<!--头像-->
						<div class="head_header upload_btn"><img src="<?php echo ($data['headimg'] ? $data['headimg'] :$data['headimgurl']); ?>" /><!-- <input class="upload_input" type="file" name="file" id="file" onchange="upLoad('./upload/headerimg/backend/',this.id)"/> --></div>
						<!--名字-->
						<span class="name_header"><?php echo ($data['name']?$data['name']:$data['nickname']); ?></span>
						<!--tab-->
						<div class="tabBar_header">
							<div class="tab2_header checkedTab_header">个人信息</div>
						</div>
					</header>
					<!--内容-->
					<section class="section">
						<!--个人信息-->
						<div class="information_etp"> 
							<a href="<?php echo U('Index/edit');?>"><img class="btnEdit" src="/Public/Backend/img/btn-edit.png"></a>
							<img class="iconInfo" src="/Public/Backend/img/icon-info-phone.png" />
							<p class="textInfo"><?php echo ($data["phone"]); ?></p>
							<img class="iconInfo" src="/Public/Backend/img/icon-info-firm.png" />
							<p class="textInfo"><?php echo ($data["company"]); ?></p>
							<img class="iconInfo" src="/Public/Backend/img/icon-info-department.png" />
							<p class="textInfo"><?php echo ($data["department"]); ?></p>
							<img class="iconInfo" src="/Public/Backend/img/icon-info-position.png" />
							<p class="textInfo"><?php echo ($data["postition"]); ?></p>
						</div>
					</section>
				</div>
			</section>
		</div>
<script type="text/javascript" charset="utf-8" src="/Public/Home/js/ajaxfileupload.js"></script>
</body>
</html>
<script>
	function upLoad(path,field)
    {
    	//var id = '<?php echo I("get.id");?>';
    	var id =110;
        var root = '';
        $.ajaxFileUpload
        ({
            url: '<?php echo U("Index/upload");?>', //用于文件上传的服务器端请求地址
            type: 'post',
            data: { 'path':path,'field':field}, //此参数非常严谨，写错一个引号都不行
            secureuri: false, //一般设置为false
            fileElementId: field, //文件上传空间的id属性  <input type="file" id="file" name="file" />
            dataType: 'content', //返回值类型 一般设置为json
            success: function (data)  //服务器成功响应处理函数
            {   
                 if(data=='1'){
                 	//alert('上传成功');
                 	//$("#refrash").attr("src","");
                 	//$("#refrash").attr("src","<?php echo ($data['headimg']); ?>");
                 	location.reload();
                 }else{
                 	alert('照片过大,上传失败');
                 	
                 	
                 	
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