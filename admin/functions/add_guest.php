<?php
	INCLUDE "../../../db_config.php";

	$errorPage="http://" . $_SERVER['HTTP_HOST'] . "/admin/edit_guest.php?status=error";

	//Trim Fields
	$formFields = array();
	array_walk($_POST, 'sanitizePost');
	$escapedName=mysqli_real_escape_string($db,trim($_POST["firstname"]));

	//Validate
	if($_POST["group"] == '' || $_POST["firstname"] == '' || $_POST["lastname"] == '' || $_POST["role"]  == ''){
		header("Location: " . $errorPage);
	}

	//Insert
	if($_POST["group"] == 'individual'){
		$query="INSERT INTO Guests (HouseholdID,Title,FirstName,LastName,Role,EmailAddress,Phone) VALUES (" .$_POST["household"]. ",'" .$_POST["title"]. "','" .$escapedName. "','" .$_POST["lastname"]."','" .$_POST["role"]."','" .$_POST["emailaddress"]."','" .$_POST["phone"]."')";	
	}
		
	$db->query($query);

	//Close db
	mysqli_close($db);

	//Redirect to success page
	$successPage="http://" . $_SERVER['HTTP_HOST'] . "/admin/index.php?status=success&group=" . $_POST["group"];
	header("Location: " . $successPage);

	function sanitizePost($key, $value){
		$formFields[$key] = trim(htmlspecialchars($value));
	}
?>