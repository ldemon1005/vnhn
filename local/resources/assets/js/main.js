$(document).ready(function(){
	$('.btnShowMenuChild').click(function(){
		$(this).next().slideToggle();
	});
});