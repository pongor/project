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
                <div class="boxMy2_nav"><img class="imgMy_nav" src="<?php echo ($selfimg); ?>" /></div>
                <span class="boxMytext_nav text_nav">我的</span>
            </div></a>
        </nav>
    <!--页面内容-->
    <section class="content">
        <div class="content_stuDet">
            <!--占位-->
            <div class="QRcodeBox_header">
            </div>
            <?php $house = D('House'); $r = $house ->getInfo(array('company_id' => $user_id,'user_id' => $data['id'])); ?>
            <img class="collect_stuDet uncollect" id="uncollect_<?php echo ($data["id"]); ?>" src="<?php echo $r ? '/Public/Backend/img/btn-collect.png' : '/Public/Backend/img/btn-uncollect.png'; ?>" onclick="add(<?php echo ($data["id"]); ?>)" />
            <div class="head2_header">
                <!--头像-->
                <img class="imgHead_header" src="<?php echo ($data['headimg']?$data['headimg']:$data['headimgurl']); ?>" />
                <?php if($nb){ ?>
                <img class="enroll_studentCard" src="/Public/Backend/img/icon-enroll.png"/>
                <?php } ?>
            
            </div>
            <!--名字-->
            <span class="name_header"><?php echo ($data["name"]); ?></span>
            <!--简介／描述-->
            <p class="intro_header" style="text-align:center"><?php echo ($data["desc"]); ?></p>
            <!--个人信息-->
            <div class="information myInfo-block"><!-- 
                <img class="iconInfo" src="/Public/Backend/img/icon-info-phone.png" />
                <p class="textInfo"><?php echo ($data["mobile"]); ?></p> -->
                <img class="iconInfo" src="/Public/Backend/img/icon-info-grade.png" />
                <p class="textInfo"><?php echo ($data["grade"]); ?></p>
                <img class="iconInfo" src="/Public/Backend/img/icon-info-college.png" />
                <p class="textInfo"><?php echo ($data["school"]); ?></p>
                <img class="iconInfo" src="/Public/Backend/img/icon-info-major.png" />
                <p class="textInfo"><?php echo ($data["major"]); ?></p>
                <?php if($data['weektime']){ ?>
                <img class="iconInfo" src="/Public/Backend/img/icon-info-time.png" />
                <p class="textInfo noMargin">每周可工作 : <?php echo ($data["weektime"]); ?></p>
                <?php }?>
            </div>
            <a href="<?php echo U('Backend/Personnel/readPdf',array('uid'=>$data['id']));?>"><button class="button-resume"><?php echo ($data["name"]); ?>的简历.PDF</button></a>
            
            <a href="tel:<?php echo ($data["mobile"]); ?>" style="display:<?php if(((!$nb)||($data['result']!='yifasong'))&&($data['result']!='weifasong')){echo 'none';}else{echo 'block';}?>"><button class="button-red margin_btn2_stuDetErol">电话联系面试</button></a>
            <a style="display:<?php if((($nb)||($data['result']=='yifasong'))){echo 'none';}else{echo 'block';}?>"><button class="button-white margin_btn3_stuDetErol wantToSendOffer">发送录用通知</button></a>

            <button class="button-white margin_btn3_stuDetErol" style="display:<?php if(($data['result']=='yifasong')&&(!$nb)){echo 'block';}else{echo 'none';}?>">已发送录用通知</button>
            

        </div>
    </section>
    <!--确认接受弹出框-->
    <div class="popup" style="display: none;">
        <div class="bg_popup"></div>
        <!--填写个人信息弹出框-->
        <div class="box_popup box2_popup_studet" style="display: none;">
            <img class="icon_popup_offer" src="/Public/Backend/img/icon-edit.png" />
            <p class="tipText text_popup_studet">您还没有填写个人信息</p>
            <p class="tipText text2_popup_studet">请填写个人信息后再发送录取通知</p>
            <!-- 接受 -->
            <a href="<?php echo U('Index/index');?>"><button class="button-red editInfoPlease" style="letter-spacing: 0;">确&nbsp;&nbsp;&nbsp;认</button></a>
            <!-- 关闭弹出框 -->
            <img class="close_popup_offer closeOffer" src="/Public/Backend/img/btn-close.png" />
        </div>
        <!--发送录取通知弹出框-->
        <div class="box_popup box_popup_studet" style="display: none;">
            <img class="icon_popup_offer" src="/Public/Backend/img/icon-dialog.png" />
            <p class="tipText text_popup_offer">请先面试该学生,再发送录取通知</p>
            <!-- 接受 -->
            <button class="button-red sendOffer" style="letter-spacing: 0;">已经通过面试·发送录取通知</button>
            <!-- 关闭弹出框 -->
            <img class="close_popup_offer closeOffer" src="/Public/Backend/img/btn-close.png" />
        </div>
        <!--发送成功弹出框-->
        <div class="box_popup box3_popup_studet sendSuccess" style="display: none;">
            <img class="icon_popup_offer" src="/Public/Backend/img/icon-ok.png" />
            <p class="tipText text_popup_studet">您已发送录取通知！</p>
            <p class="tipText text3_popup_studet">请等待学生确认</p>
            <!-- 关闭弹出框 -->
            <img class="close_popup_offer closeOffer" src="/Public/Backend/img/btn-close.png" />
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

        $(".closeOffer").click(function(){
            window.location.href="";
        })

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