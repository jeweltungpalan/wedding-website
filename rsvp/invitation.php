<?php INCLUDE "../head.php"; ?>
<title>Invitation | Tungpalan - Pajarillo Wedding</title>

<?php
	if($_GET["hid"] != '' && $_GET["utm_medium"] == 'email' && $_GET["utm_campaign"] == 'invitation'){
		$query="UPDATE Households SET InvitationOpened = true WHERE HouseholdID = " . $_GET["hid"];		
		$db->query($query);
	}
?>

<body class="wrapper interior" id="rsvp">
	<div class="header-bg">
		<?php INCLUDE "../header.php"; ?>
		<svg class="divider bottom right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="#088db1" points="0,100 100,0 100,100 0,100" />
		</svg>
	</div>

	<div class="banner-wrapper">
		<div class="banner">
			<div class="content-wrapper xs-12">
				<h1 class="align-center underline">You are Invited</h1>
			</div>
			<svg class="divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
				<polygon fill="#FFFFFF" points="0,0 0,100 100,100 0,0" />
			</svg>
		</div>
	</div>

	<div class="main-content">
		<div class="content-wrapper xs-12 align-center">
			<?php
				if($householdExists){
					$welcome="";
					$welcome.="<h2>" .$household["Household"]. "</h2>";
					if(mysqli_num_rows($guests) > 2){
						$welcome.="<p>";
						$i=1;
						while($guest=$guests->fetch_assoc()){
							$welcome.=$guest["NickName"];
							if($i <> mysqli_num_rows($guests)){
								$welcome.=", ";
							}
							$firstname=$guest["FirstName"];
							$lastname=$guest["LastName"];
							$i++;
						}
					}
					else{
						$guest=$guests->fetch_assoc();
						$firstname=$guest["FirstName"];
						$lastname=$guest["LastName"];
					}

					$welcome.="</p>";
					$welcome.="<p>We would like to formally invite you to our wedding day. Please view the invitation below for more details and <br>don't forget to RSVP! We can't wait to celebrate with you!";
					
					echo $welcome;
				}				
			?>
		</div>
		<svg class="divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="#d4d4d4" points="0,100 100,0 100,100" />
		</svg>
	</div>

	<div class="section-content invitation">
		<div class="content-wrapper xs-12 align-center gallery">
			<a href="../videos/invitation.mp4" title="You are Invited" class="mfp-iframe">
				<img src="../images/invitation.png" alt="You are Invited">
			</a>
			<div class="section-content group sm-6 center-row thumbnails">
				<a href="../images/invitation-main.jpg" title="Juris & Jewel Closing the Distance" class="col">
					<img src="../images/invitation-main-thumbnail.jpg" alt="Juris & Jewel Closing the Distance">
				</a>
				<a href="../images/invitation-entourage.jpg" title="Wedding Entourage" class="col">
					<img src="../images/invitation-entourage-thumbnail.jpg" alt="Wedding Entourage">
				</a>
				<a href="../images/invitation-details.jpg" title="Wedding Details" class="col">
					<img src="../images/invitation-details-thumbnail.jpg" alt="Wedding Details">
				</a>
				<a href="../images/invitation-map.jpg" title="Wedding Map" class="col">
					<img src="../images/invitation-map-thumbnail.jpg" alt="Wedding Map">
				</a>
				<a href="../images/invitation-rsvp.jpg" title="Wedding RSVP" class="col">
					<img src="../images/invitation-rsvp-thumbnail.jpg" alt="Wedding RSVP">
				</a>
			</div>
		</div>
	</div>

	<div class="main-content">
		<svg class="divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="#d4d4d4" points="0,0 100,0 100,100" />
		</svg>
		<div class="content-wrapper xs-12 align-center">
			<div class="section-content">
				<?php
					$button="";
					$button.="<a href='index.php?firstname=" .$firstname. "&lastname=" .$lastname. "' class='button-cta button light'><span class='button light'><span class='text'><i class='fas fa-fire'></i>RSVP here<i class='far fa-gem'></i></span></span></a>";
					echo $button
				?>
			</div>
		</div>
	</div>

	<?php INCLUDE "../interior-footer-cta.php"; ?>
	<?php INCLUDE "../footer.php"; ?>

	<script src="../js/magnificpopup.js"></script>
	<script>
		$(document).ready(function() {
			$('.gallery').magnificPopup({
				delegate: 'a',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title') + '<small>Tungpalan - Pajarillo Wedding</small>';
					}
				}
			});
		});
	</script>
</body>
</html>