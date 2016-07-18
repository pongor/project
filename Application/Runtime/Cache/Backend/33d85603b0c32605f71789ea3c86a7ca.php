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
        <div class="content_stuDet">
            <!--占位-->
            <div class="QRcodeBox_header">
            </div>
            <?php $house = D('House'); $r = $house ->getInfo(array('company_id' => $user_id,'user_id' => $data['id'])); ?>
            <img class="collect_stuDet uncollect" id="uncollect_<?php echo ($data["id"]); ?>" src="<?php echo $r ? '/project/Public/Backend/img/btn-collect.png' : '/project/Public/Backend/img/btn-uncollect.png'; ?>" onclick="add(<?php echo ($data["id"]); ?>)" />
            <div class="head2_header">
                <!--头像-->
                <img class="imgHead_header" src="<?php echo ($data["headimgurl"]); ?>" />
            </div>
            <!--名字-->
            <span class="name_header"><?php echo ($data["name"]); ?></span>
            <!--简介／描述-->
            <p class="intro_header"><?php echo ($data["desc"]); ?></p>
            <!--个人信息-->
            <div class="information myInfo-block">
                <img class="iconInfo" src="/project/Public/Backend/img/icon-info-phone.png" />
                <p class="textInfo"><?php echo ($data["mobile"]); ?></p>
                <img class="iconInfo" src="/project/Public/Backend/img/icon-info-grade.png" />
                <p class="textInfo"><?php echo ($data["grade"]); ?></p>
                <img class="iconInfo" src="/project/Public/Backend/img/icon-info-college.png" />
                <p class="textInfo"><?php echo ($data["school"]); ?></p>
                <img class="iconInfo" src="/project/Public/Backend/img/icon-info-major.png" />
                <p class="textInfo"><?php echo ($data["major"]); ?></p>
                <img class="iconInfo" src="/project/Public/Backend/img/icon-info-time.png" />
                <p class="textInfo noMargin">可实习时间 <?php echo ($data["intern"]); ?>-<?php echo ($data["enddate"]); ?></p>
            </div>
            <a href="<?php echo ($data["resume"]); ?>"><button class="button-resume"><?php echo ($data["name"]); ?>的简历.PDF</button></a>
            <?php
 $model = D('Pushs'); $res = $model->getInfo(array('company_id' =>$id,'user_id' => $data['id'])); if(!$res){ ?>
            <button class="button-red margin_btn2_stuDetErol">电话邀约面试</button>
            <button class="button-white margin_btn3_stuDetErol wantToSendOffer">发送录用通知</button>
            <?php }else{ ?>
            <button class="button-white margin_btn3_stuDetErol">已发送录用通知</button>
            <?php } ?>

        </div>
    </section>
    <!--确认接受弹出框-->
    <div class="popup" style="display: none;">
        <div class="bg_popup"></div>
        <!--填写个人信息弹出框-->
        <div class="box_popup box2_popup_studet" style="display: none;">
            <img class="icon_popup_offer" src="/project/Public/Backend/img/icon-edit.png" />
            <p class="tipText text_popup_studet">您还没有填写个人信息</p>
            <p class="tipText text2_popup_studet">请填写个人信息后再发送录取通知</p>
            <!-- 接受 -->
            <button class="button-red editInfoPlease" style="letter-spacing: 0;">确&nbsp;&nbsp;&nbsp;认</button>
            <!-- 关闭弹出框 -->
            <img class="close_popup_offer closeOffer" src="/project/Public/Backend/img/btn-close.png" />
        </div>
        <!--发送录取通知弹出框-->
        <div class="box_popup box_popup_studet" style="display: none;">
            <img class="icon_popup_offer" src="/project/Public/Backend/img/icon-dialog.png" />
            <p class="tipText text_popup_offer">请先面试该学生后在发送录取通知书</p>
            <!-- 接受 -->
            <button class="button-red sendOffer" style="letter-spacing: 0;">已经通过面试·发送录取通知</button>
            <!-- 关闭弹出框 -->
            <img class="close_popup_offer closeOffer" src="/project/Public/Backend/img/btn-close.png" />
        </div>
        <!--发送成功弹出框-->
        <div class="box_popup box3_popup_studet sendSuccess" style="display: none;">
            <img class="icon_popup_offer" src="/project/Public/Backend/img/icon-ok.png" />
            <p class="tipText text_popup_studet">您已发送录取通知书！</p>
            <p class="tipText text3_popup_studet">请等待学生确认</p>
            <!-- 关闭弹出框 -->
            <img class="close_popup_offer closeOffer" src="/project/Public/Backend/img/btn-close.png" />
        </div>
    </div>
</div>
<script>
    /**
     * studentDetail_etp.html  studentDetailEnroll_etp.html
     * 收藏／未收藏切换
     *
     */
    function add(id){
        $.post('<?php echo U("Personnel/house");?>',{'id':id},function (res) {
            var data = $.parseJSON(res);
            if(data.error == 0  ){
                if(data.del == 1){
                    $('#uncollect_'+id).attr('src','/project/Public/Backend/img/btn-collect.png');
                    $('#uncollect_'+id).removeClass('uncollect').addClass('collect');
                }else{

                    $('#uncollect_'+id).attr('src','/project/Public/Backend/img/btn-uncollect.png');
                    $('#uncollect_'+id).removeClass('collect').addClass('uncollect');
                }

            }else{
                alert(data.msg);return;
            }
        });
    }
    $(function(){
        /**
         * studentDetail_etp.html
         * 发送录取通知－弹出框切换
         *
         */
        $('.wantToSendOffer').click(function(){
            var id = '<?php echo ($data["id"]); ?>';
            $.post('<?php echo U("Personnel/offer");?>',{'id':id},function (res) {
                var result = $.parseJSON(res);
                if(result.error != 0){
                    $('.popup').css('display','block');
                    $('.editInfoPlease').parents('.box_popup').css('display','block');return;
                }else{
                    $('.box_popup_studet').css('display','block');
                    $('.popup').css('display','block');
                }
            });
            /*
            $('.editInfoPlease').click(function(){
                $(this).parents('.box_popup').css('display','none');
                $('.sendOffer').parents('.box_popup').css('display','block');
            });
            $('.sendOffer').click(function(){
                $(this).parents('.box_popup').css('display','none');
                $('.sendSuccess').css('display','block');
            });
            */

        });
        var id = '<?php echo ($data["id"]); ?>';
        $('.sendOffer').click(function () {
            $.post('<?php echo U("Personnel/sendoffer");?>',{'id':id},function (data) {
                var t = $.parseJSON(data);
                if(t.error == 0){

                    $('.box_popup_studet').css('display','none');
                    $('.sendSuccess').css('display','block');
                    $('.popup').css('display','block');

                }else{
                    alert(t.msg);return;
                }
            });
        });

    });
</script>
</body>
</html>