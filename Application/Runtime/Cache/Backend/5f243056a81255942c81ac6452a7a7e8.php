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
    <section class="content">
        <!--页面主要内容-->
        <div class="main">
            <!--头部-->
            <header class="header">
                <!--占位-->
                <div class="QRcodeBox_header">
                </div>
                <!--头像-->
                <div class="head_header"><img src="<?php echo ($data["headimgurl"]); ?>" /></div>
                <!--名字-->
                <span class="name_header"><?php echo ($data["nickname"]); ?></span>
                <!--简介／描述-->
                <p class="intro2_header"><?php echo ($data["grade"]); ?><span> | </span><?php echo ($data["major"]); ?><span> | </span><?php echo ($data["school"]); ?></p>
            </header>
            <!--内容-->
            <section class="section">
                <form action="<?php echo U('Personnel/commentsave');?>" method="post" class="from">
                <!--个人信息-->
                <div class="information_appraise myInfo-block">
                    <div class="title_appraise">以下描述正确的请打勾</div>
                    <?php $array = unserialize($pro['comment']); ?>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?><!--描述--><?php
 $true = in_array($r['id'],$array); ?>
                    <div class="apprBar_appraise clearfix">
                        <div class="checkedBoxBox_appraise">
                            <?php  if($true) { ?>
                            <!--未选中-->
                            <img class="checkedBox_appraise hidden" src="/project/Public/Backend/img/btn-checkedBox.png" />
                            <!--选中-->
                            <img class="checked_appraise" src="/project/Public/Backend/img/btn-checked.png" />

                            <input type="checkbox" value="<?php echo ($r["id"]); ?>" name="blem[]"  style="display: none;" checked>
                            <?php }else{ ?>
                            <img class="checkedBox_appraise" src="/project/Public/Backend/img/btn-checkedBox.png" />
                            <!--选中-->
                            <img class="checked_appraise hidden" src="/project/Public/Backend/img/btn-checked.png" />

                            <input type="checkbox" value="<?php echo ($r["id"]); ?>" name="blem[]"  style="display: none;" >
                            <?php } ?>
                        </div>
                        <div class="textBox_appraise width_apprBar_appraise">
                            <p class="text_appraise"><?php echo ($r["content"]); ?></p>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" >
                    <!--写评价-->
                    <div class="title2_appraise">请留下您的评语</div>
                    <!--自我描述-->
                    <div class="textareaBox2_edit">
                        <textarea maxlength="40" name="appraise" placeholder="请填写您对此学生的详细评价"><?php echo ($pro["content"]); ?></textarea>
                    </div>
                    <button class="button-red marginBtn_appraise" >保存评价</button>
                </div>
                </form>
            </section>
        </div>
    </section>
</div>
<script>
    $(function(){
        $('.marginBtn_appraise').click(function(){
            $('.from').submit();
        });
        /**
         * editAppraise_etp.html
         * 描述选中／未选中切换
         *
         */
        $('.apprBar_appraise').click(function(){

            if($(this).find('.checkedBox_appraise').hasClass('hidden')){
                $(this).find('input').click();
                $(this).find('.checkedBox_appraise').removeClass('hidden');
                $(this).find('.checked_appraise').addClass('hidden');
            }else{
                $(this).find('input').click();
                $(this).find('.checked_appraise').removeClass('hidden');
                $(this).find('.checkedBox_appraise').addClass('hidden');
            }
        });
    });
</script>
</body>
</html>