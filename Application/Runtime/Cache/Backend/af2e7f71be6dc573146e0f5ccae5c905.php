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
</body>
</html>