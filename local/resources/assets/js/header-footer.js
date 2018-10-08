$(document).ready(function(){
	

    // $(document).on('click', ".menu_footer_right", function(){
    //    $('html, body').animate({
    //       scrollTop: 0
    //     }, 500);
    // });

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

	$('#desk-mobile').click(function () {
        $.ajax({
            url: url+'desktop_mobile',
            method: 'get',
            dataType: 'json',
        }).fail(function (ui, status) {
        }).done(function (data, status) {
            console.log("chào");
            if (data.status == 1) window.location.reload();
        })
    });

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