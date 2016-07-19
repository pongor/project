$(function(){
	$('.close, .yes, .no').click(function(){
		$(this).parents('.box_popup').css('display','none');
		$('.popup').css('display','none');
	});
	
	$('.deleteBtn').click(function(){
		$('.popup').css('display','block');
		$('.delete').css('display','block');
	});

	
	/**
	 *  input获取焦点时边框颜色变化
	 *	
	 */
	$('.input_code').focus(function(){
		$(this).css('border-color','#FF2D52');
	});
	$('.input_code').blur(function(){
		$(this).css('border-color','#cecfcf');
	});
	
	
	
	
	/**
	 *  点击‘获取验证码’，验证手机号
	 *	
	 */
	$('#getCode').click(function(){
		var phoneReg = /^1[34578]\d{9}$/; //手机正则
		if( phoneReg.exec($('input[name=phone]').val()) ){
			//验证成功
			//倒计时
			if($(this).hasClass('on')){
				setTime(60,'getCode');
				$(this).removeClass('on');
			}
			$('.tipBox_code p').css('display','none');
		}else{
			//验证失败
			$('.tipBox_code p').css('display','block');
			$('.tipBox_code p span').html('您的手机号填写错误');
		}
	});
	
	/**
	 *  点击‘确认登录’，验证验证码
	 *	
	 */
	$('.Login').click(function(){
		if($('input[name=code]').val() == ''){
			//验证失败
			$('.tipBox_code p').css('display','block');
			$('.tipBox_code p span').html('您的验证码填写错误');
		}else{
			//验证成功	
			$('.tipBox_code p').css('display','none');
		}
	});
	
	
	
	
});


/**
 *  按钮倒计时
 *	
 */
function setTime(countdown,codeButtonId) {
	var codeButton = document.getElementById(codeButtonId);
	if (countdown == 0) {
		codeButton.innerHTML = "发送验证码";
		$(codeButton).addClass('on');
		$(codeButton).css('background-color','#FF2D52');
	}else{  
		$(codeButton).css('background-color','#999999');
		codeButton.innerHTML = "重新获取(" + countdown + ")"; 
		countdown--; 
		setTimeout(function(){setTime(countdown,codeButtonId)},1000);
	} 
} 