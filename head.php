<?php
	$page=preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);

	if($page=="/rsvp/invitation.php"){
		INCLUDE "../../db_config.php";

		if(trim($_GET['hid']) == '' || trim($_GET['name']) == ''){
			header("Location:http://" . $_SERVER['HTTP_HOST'] . "/rsvp/index.php");
			exit();
		}
		else{
			$householdID=trim($_GET['hid']);
			$name=trim($_GET['name']);

			$query="SELECT Household FROM Households WHERE HouseholdID = '".$householdID."' AND Household LIKE '%".$name. "%'";
			$households=$db->query($query);
			$household=$households->fetch_assoc();

			if(mysqli_num_rows($households) <> 1){
				$householdExists=false;
				header("Location:http://" . $_SERVER['HTTP_HOST'] . "/rsvp/index.php");
				exit();
			}
			else{
				$householdExists=true;
				$query="SELECT Household, GuestID, FirstName, LastName, NickName FROM Households h INNER JOIN Guests g ON h.HouseholdID=g.HouseholdID WHERE h.HouseholdID in(SELECT HouseholdID from Guests WHERE HouseholdID = '".$householdID."' AND Household LIKE '%".$name. "%')";
				$guests=$db->query($query);
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=medium-dpi" />

<link rel="apple-touch-icon" sizes="57x57" href="/images/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/images/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/images/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/images/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/images/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/images/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/images/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/images/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/images/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/images/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
<link rel="manifest" href="/images/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<link rel="stylesheet" href="/css/style.css"/>