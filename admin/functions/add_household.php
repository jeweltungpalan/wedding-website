<?php
	INCLUDE "../../../db_config.php";

	$errorPage="http://" . $_SERVER['HTTP_HOST'] . "/admin/add_household.php?status=error";

	//Trim Fields
	$formFields = array();
	array_walk($_POST, 'sanitizePost');

	//Validate
	if($_POST["household"] == '' || $_POST["side"] == '' || $_POST["category"] == '' || $_POST["country"]  == ''){
		header("Location: " . $errorPage);
	}	

	//Insert
	$query="INSERT INTO Households (Household, Side, Category, PrintedSTDStatus, ElectronicSTDStatus, PrintedInvitationStatus, ElectronicInvitationStatus, Address, City, StateProvince, ZipPostalCode, Country, STDRSVP) VALUES ('" .$_POST["household"]. "','" .$_POST["side"]. "','" .$_POST["category"]. "','" .$_POST["printedstdstatus"]. "','" .$_POST["electronicstdstatus"]."','" .$_POST["printedinvitationstatus"]."','" .$_POST["electronicinvitationstatus"]."','" .$_POST["address"]."','" .$_POST["city"]."','" .$_POST["stateprovince"]."','" .$_POST["zippostalcode"]."','" .$_POST["country"]."','" .$_POST["stdrsvp"]."')";	

	$db->query($query);

	//Close db
	mysqli_close($db);

	//Redirect to success page
	$successPage="http://" . $_SERVER['HTTP_HOST'] . "/admin/index.php?status=success&group=household";
	header("Location: " . $successPage);

	function sanitizePost($key, $value){
		$formFields[$key] = trim(htmlspecialchars($value));
	}
?>