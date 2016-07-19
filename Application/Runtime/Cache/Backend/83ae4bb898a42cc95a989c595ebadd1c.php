<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>实习独立说</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="/project/Public/Backend/css/reset.css" type="text/css" rel="stylesheet"/>
    <link href="/project/Public/Backend/css/style.css" type="text/css" rel="stylesheet" />
    <script src="/project/Public/Backend/js/jquery2.1.4.min.js"></script>
    <script src="/project/Public/Backend/js/font.js"></script>
    <script src="/project/Public/Backend/js/function.js"></script>
</head>
<body>
<div class="wrap">
    <!--导航栏-->
<nav class="nav">
    <div class="bg_nav"></div>
    <a href="<?php echo U('Personnel/index');?>"><div class="tab2_nav">
        <img class="imgPractice_nav" src="/project/Public/Backend/img/icon-talent.png" />
        <span class="text_nav">人才</span>
    </div></a>
    <a href="<?php echo U('Personnel/student');?>"><div class="tab2_nav">
        <img class="imgPractice_nav" src="/project/Public/Backend/img/icon-appraise.png" />
        <span class="text_nav">实习评价</span>
    </div></a>
    <a href="<?php echo U('Index/index');?>"><div class="tab2_nav">
        <div class="boxMy_nav"><img class="imgMy_nav" src="/project/Public/Backend/img/icon-head3.jpg" /></div>
        <span class="boxMytext_nav textChecked_nav">我的</span>
    </div></a>
</nav>
    <!--页面内容-->
    <section class="content content_myStu">
        <!--学生卡片-->
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="studentCard">
            <!--跳转链接-->
            <a href="<?php echo U('Personnel/comment',array('id'=>$list['id']));?>"><header>
                <!--姓名-->
                <p class="name_studentCard"><?php echo ($list["nickname"]); ?></p>
            </header><section>
                <div class="headBox_studentCard">
                    <!--头像-->
                    <img class="head_studentCard" src="<?php echo ($list["headimgurl"]); ?>" />
                </div>
                <div class="info_studentCard">
                    <!--年级、专业、学校-->
                    <p><?php echo ($list["grade"]); ?><span> | </span><?php echo ($list["major"]); ?></p>
                    <p><?php echo ($list["school"]); ?></p>
                </div>
            </section>
                <footer>
                    <!--评价状态-->
                    <?php if($list['user_status'] == 3){ ?>
                        <p class="green_studentCard">正在等待学生接受offer</p>
                    <?php }else{ if($list['status'] == 1){ ?>
                    <p class="gray_studentCard">已评价</p>
                    <?php }else{ ?>
                    <p class="red_studentCard">尚未评价</p>
                    <?php } ?>

                    <?php } ?>



                </footer></a>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <!--学生卡片-->

    </section>
</div>
</body>
</html>