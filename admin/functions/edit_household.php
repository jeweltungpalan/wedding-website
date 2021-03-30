<?php
	INCLUDE "../../../db_config.php";

	$successPage="http://" . $_SERVER['HTTP_HOST'] . "/admin/index.php?status=success&group=household";
	$errorPage="http://" . $_SERVER['HTTP_HOST'] . "/admin/edit_household.php?status=error";

	//Trim Fields
	$formFields = array();
	$guestIDs = array();

	array_walk($_POST, 'sanitizePost');

	//Validate
	if($_POST["hid"] == '' || $_POST["household"] == '' || $_POST["side"] == '' || $_POST["category"] == '' || $_POST["country"]  == ''){
		header("Location: " . $errorPage);
	}	

	//Update household
	$query="UPDATE Households SET Household = '".$_POST['household']."', Side = '".$_POST['side']."', Category = '".$_POST['category']."', Address = '".$_POST['address']. "', City = '".$_POST['city']."', 
	StateProvince = '".$_POST['stateprovince']."', ZipPostalCode = '".$_POST['zippostalcode']."', Country = '".$_POST['country']."', STDRSVP = '".$_POST['stdrsvp']."', PrintedSTDStatus = '".$_POST['printedstdstatus']."', ElectronicSTDStatus = '".$_POST['electronicstdstatus']."', PrintedInvitationStatus = '".$_POST['printedinvitationstatus']."', ElectronicInvitationStatus = '".$_POST['electronicinvitationstatus']."', PrintedThankYouCardStatus = '".$_POST['printedthankyoucardstatus']."', ElectronicThankYouCardStatus = '".$_POST['electronicthankyoucardstatus']."' WHERE HouseholdID = ".$_POST["hid"];		
	$db->query($query);

	//Update guests
	foreach($_POST as $key => $value) {
	    if(strpos($key, 'firstname') === 0) {
	    	$guestID=explode('-',$key)[1];
	    	$title="title-".$guestID;
	    	$firstname="firstname-".$guestID;
	    	$lastname="lastname-".$guestID;
	    	$nickname="nickname-".$guestID;
	    	$role="role-".$guestID;
	    	$emailaddress="emailaddress-".$guestID;
	    	$phone="phone-".$guestID;
	    	$escapedName=mysqli_real_escape_string($db,trim($_POST[$firstname]));

	       	$query="UPDATE Guests SET Title = '".$_POST[$title]."', FirstName = '".$escapedName."', LastName = '".$_POST[$lastname]."', NickName = '".$_POST[$nickname]. "', Role = '".$_POST[$role]."', 
	EmailAddress = '".$_POST[$emailaddress]."', Phone = '".$_POST[$phone]."' WHERE GuestID = ".$guestID;		
			$db->query($query);
	    }
	}

	//Close db
	mysqli_close($db);

	//Redirect to success page
	header("Location: " . $successPage);

	function sanitizePost($key, $value){
		$formFields[$key] = trim(htmlspecialchars($value));
	}
?>