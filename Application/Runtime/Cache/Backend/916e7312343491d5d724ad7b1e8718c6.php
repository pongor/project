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
		</nav>
			<!--页面内容-->
			<section class="content">
				<!--tab-->
				<div class="tabBar_stuList">
					<a href="<?php echo U('Backend/Personnel/index');?>"><div class="tab_header allStu">全&nbsp;&nbsp;&nbsp;&nbsp;部</div></a>
					<div class="tab_header collectStu checkedTab_header">已&nbsp;收&nbsp;藏</div>
				</div>
				<!--内容-->
				<div>
					<div class="collectStu-block">
						<?php if(is_array($ress)): $i = 0; $__LIST__ = $ress;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$res): $mod = ($i % 2 );++$i;?><!--学生卡片-->
							<div class="studentCard">
								<header>
									<!--姓名-->
									<p class="name_studentCard"><?php echo ($res["name"]); ?></p>
									<?php $house = D('House'); $r = $house ->getInfo(array('company_id' => $user_id,'user_id' => $res['id'])); ?>
									<img class="collect_studentCard uncollect" id="uncollect_<?php echo ($res["id"]); ?>" src="<?php echo $r ? '/Public/Backend/img/btn-collect.png' : '/Public/Backend/img/btn-uncollect.png'; ?>" onclick="add(<?php echo ($res["id"]); ?>)"/>
								</header>
								<!--跳转链接-->
								<a href="<?php echo U('Personnel/detail',array('id'=>$res['id']));?>"><section>
									<div class="headBox_studentCard">
										<!--头像-->
										<img class="head_studentCard" src="<?php echo ($res['headimg']?$res['headimg']:$res['headimgurl']); ?>" />
										<!--录取图标-->
										<?php $model = D('Pushs'); $resa = $model->getInfo(array('user_id'=>$res['id'])); if(isset($resa['user_status']) && $resa['user_status'] == 1) { ?>
										<img class="enroll_studentCard" src="/Public/Backend/img/icon-enroll.png"  />
										<?php } ?>
									</div>
									<div class="info_studentCard">
										<!--年级、专业、学校-->
										<p><?php echo ($res["grade"]); ?><span> | </span><?php echo ($res["major"]); ?></p>
										<p><?php echo ($res["school"]); ?></p>
									</div>
								</section><footer>
									<!--可实习地点-->
									<p class="place"><img src="/Public/Backend/img/icon-coordinates.png" /><span>北京</span></p>
									<!--可实习时间-->
									<p class="gray_studentCard">空档·<?php echo ($res["intern"]); ?> - <?php echo ($res["enddate"]); ?></p>
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
					window.location.href="";
				}

			}else{
				alert(data.msg);return;
			}
		});
	}

</script>
</body>
</html>