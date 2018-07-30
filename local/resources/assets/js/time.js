$(document).ready(function(){
    $('ul li a').click(function(){
        $('li a').removeClass("active");
        $(this).addClass("active");
    });


    var countBtnShowList = 0;
    $('.btnShowListMenu').click(function(){
    	if (countBtnShowList == 0) {
    		$(this).prev().css('max-height','1000px');
    		countBtnShowList = 1;
    	}else{
			$(this).prev().css('max-height','40px');
    		countBtnShowList = 0;
    	}
    });

    $(window).resize(function(){
		if ($(window).width() > 768) {
				
		}else{
			
		}
		
    });
});