$(function(){

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
		$('.tiptop table td').html('完善个人信息才能让企业看到你哦');
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
			$('.tiptop table td').html('上传简历后HR才能联系你哦');
		}
	});
	
	$('.LookatResume_btn').click(function(){
		$('.Lookat_resume').css('display','none');
		$('.Upload_resume').css('display','block');
		$('.tiptop').css('display','block');
		$('.tiptop table td').html('上传简历后HR才能联系你哦');
	});
	
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


});

