$(document).ready(function(){
	var username = localStorage.getItem('username');
	$('input[type=hidden]#username').val(username);
});
function goLogin(){
	localStorage.removeItem('username');
	return true;
}