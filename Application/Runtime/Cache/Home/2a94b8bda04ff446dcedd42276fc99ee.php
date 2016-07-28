<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>实习独立说</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    		<link href="/Public/Home/css/reset.css" type="text/css" rel="stylesheet"/>
    		<link href="/Public/Home/css/style.css" type="text/css" rel="stylesheet" />
    		<script src="/Public/Home/js/jquery2.1.4.min.js"></script>
    		<script src="/Public/Home/js/font.js"></script>
    		<script src="/Public/Home/js/function.js"></script>
    		<link href="/Public/Home/css/7.css" rel="stylesheet" type="text/css" />
		    <script src="/Public/Home/js/6.js" type="text/javascript"></script>
			
		
		<script type="text/javascript">
			$(function() {
				var curr = new Date().getFullYear();
				var opt = {

				}

				opt.date = {
					preset: 'date'
				};

				$('select.changes').bind('change', function() {
//					var demo = $('#demo').val();
//					$(".demos").hide();
//					if (!($("#demo_" + demo).length))
//						demo = 'default2';
//						
//					$("#demo_" + demo).show();
					$('#test_default2').scroller('destroy').scroller($.extend(opt["date"], {
						theme: "android-ics",
						mode: "scroller",
						display: "bottom",
						lang: ""
					}));
					$('#test_default1').scroller('destroy').scroller($.extend(opt["date"], {
						theme: "android-ics",
						mode: "scroller",
						display: "bottom",
						lang: ""
					}));
				});
				
				$('#test_default2').click(function(){
					var demo = $('#demo').val();
					$(".demos").hide();
					
					$('#test_default2').val('').scroller('destroy').scroller($.extend(opt["date"], {
						theme: "android-ics",
						mode: "scroller",
						display: "bottom",
						lang: ""
					}));
					
//					$('.dw-bottom .dw-persp .dw').css('top', document.body.clientHeight - 223 + 'px');
				});
				
				$('#test_default1').click(function(){
					var demo = $('#demo').val();
					$(".demos").hide();

					$('#test_default1').val('').scroller('destroy').scroller($.extend(opt["date"], {
						theme: "android-ics",
						mode: "scroller",
						display: "bottom",
						lang: ""
					}));
				});
				

				$('#demo').trigger('change');
			});
		</script>
	</head>
	<body>
		<div class="wrap">
			<!--导航栏-->
		<nav class="nav">
		    <div class="bg_nav"></div>
		    <a href="<?php echo U('Offer/index');?>"><div class="tab_nav tab_on_nav">
		        <img class="imgPractice_nav" src="/Public/Home/img/icon-practice.png" />
		        <span class="text_nav">实习</span>
		    </div></a>
		    <a href="<?php echo U('Index/index');?>"><div class="tab_nav tab_off_nav">
		        <div class="boxMy_nav"><img class="imgMy_nav" src="<?php echo ($data['headimg']?$data['headimg']:$data['headimgurl']); ?>" /></div>
		        <span class="boxMytext_nav  textChecked_nav">我的</span>
		    </div></a>
		</nav>
			<!--页面内容-->
			<section class="content">
				<!--顶部提示栏-->
                 <?php if($data['status']!=3){ ?>
				<div class="tiptop BGtiptop" ><table><tr><td>
					完善个人信息和简历企业才能看到你哦
				</td></tr></table></div>
                <?php } ?>
				<!--页面主要内容-->
				<div class="main">
					<!--头部-->
										<!--头部-->
					<header class="header">
						<!--公众号二维码链接-->
						<div class="QRcodeBox_header">
							<a href="<?php echo U('Index/qrcode');?>"><div class="QRcode_header">
								<img src="/Public/Home/img/icon-QRcode.png" />
								<span>独立说公号</span>
							</div></a>
						</div>
						<!--头像-->
						<div class="head_header upload_btn"><img src="<?php echo ($data['headimg']?$data['headimg']:$data['headimgurl']); ?>" /></div>
						<!--名字-->
						<span class="name_header"><?php echo ($data["nickname"]); ?></span>
						<!--简介／描述-->
						<p class="intro_header" style="display:none;text-align:center;"><?php if($data['desc'] == ''){ ?>40字以内描述一下自己<?php }else{ ?> <?php echo ($data["desc"]); } ?></p>
						<!--tab-->
						<div class="tabBar_header">
							<div class="tab_header myInfo checkedTab_header">个人信息</div>
							<!-- <div class="tab_header myResume">我的简历</div> -->
							<div class="tab_header myResume">我的简历</div>
						</div>
					</header>
					<!--内容-->
					<form class="form" method="post">
					<section class="section">
						<!--编辑信息-->
						<div class="editInfo clearfix myInfo-block">
							<!--姓名-->
							<div class="inputBox_edit width_100">
								<span class="inputTitle1_edit">姓名</span>
								<input class="input_edit" name="name" value="<?php echo ($data["name"]); ?>" />
							</div>
							<!--手机-->
							<div class="inputBox_edit width_100">
								<span class="inputTitle1_edit">手机</span>
								<input class="input_edit" name="mobile" value="<?php echo ($data["mobile"]); ?>" type="tel" maxlength="11" />
							</div>
							<!--年级-->
							<div class="inputBox_edit width_100">
								<span class="inputTitle1_edit">年级</span>
								<input class="input_edit" name="grade" value="<?php echo ($data["grade"]); ?>" />
							</div>
							<!--学校-->
							<div class="inputBox_edit width_100">
								<span class="inputTitle1_edit">学校</span>
								<input class="input_edit" name="school" value="<?php echo ($data["school"]); ?>"/>
							</div>
							<!--专业-->
							<div class="inputBox_edit width_100">
								<span class="inputTitle1_edit">专业</span>
								<input class="input_edit" name="major" value="<?php echo ($data["major"]); ?>" />
							</div>
							<!--优先实习地点-->
							<div style="position:relative;">
								<select class="inputBox_edit width_100" id="address" >
									<option vaule="<?php echo ($data['address']); ?>" selected="selected" disabled="true"><?php echo ((isset($data['address']) && ($data['address'] !== ""))?($data['address']):"可实习地点"); ?></option>
									<option value="北京">北京</option>
									<option value="上海">上海</option>
									<option value="广州">广州</option>
									<option value="深圳">深圳</option>
									<option value="香港">香港</option>
								<select>
								<input style=" position:absolute; top:0; opacity:0; z-index:-1;" id="addressx" type="hidden" name="address" value="<?php echo ($data['address']); ?>"/>
							</div>

							<!--每周工作时间-->
							<div style="position:relative;">
								<select class="inputBox_edit width_100" id="weektime" >
									<option vaule="<?php echo ($data['weektime']); ?>" selected="selected" disabled="true"><?php echo ((isset($data['weektime']) && ($data['weektime'] !== ""))?($data['weektime']):"每周可工作几天"); ?></option>
									<option value="三天">三天</option>
									<option value="四天">四天</option>
									<option value="五天">五天</option>
									<option value="五天以上">五天以上</option>
									
								<select>
								<input style=" position:absolute; top:0; opacity:0; z-index:-1;" id="weektimex" type="hidden" name="weektime" value="<?php echo ($data['weektime']); ?>"/>
							</div>
							<!--优先实习时间-->
							<div class="clearfix">
								<!--开始时间-->
								<div class="inputBox_edit width_10r left">
									<span class="inputTitle2_edit">可实习时间</span>
									<input style="float:right;" id="test_default1" class="input2_edit" name="intern" value="<?php echo ($data['intern']); ?>" readonly />
								</div>
								<!--结束时间-->
								<img class="arrow_edit" src="/Public/Home/img/icon-arrow.png" />
								<div style="text-align:center;" class="inputBox_edit width_552r left">
									<input id="test_default2" class="input2_edit" name="enddate" value="<?php echo ($data['enddate']); ?>" readonly />
								</div>
							</div>
							<!--自我描述-->
							<div class="textareaBox_edit">
								<textarea maxlength="40" name="desc" id="desc" placeholder="40字以内描述一下自己"><?php echo ($data["desc"]); ?></textarea>
								<span class="valueLength_edit"><span class="trueLength" id="result">0</span>/40</span>
							</div>
							<p class="tip_edit"></p>
							<!--保存按钮-->
							<button type="button" class="button-red saveInfo">保存信息</button>
						</div>
						<!--简历部分-->
						<div class="resume myResume-block" style="display: none;">
							<!--未上传-->
							<?php if($data['resume'] == ''){ ?>
							<div class="Upload_resume">
								<img src="/Public/Home/img/icon-UploadResume.png" />
								<button type="button" class="button-red UploadResume_btn">上传我的简历</button>
							</div>
							<?php }else{ ?>
							<!--已上传-->

							<div class="Lookat_resume" style="display: block;">
								<button class="button-resume margin_23467r" type="button" id="LookatResume_btn"><span style="display:block;margin-left:40px;width:155px; white-space:nowrap;text-overflow:ellipsis;overflow:hidden;"><?php echo ($data['pdfname']); ?></span></button>
								<button type="button" class="button-red" onclick="window.location.href='/Home/Offer/upload'">重新上传简历</button>
							</div>
							<?php } ?>
						</div>

					</section>
                    </form>
				</div>
			</section>
			<!--底部弹出栏-->
			<!--Demos-->
			<div class="popup" <?php if($data['is_check'] == 1){ ?> style="display:none" <?php } ?> >
				<div class="bg_popup"></div>
				<div class="box_popup box_popup_editInfo">
					<p class="tiltle_code_popup">请输入官方验证码</p>
					<div class="inputBox_code_popup"><input type="tel" name="password" maxlength="6" unselectable="off" /></div>
					<button class="button-red login">登&nbsp;&nbsp;&nbsp;录</button>
				</div>
			</div>
			
			<div style="display: none;">
				<label for="demo">Demo</label>
				<select name="demo" id="demo" class="changes">
	                <option value="date" selected>Date</option>
					<option value="datetime" >Datetime</option>
					<option value="time" >Time</option>
					<option value="tree_list" >Tree List</option>
					<option value="image_text" >Image & Text</option>
					<option value="select" >Select</option>
	            </select>
			</div>
	
