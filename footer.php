<footer>
	<div class="content-wrapper group">
		<div class="xs-12 section-content">
			<a href="#top" class="button-circle uppercase align-middle"><span><i class="fas fa-chevron-up fa-2x"></i></span> Back<br> to top</a>
		</div>
		<div class="col xs-12 md-4 align-center">
			<img src="/images/footer-logo.png" alt>
			<div class="section-content align-left">
				<div class="item">
					<div class="icon-left">
						<i class="fas fa-church pull-left"></i>
					</div>
					<address class="detail">
						<strong class="name">Our Lady of Lourdes Parish</strong><br>
						<span class="street-address">Km. 56, Gen Aguinaldo Hwy, Silang Crossing W</span><br>
						<span class="locality">Tagaytay</span>, <span class="region">Cavite</span>, <span class="postal-code">4120</span>, <span class"country-name">Philippines</span>
					</address>
				</div>
				<div class="item">
					<div class="icon-left">
						<i class="fas fa-utensils"></i> <i class="fas fa-wine-glass"></i>
					</div>
					<address class="detail">
						<strong class="name">Clear Water House</strong><br>
						<span class="street-address">Km. 58, Gen Aguinaldo Hwy, Maharlika E</span><br>
						<span class="locality">Tagaytay</span>, <span class="region">Cavite</span>, <span class="postal-code">4120</span>, <span class"country-name">Philippines</span>
					</address>
				</div>
				<div class="item">
					<div class="icon-left">
						<i class="fas fa-camera fa-fw"></i> 
					</div>
					<div class="detail">
						<span class="name">Help us capture our special day!</span><br>
						#JurisJewelClosingTheDistance
					</div>
				</div>
			</div>
		</div>
		<div class="col xs-12 md-8" id="contact">
			<?php
				if($_GET['status'] != '' && $_GET['status'] == 'error'){
					echo "<p class='notification " . $_GET['status'] . "'>Your message was not sent. Please fill out all fields and try again.</p>";
				}
			?>
			<form name="contact" action="/functions/contact.php" method="post" class="contact">
				<p class="header">Drop Us a Message!</p>
				<div class="inner-row">
					<div class="col xs-12 md-6">
						<input type="text" name="name" class="field req" placeholder="Name">
					</div>
					<div class="col xs-12 md-6">
						<span class="feedback"></span>
						<input type="email" name="email" class="field req email" placeholder="Email">
					</div>
				</div>
				<div>
					<textarea name="message" class="field req" placeholder="Message"></textarea>
				</div>
				<div class="align-right">
					<?php $request=preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);?>
					<input type="hidden" name="page" value="<?php echo $request; ?>">
					<button type="submit" name="send" class="button light form-submit">Send <i class="fas fa-chevron-right" data-fa-transform="shrink-4"></i></button>
				</div>
			</form>
		</div>
	</div>

	<svg class="divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon fill="#0d0d0d" points="100,0 0,100 100,100 100,0" />
	</svg>
	<div class="copyright">
		<div class="content-wrapper xs-12 align-center">
			<p>Tungpalan - Pajarillo Wedding &copy; 2018 <br> Designed by Juris Tungpalan and Coded by Jewel Pajarillo</p>
		</div>
	</div>
</footer>

<?php
	if($_GET['status'] != ''){
		$notification="";
		$notification.="<div class='overlay'></div>";
		$notification.="<div class='popup-wrapper popup-close'>";
		$notification.="<div class='popup-window align-center'>";
		$notification.="<div class='popup'>";

		if($_GET['status'] == 'success'){
			$notification.="<h2 class='bondi-blue uppercase'>Thank You</h2>";
			$notification.="<p>Your message was sent. We will get back to you as soon as we can.</p>";
		}
		else if($_GET['status'] == 'rsvpAttending'){
			$notification.="<h2 class='bondi-blue uppercase'>See You There</h2>";
			$notification.="<p>Thank you for your RSVP. We look forward to celebrating with you on our big day!</p>";
		}
		else if($_GET['status'] == 'rsvpDeclined'){
			$notification.="<h2 class='bondi-blue uppercase'>Thank you for your RSVP</h2>";
			$notification.="<p>We totally understand. We will miss you though! :(</p>";
		}

		$notification.="<div class='buttons-wrapper'>";
		$notification.="<a href='faq.php' class='button light'><span class='text'>Check Q & A <i class='fas fa-chevron-right' data-fa-transform='shrink-4'></i></span></a> <a href='registry.php' class='button light'><span class='text'>Registry <i class='fas fa-chevron-right' data-fa-transform='shrink-4'></i></span></a>";
		$notification.="</div>";
		$notification.="<a href='javascript:void(0)' class='uppercase popup-close'><span>Close</span> <i class='far fa-times-circle'></i></a>";
		$notification.="</div>";
		$notification.="</div>";
		$notification.="</div>";

		echo $notification;
	}
?>

<link href="https://fonts.googleapis.com/css?family=Raleway:500,600" rel="stylesheet">
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="/js/common.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-121665506-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-121665506-1');
</script>
