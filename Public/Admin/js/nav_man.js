$(function(){

	/**
	 * 导航栏：选中切换效果
	 */
	$('.navOption').click(function(){
		$('.navOption').each(function(){
			$(this).removeClass('navSelected');
			$(this).css('color','#FFFFFF');
		});
		$(this).addClass('navSelected');
		$(this).css('color',' #4776c9');
	});
	
	/**
	 * 导航栏：子菜单展开收起
	 */
	$('.navProduct').click(function(){
		$('.navProductSub').slideToggle();
		if($(this).children(':last').children(':last').hasClass('navArrowRight')){
			$(this).children(':last').children(':last').removeAttr('src');
			$(this).children(':last').children(':last').removeClass('navArrowRight').addClass('navArrowDown');
			$(this).children(':last').children(':last').attr('src','img/navArrowDown.png');
		}else{
			$(this).children(':last').children(':last').removeAttr('src');
			$(this).children(':last').children(':last').removeClass('navArrowDown').addClass('navArrowRight');
			$(this).children(':last').children(':last').attr('src','img/navArrowRight.png');
		}
	});
	
})
	