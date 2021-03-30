<?php INCLUDE "../head.php"; ?>
<title>RSVP | Tungpalan - Pajarillo Wedding</title>

<?php
	INCLUDE "../../db_config.php";

	$showRSVPForm=false;

	if(trim($_GET['firstname']) != '' && trim($_GET['lastname']) != ''){
		$firstname=trim($_GET['firstname']);
		$lastname=trim($_GET['lastname']);

		$query="SELECT Household, HouseholdID, Song, Artist, Message FROM Households WHERE HouseholdID in (SELECT HouseholdID from Guests WHERE FirstName LIKE '%".$firstname."%' AND LastName LIKE '%".$lastname. "%')";
		$households=$db->query($query);
		$household=$households->fetch_assoc();

		if(mysqli_num_rows($households)==0){
			$guestExists=false;
		}
		else{
			$query="SELECT InvitationRSVP FROM Households h INNER JOIN Guests g ON h.HouseholdID=g.HouseholdID WHERE h.HouseholdID in(SELECT HouseholdID from Guests WHERE FirstName LIKE '%".$firstname."%' AND LastName LIKE '%".$lastname. "%') ORDER BY InvitationRSVP LIMIT 1";
			$isRsvpDone=$db->query($query);
			$invitationRsvp=$isRsvpDone->fetch_assoc();
			if($invitationRsvp["InvitationRSVP"] != ''){
				$rsvpStatus=$invitationRsvp["InvitationRSVP"];
			}
			else{
				$rsvpStatus="Pending";
			}

			$query="SELECT Household, GuestID, FirstName, LastName, NickName, PrintedInvitationStatus, InvitationRSVP FROM Households h INNER JOIN Guests g ON h.HouseholdID=g.HouseholdID WHERE h.HouseholdID in(SELECT HouseholdID from Guests WHERE FirstName LIKE '%".$firstname."%' AND LastName LIKE '%".$lastname. "%')";
			$guests=$db->query($query);
			$guestExists=true;
			$showRSVPForm=true;
		}
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
				<h1 class="align-center underline">RSVP</h1>
			</div>
			<svg class="divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
				<polygon fill="#FFFFFF" points="0,0 0,100 100,100 0,0" />
			</svg>
		</div>
	</div>

	<div class="main-content content-wrapper xs-12 align-center">
		<?php
			if($showRSVPForm){
				$welcome="";
				$welcome.="<h2>" .$household["Household"]. "</h2>";
				$welcome.="<p>We have reserved " .mysqli_num_rows($guests). " seat(s) for you.</p>";

				echo $welcome;
			}
			else{
				echo "<p>To RSVP, please enter your first name and last name below. <br>If you come in a group, please enter at least one person in the party to continue.</p>";
			}
		?>
		
		<div class="section-content">
			<div class="diamond-divider"><span class="diamond"><i class="far fa-gem fa-4x"></i></span></div>
		</div>
		
		<?php
			$form="";

			if($showRSVPForm){
				if($rsvpStatus != 'Pending'){
					$form.="<p class='bondi-blue'>Thank you for your RSVP.</p>";
				}
				$form.="<form name='rsvp' action='../functions/rsvp.php' method='post' class='sm-12 md-8 center-row rsvp align-left' id='rsvp'>";
				$form.="<fieldset class='inner-row group option-parent'>";
				$form.="<p class='feedback xs-12' style='float:none'></p>";
				$form.="<div class='col'>";
				if($rsvpStatus == 'Attending'){
					$form.="<input type='radio' name='status' id='status-1' class='option button-toggle' value='Attending' data-filter-value='.guests' checked>";
				}
				else{
					$form.="<input type='radio' name='status' id='status-1' class='option button-toggle' value='Attending' data-filter-value='.guests'>";
				}				
				$form.="<label class='radio-label' for='status-1'>Wouldn't miss it for the world</label>";
				$form.="</div>";
				$form.="<div class='col'>";
				if($rsvpStatus == 'Declined'){
					$form.="<input type='radio' name='status' id='status-2' class='option button-toggle' value='Declined' data-filter-value='.decline' checked>";
				}
				else{
					$form.="<input type='radio' name='status' id='status-2' class='option button-toggle' value='Declined' data-filter-value='.decline'>";
				}
				$form.="<label class='radio-label' for='status-2'>Will celebrate from afar</label>";
				$form.="</div>";
				$form.="</fieldset>";
				if($rsvpStatus == 'Attending'){
					$form.="<fieldset class='group toggle-visibility guests hidden'>";
				}
				else{
					$form.="<fieldset class='group toggle-visibility guests hidden xs-hide'>";
				}				
				$form.="<legend>Please check those who are attending.</legend> <span class='feedback' style='float:none'></span>";
				while($guest=$guests->fetch_assoc()){
					$form.="<div>";
					if(mysqli_num_rows($guests) == 1 || $guest["InvitationRSVP"] == 'Attending'){
						$form.="<input type='checkbox' name='guest[]' id='guest-" .$guest["GuestID"]. "' class='option' value='" .$guest["GuestID"] ."' checked>";
					}
					else{
						$form.="<input type='checkbox' name='guest[]' id='guest-" .$guest["GuestID"]. "' class='option' value='" .$guest["GuestID"] ."'>";
					}					
					$form.="<label class='radio-label' for='guest-" .$guest["GuestID"]. "'>" .$guest["FirstName"]. " " .$guest["LastName"]. "</label>";
					$form.="</div>";
				}
				$form.="</fieldset>";
				$form.="<div class='group inner-row'>";
				$form.="<span class='xs-12'>I promise to get up and dance if you play</span>";
				$form.="<div class='col xs-12 md-7'>";
				$form.="<input type='text' name='song' class='field songquestion' placeholder='Song Title' maxlength='75' value='" .$household["Song"]. "'>";
				$form.="</div>";
				$form.="<div class='col xs-12 md-1' id='songby'>by</div>";
				$form.="<div class='col xs-12 md-4'>";
				$form.="<input type='text' name='artist' class='field songquestion' placeholder='Song Artist' maxlength='50' value='" .$household["Artist"]. "'>";
				$form.="</div>";
				$form.="</div>";
				$form.="<div>";
				$form.="<span>Just for fun, what do you look forward the most on our wedding?</span>";
				$form.="<textarea name='message' class='field' placeholder='Additional Comments' maxlength='500'>" .$household["Message"]. "</textarea>";
				$form.="</div>";
				$form.="<div class='section-content align-center'>";
				$form.="<button type='submit' name='send' class='button dark form-submit'>Submit <i class='fas fa-chevron-right' data-fa-transform='shrink-4'></i></button>";
				$form.="<p><a href='invitation.php?hid=" . $household["HouseholdID"] . "&name=" . $_GET["lastname"] . "' class='bondi-blue' style='text-decoration:underline;font-size:12px'>View Invitation</a></p>";
				$form.="<input type='hidden' name='household' value='" .$household["HouseholdID"]. "'>";
				$form.="</div>";
				$form.="</form>";
			}
			else{
				if(!$guestExists){
					if($_GET["lastname"] != ""){
						echo "<p class='notification " . $_GET['status'] . "'>We cannot find your invitation. Please try again.</p>";
					}	
					$form.="<form name='rsvp' action='index.php' method='get' class='xs-12 md-8 center-row rsvp' id='rsvp'>";
					$form.="<input type='text' name='firstname' class='field req' placeholder='First Name'>";
					$form.="<input type='text' name='lastname' class='field req' placeholder='Last Name'>";
					$form.="<div class='section-content align-center'>";
					$form.="<button type='submit' name='send' class='button dark form-submit'>Find My Invitation <i class='fas fa-chevron-right' data-fa-transform='shrink-4'></i></button>";
					$form.="</div>";
					$form.="</form>";
				}
				
			}	

			echo $form;
		?>
		
	</div>

	<?php INCLUDE "../interior-footer-cta.php"; ?>
	<?php INCLUDE "../footer.php"; ?>
	<script>
		$('#status-1').click(function(e){
			$('.guests').addClass('option-parent');
		});
		$('#status-2').click(function(e){
			$('.guests').removeClass('option-parent');
		});
	</script>
</body>
</html>