<?php
	INCLUDE "../../../db_config.php";

	$successPage="http://" . $_SERVER['HTTP_HOST'] . "/admin/index.php?status=success&group=individual";
	$errorPage="http://" . $_SERVER['HTTP_HOST'] . "/admin/edit_guest.php?status=error";

	//Trim Fields
	$formFields = array();
	array_walk($_POST, 'sanitizePost');
	$escapedName=mysqli_real_escape_string($db,trim($_POST["firstname"]));

	//Validate
	if($_POST["gid"] == '' || $_POST["firstname"] == '' || $_POST["lastname"] == '' || $_POST["nickname"] == '' || $_POST["role"]  == ''){
		header("Location: " . $errorPage);
	}

	//Update household
	$query="UPDATE Guests SET Title = '".$_POST['title']."', FirstName = '".$escapedName."', LastName = '".$_POST['lastname']."', NickName = '".$_POST['nickname']. "', Role = '".$_POST['role']."', 
	EmailAddress = '".$_POST['emailaddress']."', Phone = '".$_POST['phone']."' WHERE GuestID = ".$_POST["gid"];		
	$db->query($query);

	//Close db
	mysqli_close($db);

	//Redirect to success page
	header("Location: " . $successPage);

	function sanitizePost($key, $value){
		$formFields[$key] = trim(htmlspecialchars($value));
	}
?>