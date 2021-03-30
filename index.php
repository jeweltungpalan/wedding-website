<?php INCLUDE "head.php"; ?>
<title>Tungpalan - Pajarillo Wedding</title>

<?php
	INCLUDE "../db_config.php";

	if($_GET["hid"] != '' && $_GET["utm_medium"] == 'email' && $_GET["utm_campaign"] == 'save_the_date'){
		$query="UPDATE Households SET WebsiteOpened = true WHERE HouseholdID = " . $_GET["hid"];		
		$db->query($query);
	}

	mysqli_close($db);
?>

<body class="wrapper home">
	<?php INCLUDE "header.php"; ?>

	<div class="banner">
		<div class="smoothslides" id="banner">
			<picture>
				<source media="(max-width: 768px)" srcset="images/banner1-xs.jpg">
				<source media="(min-width: 768px)" srcset="images/banner1-md.jpg">
			  	<img src="images/banner1-md.jpg" data-effect="zoomIn">
			</picture>
			<picture>
				<source media="(max-width: 768px)" srcset="images/banner2-xs.jpg">
				<source media="(min-width: 768px)" srcset="images/banner2-md.jpg">
			  	<img src="images/banner2-md.jpg" data-effect="panRight">
			</picture>
			<picture>
				<source media="(max-width: 768px)" srcset="images/banner3-xs.jpg">
				<source media="(min-width: 768px)" srcset="images/banner3-md.jpg">
			  	<img src="images/banner3-md.jpg" data-effect="zoomOut">
			</picture>
			<picture>
				<source media="(max-width: 768px)" srcset="images/banner4-xs.jpg">
				<source media="(min-width: 768px)" srcset="images/banner4-md.jpg">
			  	<img src="images/banner4-md.jpg" data-effect="panUp">
			</picture>
		</div>
		<div class="title xs-12">
			<img src="images/title.png" alt="Juris & Jewel Wedding | 12.22.2018" id="title" width="278"><br>
			<img src="images/closing-the-distance.png" alt="Closing The Distance" id="closing-the-distance"><br>
			<!---<a href="https://calendar.google.com/calendar/ical/jurisjeweltungpalan%40gmail.com/private-18ac5ec8b33c1405dc8e23821eb398a3/basic.ics" class="button-cta button light"><span class="button light"><span class="text"><i class="fas fa-fire"></i>Save Our Date<i class="far fa-gem"></i></span></span></a>--->
			<!---<a href="http://www.jurisjewelclosingthedistance.com/rsvp/" class="button-cta button light"><span class="button light"><span class="text"><i class="fas fa-fire"></i>RSVP Here<i class="far fa-gem"></i></span></span></a>--->
			<a href="http://www.jurisjewelclosingthedistance.com/wedding/" class="button-cta button light"><span class="button light"><span class="text"><i class="fas fa-fire"></i>View Wedding<i class="far fa-gem"></i></span></span></a>
		</div>
	</div>

	<section class="about-wrapper">
		<span class="button-scroll align-center"><a href="#about"><img src="images/button-scroll.png" alt="Scroll down"></a></span>

		<div class="about">
			<div class="content-wrapper group align-center" id="about">
				<div class="welcome xs-12 scroll-animation ascend">
					<h1 class="underline">Welcome Family and Friends</h1>
					<p class="sm-8 md-6 lg-4 center-row">We are happy to announce that after <span class="tiffany-blue">11 years</span> together and <span class="tiffany-blue">6 years</span> of long-distance relationship, we are finally closing the distance as we get married on <span class="date">12 <span class="diamond">&#9671;</span> 22 <span class="diamond">&#9671;</span> 2018</span></p>
					<hr>
				</div>	
				<div class="col xs-12 sm-6 scroll-animation ascend" id="groom">
					<img src="images/groom.png" alt="The Groom">
					<h2 class="underline">The Groom</h2>
					<p>Juris is the master of all things art. He is an epic graphic/web designer, <a href="https://www.facebook.com/withfingerscrossed/" target="_blank">WFC guitarist</a> and aspiring Power Ranger who lives in Manila, Philippines. Very intuitive and spontaneous guy, his decisions usually depend on what he feels − whether getting pulled in last minute barkada trips or staying in and binge-watching his favorite Anime shows.  Overall, he is the most loyal, kind and romantic, pizza and Gundam fanatic that you will meet.</p>
					<p>- Jewel</p>
					<ul class="no-bullet social-media">
						<li><a href="https://www.facebook.com/juristungpalan" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="https://www.instagram.com/pyrothethirteenth/" target="_blank"><i class="fab fa-instagram"></i></a></li>
						<li><a href="https://juristungpalan.carbonmade.com/" target="_blank"><i class="fas fa-globe"></i></a></li>
					</ul>	
				</div>
				<div class="col xs-12 sm-6 scroll-animation ascend" id="bride">
					<img src="images/bride.png" alt="The Bride">
					<h2 class="underline">The Bride</h2>
					<p>Jewel is a hardcore programmer based in Houston, Texas who often finds herself on flights to Manila and around the world. Despite her busy schedule, she maintains a bubbly aura that makes her very lovable. She also sustains her weekly cravings on ramen and milk tea. A total opposite of right-brained humans, she is very analytical.  Her energy dominating as a strong independent leader indicates that she is definitely a 100% Leo.</p>
					<p>- Juris</p>	
					<ul class="no-bullet social-media">
						<li><a href="https://www.facebook.com/jewel.pajarillo" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="https://www.instagram.com/hellojewel/" target="_blank"><i class="fab fa-instagram"></i></a></li>
						<li><a href="https://jewelpajarillo.com/" target="_blank"><i class="fas fa-globe"></i></a></li>
					</ul>
				</div>
			</div>
			<svg class="divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" style="border-bottom: 1px solid white;">
				<polygon fill="#fff" points="0,0 0,100 100,100 0,0" />
			</svg>
		</div>
	</section>

	<section class="event">
		<div class="content-wrapper group">
			<div class="center-row lg-10">
				<h1 class="align-center underline">Event Details</h1>

				<div class="xs-12">
					<p class="align-center">We are married for...</p>
					<div id="countdown" data-date="2018-12-22 01:00:00"></div>
				</div>

				<div class="details group scroll-animation ascend">
					<div class="col xs-12 sm-3 ceremony align-middle">
						<div class="md-12">
							<h2><i class="fas fa-church"></i><br>Ceremony</h2>
							<ul class="no-bullet">
								<li class="item"><i class="fas fa-map-marker-alt fa-fw"></i> Our Lady of Lourdes Parish, Tagaytay</li>
								<li class="item"><i class="far fa-clock fa-fw"></i> 2:30 PM</li> 
							</ul>
						</div>
					</div>
					<div class="col xs-12 sm-6 map">
						<iframe src="https://www.google.com/maps/d/embed?mid=1sfxQZ2zQO2aexQ7ka2leenrmQFwJaksO&z=14&ll=14.106305,120.954279" width="100%" height="376" frameBorder="0" style="border:0; margin-top: -46px;"></iframe>
					</div>
					<div class="col xs-12 sm-3 reception align-middle align-right">
						<div class="md-12">
							<h2><i class="fas fa-utensils"></i> <i class="fas fa-wine-glass"></i><br>Reception</h2>
							<ul class="no-bullet">
								<li class="item"><i class="fas fa-map-marker-alt fa-fw"></i> Clear Water House, Tagaytay</li>
								<li class="item"><i class="far fa-clock fa-fw"></i> 5 PM</li> 
							</ul>
						</div>
					</div>
				</div>

				<div class="section-content align-center">
					<a href="event.php" class="button dark">View Full Schedule <i class="fas fa-chevron-right" data-fa-transform="shrink-4"></i></a>	
				</div>	
			</div>
		</div>
	</section>

	<section class="story">
		<svg class="divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="#fff" points="0,0 100,0 0,100 0,0" />
		</svg>
		<div class="story-bg"></div>
		<div class="content-wrapper group">
			<div class="xs-12 sm-10 center-row">
				<h1 class="underline align-center">Our Story</h1>

				<p class="align-center">Our story started way back when we were still in Kindergarten. Yes, we were so young!<br> Read more details below about our journey from kinder to forever!</p>

				<ul class="timeline group no-bullet">
					<li class="row left group">
						<span class="point"><i class="fas fa-heart"></i></span>
						<div class="col milestone scroll-animation ascend">
							<time class="date">June 1997</time>
							<img src="images/story-1.jpg">
							<h2>Kinder Classmates</h2>
							<p>We met as classmates at the University of the Philippines Integrated School. He told everybody that he had a crush on her. She felt super awkward.</p>
						</div>
					</li>
					<li class="row right group">
						<span class="point"><i class="fas fa-heart"></i></span>
						<div class="col milestone pull-right scroll-animation ascend">
							<time class="date">March <span class="day">21</span> 2005</time>
							<img src="images/story-friends.jpg">
							<h2>Made the Move</h2>
							<p>Years passed as he tried to make her notice him. Luckily, thanks to the invention of cellphones, what started as one text message ended up as late night calls.</p>
						</div>
					</li>
					<li class="row left group">
						<span class="point"><i class="fas fa-heart"></i></span>
						<div class="col milestone scroll-animation ascend">
							<time class="date">February <span class="day">24</span> 2007</time>
							<img src="images/story-prom.jpg">
							<h2>Friends to Prom Dates</h2>
							<p>We became really good friends and automatically turned each other as Prom Dates. There were no Promposals back then, life was easy!</p>
						</div>
					</li>
					<li class="row right group">
						<span class="point"><i class="fas fa-heart"></i></span>
						<div class="col milestone pull-right scroll-animation ascend">
							<time class="date">March <span class="day">21</span> 2007</time>
							<img src="images/story-dating.jpg">
							<h2>Officially Dating</h2>
							<p>Two years of friendship plus let's be honest some flirty texts with 6 months of courtship later, we made it official! It was a sweet "yes".</p>
						</div>
					</li>
					<li class="row left group">
						<span class="point"><i class="fas fa-heart"></i></span>
						<div class="col milestone scroll-animation ascend">
							<time class="date">April <span class="day">22</span> 2012</time>
							<img src="images/story-graduation.jpg">
							<h2>Finished College Together</h2>
							<p>We went in University of the Philippines. He picked Art while she went into Engineering. We had completely opposite degrees but we helped each other out.</p>
						</div>
					</li>
					<li class="row right group">
						<span class="point"><i class="fas fa-heart"></i></span>
						<div class="col milestone pull-right scroll-animation ascend">
							<time class="date">May <span class="day">10</span> 2012</time>
								<img src="images/story-ldr.jpg">
							<h2>13,000 KMs Apart</h2>
							<p>Shortly after graduation, she moved to Houston, TX.  We decided to stay together. Daily Viber and weekly Skype calls kept our long distance relationship strong.</p>
						</div>
					</li>
					<li class="row left group">
						<span class="point"><i class="fas fa-heart"></i></span>
						<div class="col milestone scroll-animation ascend">
							<time class="date">January <span class="day">3</span> 2015</time>
							<img src="images/story-beach.jpg">
							<h2>Yearly Beach Outings</h2>
							<p>We lived in two different worlds but we made sure to shorten the distance and see each other once a year.  We would always reconnect in our happy place.</p>
						</div>
					</li>
					<li class="row right group">
						<span class="point"><i class="fas fa-heart"></i></span>
						<div class="col milestone pull-right scroll-animation ascend">
							<time class="date">March <span class="day">25</span> 2016</time>
							<img src="images/story-international-trip.jpg">
							<h2>First International Trip</h2>
							<p>Three weeks was the only time we had every visit so we try to make every second extra special. Our first out-of-the-country trip in Tokyo, Japan was one for the books.</p>
						</div>
					</li>
					<li class="row left group">
						<span class="point"><i class="fas fa-heart"></i></span>
						<div class="col milestone scroll-animation ascend">
							<time class="date">March <span class="day">21</span> 2017</time>
							<img src="images/story-decade.jpg">
							<h2>One Decade Milestone</h2>
							<p>After 10 years of partnership, 5 of which in long distance, he marked it with a proposal during sunset in front of our friends. Now, we're on our way to forever. <i class="far fa-heart fa-sm"></i></p>
						</div>
					</li>
					<li>
						<span class="point"><i class="fas fa-heart"></i></span>
					</li>
					<li class="proposal scroll-animation ascend">
						<figure>
							<img src="images/proposal.jpg" alt="Juris and Jewel Proposal Video">
						</figure>
						<a href="https://youtu.be/YNYzHOOQuRo" class="button light" target="_blank" id="button-proposal">Watch the Proposal <i class="fas fa-chevron-right" data-fa-transform="shrink-4"></i></a>	
					</li>
				</ul>
			</div>
		</div>
		<svg class="divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="#042f4a" points="0,0 0,100 100,100 0,0" />
		</svg>
	</section>
	
	<section class="travel align-center">
		<div class="content-wrapper">
			<h1 class="underline">Travel</h1>

			<p class="xs-12 sm-10 lg-12 center-row">We want to make everything convenient and easy as much as possible so we already did the homework for you. <br class="xs-hide lg-show">Check out the things you can do in Tagaytay below!</p>

			<div class="group section-content">
				<a href="travel/stay.php" class="box col xs-12 sm-4 block">
					<figure>
						<img src="images/travel-stay.jpg" alt="Stay in Tagaytay">
					</figure>
					<h2>Stay</h2>
					<p>Search where you can recharge after the party.</p>
					<span class="button-circle"><i class="fas fa-chevron-right"></i></span>
				</a>	
				<a href="travel/eat.php" class="box col xs-12 sm-4 block">
					<figure>
						<img src="images/travel-eat.jpg" alt="Eat in Tagaytay">
					</figure>
					<h2>Eat</h2>
					<p>Try out recommended places to get grub.</p>
					<span class="button-circle"><i class="fas fa-chevron-right"></i></span>
				</a>			
				<a href="travel/explore.php" class="box col xs-12 sm-4 block">
					<figure>
						<img src="images/travel-explore.jpg" alt="Explore Tagaytay">
					</figure>
					<h2>Explore</h2>
					<p>Discover what's on the ridge the next day.</p>
					<span class="button-circle"><i class="fas fa-chevron-right"></i></span>
				</a>
			</div>

			<div class="section-content align-center">
				<a href="faq.php" class="button light">More questions? <i class="fas fa-chevron-right" data-fa-transform="shrink-4"></i></a>	
			</div>				
		</div>
	</section>

	<section class="footer-cta">
		<svg class="divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="#042f4a" points="0,0 100,0 0,100 0,0" />
		</svg>
		<svg class="divider bottom left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="#0d0d0d" points="0,0 0,100 100,100 0,0" />
		</svg>
	</section>

	<?php INCLUDE "footer.php"; ?>
	<script src="js/smoothslides-2.2.1.min.js"></script>
	<script src="js/timecircles.min.js"></script>
	<script>
		$(window).load(function(){
			$('#banner').smoothSlides({
				effectDuration: 10000,
				transitionDuration: 1000,
				navigation: false,
				effectModifier: 1.05,
				matchImageSize: false
			});
		});

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