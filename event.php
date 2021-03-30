<?php INCLUDE "head.php"; ?>
<title>Event Details | Tungpalan - Pajarillo Wedding</title>

<body class="wrapper interior" id="event">
	<div class="header-bg">
		<?php INCLUDE "header.php"; ?>
		<svg class="divider bottom right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="#088db1" points="0,100 100,0 100,100 0,100" />
		</svg>
	</div>

	<div class="banner-wrapper">
		<div class="banner">
			<div class="content-wrapper xs-12">
				<h1 class="align-center underline">Event Details</h1>
			</div>
			<svg class="divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
				<polygon fill="#FFFFFF" points="0,0 0,100 100,100 0,0" />
			</svg>
		</div>
	</div>

	<div class="main-content content-wrapper xs-12 md-10">
		<h2 class="align-center underline"><img src="images/ring.jpg" alt><br><span class="prussian-blue">Our Wedding</span><span class="bondi-blue">December 22, 2018</span></h2>
		<div id="countdown" data-date="2018-12-21 00:1:00"></div>		
	</div>

	<div class="main-content ceremony">
		<svg class="divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="#FFFFFF" points="0,0 100,0 0,100 0,0" />
		</svg>
		<div class="content-wrapper align-center group">
			<div class="col xs-12 sm-6 lg-3 scroll-animation ascend">
				<p class="icon tiffany-blue"><i class="fas fa-user-clock"></i></p>
				<h3>2:30 PM <br><span class="tiffany-blue">Entourage Line Up</span></h3>
				<p>Wear your best outfit and welcome the start of our happily ever after at <strong>Our Lady of Lourdes Parish</strong>.</p>
			</div>
			<div class="col xs-12 sm-6 lg-3 scroll-animation ascend">
				<p class="icon tiffany-blue"><i class="fas fa-church"></i></p>
				<h3>3:00 PM <br><span class="tiffany-blue">Ceremony</span></h3>
				<p>Join us as we exchange vows of marriage and witness the start of two hearts closing the distance.</p>
			</div>
			<div class="col xs-12 sm-6 lg-3 scroll-animation ascend">
				<p class="icon tiffany-blue"><i class="fas fa-camera"></i></p>
				<h3>4:00 PM <br><span class="tiffany-blue">Photos</span></h3>
				<p>Capture the memories as we will be announced as Mr. and Mrs.<br>#JurisJewelClosingTheDistance<p>
			</div>
			<div class="col xs-12 sm-6 lg-3 scroll-animation ascend">
				<p class="icon tiffany-blue"><i class="fas fa-car"></i></p>
				<h3>4:30 PM <br><span class="tiffany-blue">To Reception</span></h3>
				<p>Head over to <strong>Clear Water House</strong> for the reception dinner after we walk down the aisle.</p>
			</div>
		</div>
	</div>

	<div class="main-content reception">
		<svg class="divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="#30a5b5" points="0,0 100,0 100,100 0,0" />
		</svg>
		<div class="content-wrapper align-center group">
			<div class="col xs-12 sm-6 lg-3 scroll-animation ascend">
				<p class="icon aqua-teal"><i class="fas fa-glass-martini"></i></p>
				<h3>5:00 PM <br><span class="aqua-teal">Cocktail Hour</span></h3>
				<p>Enjoy the view, have some appetizers and get your photos taken at the photo booth.</p>
			</div>
			<div class="col xs-12 sm-6 lg-3 scroll-animation ascend">
				<p class="icon aqua-teal"><i class="fas fa-utensils"></i> <i class="fas fa-wine-glass"></i></p>
				<h3>6:00 PM <br><span class="aqua-teal">Dinner Reception</span></h3>
				<p>Savor the warm meal and fancy a drink by the lake while being soothed with some live music.</p>
			</div>
			<div class="col xs-12 sm-6 lg-3 scroll-animation ascend">
				<p class="icon aqua-teal"><i class="fas fa-birthday-cake"></i></p>
				<h3>7:30 PM <br><span class="aqua-teal">Cake & Toasts</span></h3>
				<p>Say "cheers!", maybe tear up a little and take part in games as we continue the fun and celebration.</p>
			</div>
			<div class="col xs-12 sm-6 lg-3 scroll-animation ascend">
				<p class="icon aqua-teal"><i class="fas fa-music"></i> <i class="fas fa-moon"></i></p>
				<h3>8:30 PM <br><span class="aqua-teal">Party!</span></h3>
				<p>Get some more booze, let your hair down, hit the dance floor and dance the night away with us!</p>
			</div>
		</div>
	</div>
	
	<div class="map">
		<svg class="divider top left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="#7ed6d3" points="0,0 0,100 100,0 0,0" />
		</svg>
		<iframe src="https://www.google.com/maps/d/embed?mid=1sfxQZ2zQO2aexQ7ka2leenrmQFwJaksO&z=14&ll=14.106305,120.954279" width="100%" height="446" frameBorder="0" style="border:0; margin-top: -46px;"></iframe>
		<svg class="divider bottom left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="#FFFFFF" points="0,0 0,100 100,100 0,0" />
		</svg>
	</div>

	<div class="main-content content-wrapper">
		<div class="section-content align-center">
			<a href="../faq.php" class="button dark">More questions? <i class="fas fa-chevron-right" data-fa-transform="shrink-4"></i></a>	
		</div>
	</div>

	<?php INCLUDE "interior-footer-cta.php"; ?>
	<?php INCLUDE "footer.php"; ?>
	<script src="js/timecircles.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#countdown").TimeCircles({
				fg_width: 0.02,
				bg_width: 0.1,
				circle_bg_color: "#30a5b5",
				time:{
					Days:{
						color: "#30a5b5"
					},
					Hours:{
						color: "#30a5b5"
					},
					Minutes:{
						color: "#30a5b5"
					},
					Seconds:{
						color: "#30a5b5"
					}
				}
			});
		});

		$(window).resize(function(){
		    $("#countdown").TimeCircles().rebuild();
		});
	</script>
</body>
</html>