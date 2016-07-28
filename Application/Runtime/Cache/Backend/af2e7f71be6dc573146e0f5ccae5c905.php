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
			        <img class="imgPractice_nav" src="/Public/Backend/img/icon-talentChecked.png" />
			        <span class="textChecked_nav">人才</span>
			    </div></a>
			    <a href="<?php echo U('Personnel/student');?>"><div class="tab2_nav">
			        <img class="imgPractice_nav" src="/Public/Backend/img/icon-appraise.png" />
			        <span class="text_nav">实习评价</span>
			    </div></a>
			    <a href="<?php echo U('Index/index');?>"><div class="tab2_nav">
			        <div class="boxMy2_nav"><img class="imgMy_nav" src="<?php echo ($info); ?>" /></div>
			        <span class="boxMytext_nav text_nav">我的</span>
			    </div></a>
			</nav>
			<!--页面内容-->
			<section class="content">
				<!--tab-->
				<div class="tabBar_stuList">
					<div class="tab_header allStu checkedTab_header">全&nbsp;&nbsp;&nbsp;&nbsp;部</div>
					<a href="<?php echo U('Backend/Personnel/collect');?>"><div class="tab_header collectStu">已&nbsp;收&nbsp;藏</div></a>
				</div>
				<!--内容-->
				<div>
					<!--全部学生-->
					
					<div class="allStu-block">

						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><!--学生卡片-->
						<div class="studentCard">
							<header>
								<!--姓名-->
								<p class="name_studentCard"><?php echo ($data["name"]); ?></p>
								<?php $house = D('House'); $r = $house ->getInfo(array('company_id' => $user_id,'user_id' => $data['id'])); ?>
								<img class="collect_studentCard uncollect" id="uncollect_<?php echo ($data["id"]); ?>" src="<?php echo $r ? '/Public/Backend/img/btn-collect.png' : '/Public/Backend/img/btn-uncollect.png'; ?>" onclick="add(<?php echo ($data["id"]); ?>)"/>
							</header>
							<!--跳转链接-->
							<a href="<?php echo U('Personnel/detail',array('id'=>$data['id']));?>"><section>
								<div class="headBox_studentCard">
									<!--头像-->
									<img class="head_studentCard" src="<?php echo ($data['headimg']?$data['headimg']:$data['headimgurl']); ?>" />
									<!--录取图标-->

									<img class="enroll_studentCard" src="/Public/Backend/img/icon-enroll.png"  style="display:<?php if($data['user_status']==1){echo 'block';}else{echo 'none';} ?>"/>
									
								</div>
								<div class="info_studentCard">
									<!--年级、专业、学校-->
									<p><?php echo ($data["grade"]); ?><span> | </span><?php echo ($data["major"]); ?></p>
									<p><?php echo ($data["school"]); ?></p>
								</div>
							</section><footer>
								<!--可实习地点-->
								<?php if($data['address']){ ?>
								<p class="place"><img src="/Public/Backend/img/icon-coordinates.png" /><span><?php echo ($data["address"]); ?></span></p>
								<?php } ?>
								<!--可实习时间-->
								<p class="gray_studentCard">空档·<?php echo ($data["intern"]); ?> - <?php echo ($data["enddate"]); ?></p>
							</footer></a>

						</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
			</section>
		</div>
<script>
	function add(id){
		$.post('<?php echo U("Personnel/house");?>',{'id':id},function (res) {
			var data = $.parseJSON(res);
			if(data.error == 0  ){
				if(data.del == 1){
					$('#uncollect_'+id).attr('src','/Public/Backend/img/btn-collect.png');
					$('#uncollect_'+id).removeClass('uncollect').addClass('collect');
				}else{

					$('#uncollect_'+id).attr('src','/Public/Backend/img/btn-uncollect.png');
					$('#uncollect_'+id).removeClass('collect').addClass('uncollect');
				}

			}else{
				alert(data.msg);return;
			}
		});
	}

</script>
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