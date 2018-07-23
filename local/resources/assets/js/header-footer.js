$(document).ready(function(){
	$('#header_btnMenu').click(function(){
		$('#header-menu .menu-header').css('top', '0');
		$('#header-menu .menu-header').children("li:first-child").html('<a>Chuyên mục</a>');
		setTimeout(function(){
			$('#header-menu .menu-header').find("li").css('margin-left', '0');
			$('.btn_close_menu').css('right', '20%');
		},500);
		
	});
	$('.btn_close_menu').click(function(){
		$('#header-menu .menu-header').find("li").css('margin-left', '-80%');
		$('.btn_close_menu').css('right', '100%');
		setTimeout(function(){
			$('#header-menu .menu-header').css('top', '-100%');
		},500);
		
		
	});

	var count1 = 2;
	$('.btn_dropdown_menu_head').click(function(){
		$(this).next().slideToggle();
		// count1 % 2 ? $(this).css('transform',' rotate(0deg)') :  $(this).css('transform',' rotate(180deg)');
		// count1++;
	});
});