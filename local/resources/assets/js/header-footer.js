$(document).ready(function(){
	$('#header_btnMenu').click(function(){
		// $('#header-menu .menu-header').css('top', '0');
		$('#header-menu .menu-header').children("li:first-child").html('<a>Chuyên mục</a>');
		$('#header-menu .menu-header').show();
		// setTimeout(function(){
		// 	$('#header-menu .menu-header').find("li").css('margin-left', '0');
		// 	$('.btn_close_menu').css('right', '20%');
		// },500);

	});
	$('.btn_close_menu').click(function(){
		$('#header-menu .menu-header').hide();
		// $('#header-menu .menu-header').find("li").css('margin-left', '-80%');
		// $('.btn_close_menu').css('right', '100%');
		// setTimeout(function(){
		// 	$('#header-menu .menu-header').css('top', '-100%');
		// },500);


	});

	var count1 = 2;
	$('#header-menu .menu-header>li.dropdown').click(function(){
		$(this).find('ul').slideToggle();
		count1 % 2 ? $(this).find('.btn_dropdown_menu_head').css('transform',' rotate(0deg)') :  $(this).find('.btn_dropdown_menu_head').css('transform',' rotate(180deg)');
		count1++;
	});
	
	$(window).resize(function(){
		if ($(window).width() > 768) {
			// $('#header-menu .menu-header').css('top', '0');
			$('#header-menu .menu-header').children("li:first-child").html('<a href="{{ asset("") }}"><i class="fas fa-home"></i></a>');
			$('#header-menu .menu-header').css('display', 'flex');
			$('#header-menu .menu-header').show();
			// $('#header-menu .menu-header').find("li").css('margin-left', '0');
			// $('.btn_close_menu').css('right', '20%');
		}else{
			
			$('#header-menu .menu-header').css('display', 'block');
			$('#header-menu .menu-header').hide();
			// $('#header-menu .menu-header').find("li").css('margin-left', '-80%');
			// $('.btn_close_menu').css('right', '100%');
			// $('#header-menu .menu-header').css('top', '-100%');
		}
		
    });

    $(document).on('click', ".menu_footer_right", function(){
       $('html, body').animate({
          scrollTop: 0
        }, 500);
    });

    if ($('#back-to-top').length) {
		 var scrollTrigger = 100, 
		 backToTop = function () {
		    var scrollTop = $(window).scrollTop();
		    if (scrollTop > scrollTrigger) {
		     $('#back-to-top').addClass('show');
		    } else {
		     $('#back-to-top').removeClass('show');
		    }
		   };
		   backToTop();
		   $(window).on('scroll', function () {
		    backToTop();
		   });
		   $('#back-to-top').on('click', function (e) {
		    e.preventDefault();
		    $('html,body').animate({
		     scrollTop: 0
		    }, 700);
		   });
	}
});