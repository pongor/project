
$(function(){

	
	/**
	 * edit*** 编辑信息
	 * 聚焦／失焦时的样式变化
	 *
	 */
	 $(".inputBox_edit input, .textareaBox_edit textarea, .textareaBox_editRecord textarea").focus(function(){
          $(this).parents('.inputBox_edit, .textareaBox_edit, .textareaBox_editRecord').css('border-color','#ff627d');
     });  
     $(".inputBox_edit input, .textareaBox_edit textarea, .textareaBox_editRecord textarea").blur(function(){
          $(this).parents('.inputBox_edit, .textareaBox_edit, .textareaBox_editRecord').css('border-color','#B5B5B6');
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
		}else if( !phoneReg.exec($("input[name='phone']").val()) ){
			$('.tip_edit').html('请填写正确手机号');
			return false;
		}else if($("input[name='grade']").val() == ''){
			$('.tip_edit').html('请填写年级');
			return false;
		}else if($("input[name='college']").val() == ''){
			$('.tip_edit').html('请填写学校');
			return false;
		}else if($("input[name='major']").val() == ''){
			$('.tip_edit').html('请填写专业');
			return false;
		}else if($("input[name='startTime']").val() == ''){
			$('.tip_edit').html('请填写可开始实习时间截点');
			return false;
		}else if($("input[name='endTime']").val() == ''){
			$('.tip_edit').html('请填写实习结束时间截点');
			return false;
		}else if($("textarea[name='intro']").val() == ''){
			$('.tip_edit').html('请填写自我描述');
			return false;
		}else{
			$('.tip_edit').html('');
			window.location.href='home_stu.html';
		}
	});
	
	
	
	/**
	 * editInfo_stu.html 
	 * textarea显示字数变化
	 *
	 */
	$("textarea[name='intro']").on('input',function(){
		if($(this).val().length < 40){
			$('.trueLength').html($(this).val().length);
		}else{
			$('.trueLength').html(40);
		}
	});
	
	$("input[name='password']").on('input',function(){
		if($(this).val().length == 6){
			$(this).blur();
		}
	});
	
	$('.login').click(function(){
		if($("input[name='password']").val().length == 6){
			$('.popup').css('display','none');
		}
	});
	
	/**
	 * popup
	 * 禁止屏幕上下滑动
	 *
	 */
//	if($('.popup').css('display') == 'block'){
//		$('body, .content').on('touchmove', function (event) {
//		    event.preventDefault();
//		});		
//	}
	
	/**
	 * recordList.html
	 * 操作框的弹出和收起
	 *
	 */
	$('.showhiddOpera').click(function(event){
		event.stopPropagation();
		if($(this).hasClass('off')){
			$(this).removeClass('off').addClass('on');
			$(this).siblings(".operaRecord").animate({width:"10.6667rem"},'fast');
		}else{
			$(this).removeClass('on').addClass('off');
			$(this).siblings(".operaRecord").animate({width:"0rem"},'fast');
		}
	});
	$('.operaRecord').click(function(event){
		event.stopPropagation();
	});
	$('html, body, .content').click(function(){
		$('.showhiddOpera').each(function(){
			if(!$(this).hasClass('off')){
				$(this).removeClass('on').addClass('off');
				$(this).siblings(".operaRecord").animate({width:"0rem"},'fast');
			}
		});
		if(!$('.showhiddOpera').hasClass('off')){
			$('.showhiddOpera').removeClass('on').addClass('off');
			$(".operaRecord").animate({width:"0rem"},'fast');
		}
	});


	/**
	 * recordList.html
	 * 删除记录
	 *
	 */
	$('.deleteRecord').click(function(){
		$(this).parents('.box_record').remove();
	});
	
	
	/**
	 * offer_stu.html
	 * 打开／关闭弹出框
	 *
	 */
	$('.acceptOffer').click(function(){
		$('.popup').css('display','block');
	});
	$('.closeOffer').click(function(){
		$('.popup').css('display','none');
		$('.sendSuccess').css('display','none');
		$('.sendOffer').parents('.box_popup').css('display','none');
		$('.editInfoPlease').parents('.box_popup').css('display','none');
	});
	


	/**
	 * studentList_etp.html
	 * 点击tab切换内容
	 *
	 
	$('.allStu').click(function(){
		$(this).addClass('checkedTab_header');
		$('.collectStu').removeClass('checkedTab_header');
		$('.allStu-block').css('display','block');
		$('.collectStu-block').css('display','none');
	});
	$('.collectStu').click(function(){
		$(this).addClass('checkedTab_header');
		$('.allStu').removeClass('checkedTab_header');
		$('.allStu-block').css('display','none');
		$('.collectStu-block').css('display','block');
	});
	*/



	


});