<script>
	$(function(){
		$("#address").on('change',function(){
			var valx = $(this).val();
			//console.log(valx);
			$("#addressx").val(valx);
		}) 

		$("#weektime").on('change',function(){
			var vald = $(this).val();
			console.log(vald);
			$("#weektimex").val(vald);
		}) 		


        $('#result').html($("#desc").val().length); 
        if($(".popup").css("display") == "block"){
        	$("body").css("overflow","hidden");
        }

		<?php  if($data['resume']){ ?>
			$('.Lookat_resume').css('display','none');
			$('.Upload_resume').css('display','none');
			$('.tiptop').css('display','none');
		<?php }else{ $url = U("Offer/upload"); ?>
		$('.UploadResume_btn').click(function(){
			window.location.href="<?php echo ($url); ?>";
		});
		<?php } ?>

		$('.login').click(function(){
			if($("input[name='password']").val().length == 6){
				var code = $("input[name='password']").val();
				var uid = '<?php echo ($data[id]); ?>';
                //alert(uid);
				$.post('<?php echo U("Index/checkCode");?>',{'code':code,'uid':uid},function (res) {
					 //alert(res);return false;
					 var data = $.parseJSON(res);
					if(data.error == 0 ){
						$('.popup').css('display','none');
						$("body").css("overflow","auto");
						//window.location.href="/";
						return true;
					}else{
						alert(data.msg);
						return false;
					}
				});

			}
		});
		/**
		 * editInfo_stu.html
		 * 点击保存时进行验证
		 *
		 */
		$('.saveInfo').click(function(){
			var phoneReg = /^1[34578]\d{9}$/; //手机正则
			if($("input[name='name']").val() == ''){
				$('.tip_edit').html('请填写真实姓名');
				return false;
			}else if( !phoneReg.exec($("input[name='mobile']").val()) ){
				$('.tip_edit').html('请填写正确手机号');
				return false;
			}else if($("input[name='grade']").val() == ''){
				$('.tip_edit').html('请填写年级');
				return false;
			}else if($("input[name='school']").val() == ''){
				$('.tip_edit').html('请填写学校');
				return false;
			}else if($("input[name='major']").val() == ''){
				$('.tip_edit').html('请填写专业');
				return false;
			}else if($("input[name='address']").val() == ''){
				$('.tip_edit').html('请选择想去的实习城市');
				return false;
			}else if($("input[name='weektime']").val() == ''){
				$('.tip_edit').html('请选择一周可工作天数');
				return false;
			}else if($("input[name='intern']").val() == ''){
				$('.tip_edit').html('请填写可开始实习时间截点');
				return false;
			}else if($("input[name='enddate']").val() == ''){
				$('.tip_edit').html('请填写实习结束时间截点');
				return false;
			}else if($("textarea[name='desc']").val() == ''){
				$('.tip_edit').html('请填写自我描述');
				return false;
			}else{
				$('.tip_edit').html('');
				var json = $("form").serialize();
				$.post('<?php echo U("Index/user");?>',{'obj':json},function (result) {
					//console.log(result);return false ;
					var info = $.parseJSON(result);
					if(info.error == 0){
						window.location.href="<?php echo U('Index/index');?>";
					}else{
                        alert('保存失败');
					}
				});
			}
		});
		
		
		/**
		 * editInfo_stu.html  home_stu.html
		 * 顶部提示框的状态和内容的改变
		 *
		 */
		$('.myInfo').click(function(){
			$(this).addClass('checkedTab_header');
			$('.myResume').removeClass('checkedTab_header');
			$('.myInfo-block').css('display','block');
			$('.myResume-block').css('display','none');
			$('.tiptop').css('display','block');
			//$('.tiptop table td').html('完善个人信息才能让企业看到你哦');
		});
		$('.myResume').click(function(){
			$(this).addClass('checkedTab_header');
			$('.myInfo').removeClass('checkedTab_header');
			$('.myInfo-block').css('display','none');
			$('.myResume-block').css('display','block');
			if($('.Lookat_resume').css('display') == 'block'){
				$('.tiptop').css('display','none');
			}else{
				$('.tiptop').css('display','block');
				//$('.tiptop table td').html('上传简历后HR才能联系你哦');
			}
		});
		// $('.UploadResume_btn').click(function(){
		// 	$('.Lookat_resume').css('display','block');
		// 	$('.Upload_resume').css('display','none');
		// 	$('.tiptop').css('display','none');
		// });


		$('#desc').bind('input propertychange', function() { 
		    $('#result').html($(this).val().length);  
	    });
	
	});

	$("#LookatResume_btn").click(function(){
		window.location.href='/Index/readPdf';
	})
</script>

</html>