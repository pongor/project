$(function(){

	/**
	 * manage : section-初始化上下边距
	 */
	$('.mod_section').css('padding-top',$('.mod_header').css('height'));
	$('.mod_section').css('padding-bottom',$('.mod_footer').css('height'));
	
	
	/**
	 * 表格：初始化宽度和颜色
	 */
	$(".TWT_Act td").each(function(){
		var width = $(this).attr('class').split('TWT')[1];
		$(this).attr('width',width+'%');
	});
	
	$(".mod_tbody tr:odd").css('background-color','#FFFFFF');
	$(".mod_tbody tr:even").css('background-color','#f7f7f7');

	/**
	 * display: 是否显示在企业端
	 */
	$('.display').click(function(){
		if($(this).hasClass('unused')){
			$(this).removeClass('unused');
		}else{
			$(this).addClass('unused');
		}
	});

	/**
	 * slew: 选中页码的样式变化
	 */
	$(".cell_slewOne li").click(function(){
		$(this).addClass("offSlew").siblings().removeClass("offSlew");
	});	
	
	/**
	 * tfng\trade\advertising : 添加题目\添加行业\添加广告
	 */
	$('.addButton').click(function(){
		var mod = $('.modeladd').clone(true);
		mod.removeClass('modeladd');
		$('.targettbody').append(mod);
		$(".mod_tbody tr:odd").css('background-color','#FFFFFF');
		$(".mod_tbody tr:even").css('background-color','#f7f7f7');
	});

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

});