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
	$('.menuHeaderItem .btn_dropdown_menu_head').click(function(){
		$(this).prev().slideToggle();
		// count1 % 2 ? $(this).css('transform',' rotate(0deg)') :  $(this).css('transform',' rotate(180deg)');
		// count1++;
	});
	$('.dropdown').click(function(){
		$(this).find('.dropdown_child').slideToggle();
		// count1 % 2 ? $(this).css('transform',' rotate(0deg)') :  $(this).css('transform',' rotate(180deg)');
		// count1++;
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


	$('.btnShowSearch').click(function(){
		
	});
	$(document).on('click', ".btnShowSearch", function(){
        $('.formSearchHide').show();
		$('.formSearchHide').css('width', '392px');
    });
    $(document).on('focusout', ".inputFormSearch", function(){
        $('.formSearchHide').css('width', '0px');
         $('.formSearchHide').hide();
        setTimeout(function(){
           
        }, 500)
        
    });
});
var url = $('.currentUrl').text();

function ad_view(ad_id){
    var btnThis = $(this);
   
    $.ajax({
      method: 'POST',
      url: url+'ad_view',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': ad_id
      },
      success: function () {
       	return true;
      },
      error: function () {
      	// alert('Lỗi Server');
      	console.log('Lỗi Server')
        return false;
      }
    });
	return false;
}

function article_view(news_id){
    var btnThis = $(this);

    $.ajax({
      method: 'POST',
      url: url+'article_view',
      data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': news_id
      },
      success: function () {
       	return true;
      },
      error: function () {
      	console.log('Lỗi Server')
      	// alert('Lỗi Server');
        return false;
      }
    });
	return false;
}