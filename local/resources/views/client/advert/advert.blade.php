<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<base href="{{ asset('local/resources/assets/') }}/">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Quảng cáo</title>
	<link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Quyeens" />
	<meta name="description" content="fullPage very simple demo." />
	<meta name="keywords"  content="fullpage,jquery,demo,simple" />
	<meta name="Resource-type" content="Document" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/fullpage.css" />
	<link rel="stylesheet" type="text/css" href="css/advert.css" />

</head>
<body>

<div class="logo">
	<a href="{{ asset('') }}">
		<img src="images/logo.png">
	</a>
	
</div>
<div class="footer">
	<img src="images/Vector.png">
</div>
<div class="backgroundBody">
	<div id="particles-js" style="height: 100%"></div>

</div>

<div id="fullpage">
	<div class="section active" id="section0">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-sm-12">
					<div class="sectionLeft">
						<h2>PR bài viết</h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>

						<div class="btn_group">
							<a href="{{ asset('advert/contact') }}" class="btnContact">
								Liên hệ quảng cáo
							</a>
							<a href="{{ asset('local/resources/assets/file/bang-gia.pdf') }}" class="btnDownload" target="blank">
								Bảng giá chi tiết
							</a>
						</div>
					</div>
						
				</div>
				<div class="col-md-5 col-sm-0">
					<div class="sectionRight">
						<div class="sectionImg" style="background: url('images/image (1).png') no-repeat center /cover"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section" id="section1">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-sm-12">
					<div class="sectionLeft">
						<h2>PR Tạp chí in</h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>

						<div class="btn_group">
							<a href="{{ asset('advert/contact') }}" class="btnContact">
								Liên hệ quảng cáo
							</a>
							<a href="{{ asset('local/resources/assets/file/bang-gia.pdf') }}" class="btnDownload" target="blank">
								Bảng giá chi tiết
							</a>
						</div>
					</div>
						
				</div>
				<div class="col-md-5 col-sm-0">
					<div class="sectionRight">
						<div class="sectionImg" style="background: url('images/image (2).png') no-repeat center /cover"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section" id="section2">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-sm-12">
					<div class="sectionLeft">
						<h2>PR Báo điện tử</h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>

						<div class="btn_group">
							<a href="{{ asset('advert/contact') }}" class="btnContact">
								Liên hệ quảng cáo
							</a>
							<a href="{{ asset('local/resources/assets/file/bang-gia.pdf') }}" class="btnDownload" target="blank">
								Bảng giá chi tiết
							</a>
						</div>
					</div>
						
				</div>
				<div class="col-md-5 col-sm-0">
					<div class="sectionRight">
						<div class="sectionImg" style="background: url('images/image (3).png') no-repeat center /cover"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/advert.js"></script>
<script type="text/javascript" src="js/fullpage.js"></script>
<script type="text/javascript" src="js/particle/particles.js"></script>
<script type="text/javascript" src="js/particle/app.js"></script>
<script type="text/javascript" src="js/particle/stats.js"></script>
<script type="text/javascript">
	var myFullpageBig = new fullpage('#fullpage', {
		
	});
	/* ---- particles.js config ---- */

	particlesJS("particles-js", {
	  "particles": {
	    "number": {
	      "value": 80,
	      "density": {
	        "enable": true,
	        "value_area": 1000
	      }
	    },
	    "color": {
	      "value": "#ccc"
	    },
	    "shape": {
	      "type": "circle",
	      "stroke": {
	        "width": 0,
	        "color": "#000000"
	      },
	      "polygon": {
	        "nb_sides": 5
	      },
	      "image": {
	        "src": "img/github.svg",
	        "width": 100,
	        "height": 100
	      }
	    },
	    "opacity": {
	      "value": 0.5,
	      "random": false,
	      "anim": {
	        "enable": false,
	        "speed": 1,
	        "opacity_min": 0.1,
	        "sync": false
	      }
	    },
	    "size": {
	      "value": 3,
	      "random": true,
	      "anim": {
	        "enable": false,
	        "speed": 40,
	        "size_min": 0.1,
	        "sync": false
	      }
	    },
	    "line_linked": {
	      "enable": true,
	      "distance": 150,
	      "color": "#ccc",
	      "opacity": 0.4,
	      "width": 1
	    },
	    "move": {
	      "enable": true,
	      "speed": 6,
	      "direction": "none",
	      "random": false,
	      "straight": false,
	      "out_mode": "out",
	      "bounce": false,
	      "attract": {
	        "enable": false,
	        "rotateX": 600,
	        "rotateY": 1200
	      }
	    }
	  },
	  "interactivity": {
	    "detect_on": "canvas",
	    "events": {
	      "onhover": {
	        "enable": true,
	        "mode": "grab"
	      },
	      "onclick": {
	        "enable": true,
	        "mode": "push"
	      },
	      "resize": true
	    },
	    "modes": {
	      "grab": {
	        "distance": 140,
	        "line_linked": {
	          "opacity": 1
	        }
	      },
	      "bubble": {
	        "distance": 400,
	        "size": 40,
	        "duration": 2,
	        "opacity": 8,
	        "speed": 3
	      },
	      "repulse": {
	        "distance": 200,
	        "duration": 0.4
	      },
	      "push": {
	        "particles_nb": 4
	      },
	      "remove": {
	        "particles_nb": 2
	      }
	    }
	  },
	  "retina_detect": true
	});


	/* ---- stats.js config ---- */

	// var count_particles, stats, update;
	// stats = new Stats;
	// stats.setMode(0);
	// stats.domElement.style.position = 'absolute';
	// stats.domElement.style.left = '0px';
	// stats.domElement.style.top = '0px';
	// document.body.appendChild(stats.domElement);
	// count_particles = document.querySelector('.js-count-particles');
	// update = function() {
	//   stats.begin();
	//   stats.end();
	//   if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
	//     count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
	//   }
	//   requestAnimationFrame(update);
	// };
	// requestAnimationFrame(update);
	
</script>
</body>
</html>