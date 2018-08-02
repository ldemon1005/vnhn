$(document).ready(function(){
	$('.btnShowMenuChild').click(function(){
		$(this).prev().slideToggle();
	});
});