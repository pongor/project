<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>实习独立说</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="/Public/Home/css/reset.css" type="text/css" rel="stylesheet"/>
    <link href="/Public/Home/css/style.css" type="text/css" rel="stylesheet" />
    <script src="/Public/Home/js/jquery2.1.4.min.js"></script>
    <script src="/Public/Home/js/font.js"></script>
    <script src="/Public/Home/js/function.js"></script>
</head>
<body>
		<div class="wrap">
			<!--导航栏-->
		<nav class="nav">
    <div class="bg_nav"></div>
    <a href="<?php echo U('Offer/index');?>"><div class="tab_nav tab_on_nav">
        <img class="imgPractice_nav" src="/Public/Home/img/icon-practice.png" />
        <span class="text_nav">实习</span>
    </div></a>
    <a href="<?php echo U('Index/index');?>"><div class="tab_nav tab_off_nav">
        <div class="boxMy_nav"><img class="imgMy_nav" src="<?php echo ($data['headimg']?$data['headimg']:$data['headimgurl']); ?>" /></div>
        <span class="boxMytext_nav  textChecked_nav">我的</span>
    </div></a>
</nav>
			<!--页面内容-->
			<section class="content">
				<!--顶部提示栏-->
                 <?php if($data['status']!=3){ ?>
				<div class="tiptop BGtiptop" ><table><tr><td>
					完善个人信息和简历企业才能看到你哦
				</td></tr></table></div>
                <?php } ?>
				<!--页面主要内容-->
				<div class="main">
					<!--头部-->
					<header class="header">
						<!--公众号二维码链接-->
						<div class="QRcodeBox_header">
							<a href="QRcode.html"><div class="QRcode_header">
								<img src="/Public/Home/img/icon-QRcode.png" />
								<span>独立说公号</span>
							</div></a>
						</div>
						<!--头像-->
						<div class="head_header upload_btn"><img src="<?php echo ($data['headimg']?$data['headimg']:$data['headimgurl']); ?>" id="refrash"/><input class="upload_input" type="file" name="file" id="file" onchange="upLoad('./upload/headerimg/home/',this.id)"/></div>
						<!--名字-->
						<span class="name_header"><?php echo ($data["name"]); ?></span>
						<!--简介／描述-->
						<p class="intro_header" style="text-align:center;"><?php echo ($data["desc"]); ?></p>
						<!--tab-->
						<div class="tabBar_header">
							<div class="tab_header myInfo checkedTab_header">个人信息</div>
							<div class="tab_header myResume">我的简历</div>
						</div>
					</header>
					<!--内容-->
					<section class="section">
						<!--个人信息-->
						<div class="information myInfo-block">
							<a href="<?php echo U('/Index/home');?>"><img class="btnEdit" src="/Public/Home/img/btn-edit.png"></a>
							<img class="iconInfo" src="/Public/Home/img/icon-info-phone.png" />
							<p class="textInfo"><?php echo ($data["mobile"]); ?></p>
							<img class="iconInfo" src="/Public/Home/img/icon-info-grade.png" />
							<p class="textInfo"><?php echo ($data["grade"]); ?></p>
							<img class="iconInfo" src="/Public/Home/img/icon-info-college.png"/>
							<p class="textInfo"><?php echo ($data["school"]); ?></p>
							<img class="iconInfo" src="/Public/Home/img/icon-info-major.png" />
							<p class="textInfo"><?php echo ($data["major"]); ?></p>
							<img class="iconInfo" src="/Public/Home/img/icon-info-coordinates.png" style="display:<?php if($data['address']){echo 'block';}else{echo 'none';}?>" />
                			<p class="textInfo"  style="display:<?php if($data['address']){echo 'block';}else{echo 'none';}?>" ><?php echo ($data["address"]); ?></p>
							<img class="iconInfo" src="/Public/Home/img/icon-info-time.png" />
							<p class="textInfo noMargin">可实习时间 <?php echo ($data["intern"]); ?>-<?php echo ($data["enddate"]); ?></p>
						</div>
						<!--简历部分-->
						<div class="resume myResume-block" style="display: none;">
							<!--未上传-->
							<?php if($data['resume']==''){ ?>
							<div class="Upload_resume">
								<img src="/Public/Home/img/icon-UploadResume.png" />
								<button class="button-red UploadResume_btn">上传我的简历</button>
							</div>
							<?php }else{ ?>
							<!--已上传-->

							<div class="Lookat_resume">
								<button class="button-resume margin_23467r" id="LookatResume_btn"><span style="display:block;margin-left:40px;width:155px; white-space:nowrap;text-overflow:ellipsis;overflow:hidden;"><?php echo ($data['pdfname']); ?></span></button>
								<button type="button" class="button-red" id="reupload">重新上传简历</button>
							</div>
							<?php } ?>
						</div>
					</section>
				</div>
			</section>
		</div>
<script type="text/javascript" charset="utf-8" src="/Public/Home/js/ajaxfileupload.js"></script>
<script>
	$(function () {
		<?php  if($data['resume']){ ?>
			$('.Lookat_resume').css('display','none');
			$('.Upload_resume').css('display','none');
			$('.tiptop').css('display','none');
		<?php }else{ $url = U("Offer/upload"); ?>
		$('.UploadResume_btn').click(function(){
			window.location.href="<?php echo ($url); ?>";
		});
		<?php } ?>
	});
    $("#reupload").click(function(){
    	window.location.href="/Home/Offer/upload";
    })
	$("#LookatResume_btn").click(function(){
		window.location.href='/Index/readPdf';
	})

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
                 	//alert(data);
                 	alert('照片过大, 上传失败');
                 	
                 	
                 	
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