$(document).ready(function(){
	var username = localStorage.getItem('username');
	if (username != null) {
		window.location.href = 'http://localhost/vnhn/lockscreen?username='+username;
	}
});

