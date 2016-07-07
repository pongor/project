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
		<!--导航栏-->
		<nav class="navBox">
			<!--导航栏头部-->
			<header class="navHead">
				<img class="navLogo" src="/project/Public/Admin/img/navLogo.png" />
			</header>
			<!--导航栏主体-->
			<section class="nav">
				<!--行业-->
				<ul class="navMain navOption navSelected">
					<a href="<?php echo U('Index/right');?>" target="right">
						<img class="navIcon" src="/project/Public/Admin/img/navIcon-1.png"/>
						<span>行业</span>
					</a>
				</ul>
				<!--企业-->
				<ul class="navMain navOption">
					<a href="<?php echo U('Company/index');?>" target="right">
						<img class="navIcon" src="/project/Public/Admin/img/navIcon-2.png"/>
						<span>企业</span>
					</a>
				</ul>
				<!--学生-->
				<ul class="navMain navOption">
					<a href="<?php echo U('Student/index');?>" target="right">
						<img class="navIcon" src="/project/Public/Admin/img/navIcon-3.png"/>
						<span>学生</span>
					</a>
				</ul>
				<!--判断题-->
				<ul class="navMain navOption">
					<a href="<?php echo U('Judge/index');?>" target="right">
						<img class="navIcon" src="/project/Public/Admin/img/navIcon-4.png"/>
						<span>判断题</span>
					</a>
				</ul>
				<!--广告位-->
				<ul class="navMain navOption">
					<a href="<?php echo U('Advertising/index');?>" target="right">
						<img class="navIcon" src="/project/Public/Admin/img/navIcon-1.png"/>
						<span>广告位</span>
					</a>
				</ul>
				<!--验证码-->
				<ul class="navMain navOption">
					<a href="<?php echo U('Code/index');?>" target="right">
						<img class="navIcon" src="/project/Public/Admin/img/navIcon-2.png"/>
						<span>验证码</span>
					</a>
				</ul>
				
				<!--机会产品-->
				<!--<ul class="navMain navProduct">
					<a>
						<img class="navIcon" src="/project/Public/Admin/img/navIcon-1.png"/>
						<span>机会产品</span>
						<img class="navArrowRight" src="/project/Public/Admin/img/navArrowRight.png"/>
					</a>
				</ul>-->
				<!--二级菜单-->
				<!--<ul class="navSubBox navProductSub">
					<a><li class="navOption">科研</li></a>
					<a><li class="navOption">国外交换</li></a>
					<a><li class="navOption">活动</li></a>
					<a><li class="navOption">竞赛</li></a>
					<a><li class="navOption">Banner管理</li></a>
					<a><li class="navOption">前台管理</li></a>
				</ul>-->
				<!--二级菜单-->
				
			</section>
		</nav>
		</body>
</html>