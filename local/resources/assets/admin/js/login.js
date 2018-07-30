$(document).ready(function(){
	var username = localStorage.getItem('username');
	var url  = window.location.href;
	url = url.replace('login', 'lockscreen?username='+username);
	if (username != null) {
		window.location.href = url;
	}
});

