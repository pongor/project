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
            <img class="imgPractice_nav" src="/Public/Backend/img/icon-appraiseChecked.png" />
            <span class="textChecked_nav">实习评价</span>
        </div></a>
        <a href="<?php echo U('Index/index');?>"><div class="tab2_nav">
            <div class="boxMy2_nav"><img class="imgMy_nav" src="<?php echo ($selfimg); ?>" /></div>
            <span class="boxMytext_nav text_nav">我的</span>
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
            <div class="head2_header">
                <!--头像-->
                <img class="imgHead_header" src="<?php echo ($data['headimg']?$data['headimg']:$data['headimgurl']); ?>" />
                <?php if($data['user_status'] ==1){ ?>
                <img class="enroll_studentCard" src="/Public/Backend/img/icon-enroll.png"/>
                <?php } ?>
            
            </div>

                <!--名字-->
                <span class="name_header"><?php echo ($data["name"]); ?></span>
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
                            <img class="checkedBox_appraise hidden" src="/Public/Backend/img/btn-checkedBox.png" />
                            <!--选中-->
                            <img class="checked_appraise" src="/Public/Backend/img/btn-checked.png" />

                            <input type="checkbox" value="<?php echo ($r["id"]); ?>" name="blem[]"  style="display: none;" checked>
                            <?php }else{ ?>
                            <img class="checkedBox_appraise" src="/Public/Backend/img/btn-checkedBox.png" />
                            <!--选中-->
                            <img class="checked_appraise hidden" src="/Public/Backend/img/btn-checked.png" />

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
                        <textarea maxlength="140" name="appraise" placeholder="请填写您对此学生的详细评价(限140字内)"><?php echo ($content); ?></textarea>
                    </div>
                    <button type="button" class="button-red marginBtn_appraise" >保存评价</button>
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