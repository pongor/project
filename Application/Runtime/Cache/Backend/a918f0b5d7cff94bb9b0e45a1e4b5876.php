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
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" ></script>
<script>
    <?php $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; $token = share($url); ?>

    $(document).ready(function(){
        /***********微信分享 start*************/
        var dataWechat = '';
        var urlStart = location.href.split('#')[0];
        //设置微信分享内容
        wx.config({
            debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: '<?php echo ($token["appId"]); ?>',  //dataWechat.appid, // 必填，公众号的唯一标识
            timestamp: '<?php echo ($token["timestamp"]); ?>',  //dataWechat.timestamp, // 必填，生成签名的时间戳
            nonceStr: '<?php echo ($token["nonceStr"]); ?>',  //dataWechat.noncestr, // 必填，生成签名的随机串
            signature: '<?php echo ($token["signature"]); ?>',  //dataWechat.signature,// 必填，签名，见附录1
            jsApiList: ['chooseWXPay', 'onMenuShareTimeline', 'onMenuShareAppMessage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });
        wx.ready(function() {
            //分享到朋友圈
            wx.onMenuShareTimeline({
                title: "<?php echo $title ? $title :'棒棒的实习生推荐'; ?>", // 分享标题
                link: urlStart, // 分享链接
                imgUrl: '<?php echo $image ? $image :"http://css.dulishuo.com/upload/logo.png"; ?>', // 分享图标
                success: function (res) {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
            //分享给好友
            wx.onMenuShareAppMessage({
                title: "<?php echo $title ? $title :'棒棒的实习生推荐'; ?>", // 分享标题
                desc: "<?php echo $desc ? $desc :'独立说为您诚意推荐通过考核的实习生，好用！'; ?>", // 分享描述
                link: urlStart, // 分享链接
                imgUrl: '<?php echo $image ? $image :"http://css.dulishuo.com/upload/logo.png"; ?>', // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function (res) {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
        });
    });
</script>
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