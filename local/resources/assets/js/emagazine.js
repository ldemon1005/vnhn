$(document).ready(function(){
	
	var url = $('.currentUrl').text();
	$(window).scroll(function(){
		var footer = $('#footer').offset().top;
		var scroll = $(window).scrollTop();
		if (scroll + $(window).height() > footer) {
			$('.btnLoad').click();
			$('.btnLoad').attr('class', 'btnNone');	
		}
	});
	var count = 1;
	// $('.btnLoad').one("click", function(){
		
	// });
	$(document).on('click', '.btnLoad', '.btnLoad:not(.clicked)' , function(event) {
		$('.loadMore').css('display', 'block');

	    var btnThis = $(this);
	    var id = $(this).next().text();
	    var btnNext = btnThis.parent().next().find('.btnDeni');
	    console.log(btnNext.text());
	    setTimeout(function(){
	    	$.ajax({
		      method: 'POST',
		      url: url+'magazine/load_more',
		      data: {
		          '_token': $('meta[name="csrf-token"]').attr('content'),
		          'count': count
		      },
		      success: function (resp) {
		      	console.log(resp);
		      	if (resp.length != 0) {
		      		var content = '';
			      	for (var i = 0; i < resp.length; i++) {
			      		content += '<div class="col-md-4 col-sm-6 col-xs-12 articleItemBig">';
						content += '<div class="articleItem">';
						content += '<a  href="'+url+'magazine/'+resp[i].e_slug+'" class="articleItemAva" style="background: url(\''+url+'local/storage/app/emagazine/resized-'+resp[i].e_img+'\') no-repeat center /cover;"></a>';
						content += '<div class="articleItemTitle">';
						content += '<h2><a href="'+url+'magazine/'+resp[i].e_slug+'">'+resp[i].e_title+'</a></h2>';
						content += '<div class="articleItemTitleMini"><span class="articleItemTime">'+resp[i].created_at+'</span><span class="articleItemView"><i class="fas fa-eye">'+resp[i].e_vỉew +'</i></span></div>';
						content += '</div><div class="articleItemContent">'+resp[i].e_summary+'</div></div></div>';
			      	}
			      	$('.contentMain').append(content);	

			        count++;
			        $('.btnNone').attr('class', 'btnLoad');	
		      	}
			      	
		        $('.loadMore').css('display', 'none');

		      },
		      error: function () {
		        alert('Lỗi tải trang');
		      }
		    });
	    },500);
		    
  	});

});