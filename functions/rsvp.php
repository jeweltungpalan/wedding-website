<?php
	INCLUDE "../../db_config.php";

	$successPage="http://" . $_SERVER['HTTP_HOST'] . "/index.php?status=rsvp";
	$errorPage="http://" . $_SERVER['HTTP_HOST'] . "/rsvp/index.php?status=error#rsvp";

	//Trim Fields
	$escapedSong=mysqli_real_escape_string($db,trim($_POST["song"]));
	$escapedArtist=mysqli_real_escape_string($db,trim($_POST["artist"]));
	$escapedMessage=mysqli_real_escape_string($db, trim($_POST["message"]));

	if($_POST["status"] == '' || $_POST["household"] == ''){
		header("Location: " . $errorPage);
	}
	if($_POST["status"] == 'Attending' && count($_POST["guest"]) == 0){
		header("Location: " . $errorPage);
	}

	//Update guests
	if($_POST['status'] == 'Declined'){
		$query="UPDATE Guests SET InvitationRSVP = 'Declined' WHERE HouseholdID = " .$_POST['household'];		
		mysqli_query($db, $query);

		$query="UPDATE Households SET Song = '".$escapedSong."', Artist = '".$escapedArtist."', Message = '".$escapedMessage. "' WHERE HouseholdID = " .$_POST['household'];	
		mysqli_query($db, $query);	
	}
	else{
		//Reset guests
		$query="UPDATE Guests SET InvitationRSVP = '' WHERE HouseholdID = " .$_POST['household'];	
		mysqli_query($db, $query);

		foreach($_POST['guest'] as $guest){
			$query="UPDATE Guests SET InvitationRSVP = '".$_POST['status']."' WHERE GuestID = " .$guest;		
			mysqli_query($db, $query);
		}
		//Update household
		$query="UPDATE Guests SET InvitationRSVP = 'Declined' WHERE HouseholdID = " .$_POST['household']. " AND InvitationRSVP LIKE ''";	
		mysqli_query($db, $query);

		$query="UPDATE Households SET Song = '".$escapedSong."', Artist = '".$escapedArtist."', Message = '".$escapedMessage. "' WHERE HouseholdID = " .$_POST['household'];	
		mysqli_query($db, $query);
	}
	
	//Close db
	mysqli_close($db);

	//Redirect to success page
	header("Location: " . $successPage . $_POST["status"]);
?>