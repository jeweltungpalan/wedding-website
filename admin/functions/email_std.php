<?php
	INCLUDE "../../../db_config.php";

	$from="Juris & Jewel<hello@jurisjewelclosingthedistance.com>";
	$bcc="jurisjeweltungpalan@gmail.com";
	$subject="Mark Your Calendar, Juris & Jewel are Getting Married!";

	$headers="From: " . $from . "\r\n";
	$headers.="Reply-To: ". $from . "\r\n";
	$headers.="BCC: " . $bcc . "\r\n";
	$headers.="MIME-Version: 1.0\r\n";
	$headers.="Content-Type: text/html; charset=UTF-8";

	$query="SELECT * FROM (SELECT h.HouseholdID, Household, GROUP_CONCAT(g.EmailAddress) as EmailAddress FROM Households h INNER JOIN Guests g ON h.HouseholdID = g.HouseholdID WHERE ElectronicSTDStatus not like 'sent' and h.HouseholdID = " . $_POST["id"] . " GROUP BY HouseholdID, Household) as a where EmailAddress not like ''";
	$result=$db->query($query);

	if(mysqli_num_rows($result) == 0){
		$error_page="http://" . $_SERVER['HTTP_HOST'] . "/admin/index.php?group=household" . "?status=error";
		echo "error";
	}
	else{
		while($row=$result->fetch_assoc()){
			$to=$row["EmailAddress"];
			
			$body="<html>";
			$body.="<head><style type='text/css'>";
			$body.="table {border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; table-layout: fixed;}";
			$body.="table table { table-layout: auto; }";
			$body.="</style></head>";
			$body.="<body>";
			$body.="<table width='100%' border='0' cellspacing='0' cellpadding='0' style='' bgcolor='#ffffff'><tr><td align='center'>";
			$body.="<table width='600' border='0' align='center' cellpadding='0' cellspacing='0' class='deviceWidth'>";
			$body.="<tr><td width='600' align='center'>";
			$body.="<img src='http://www.jurisjewelclosingthedistance.com/images/logo.png' alt='Juris & Jewel' width='55'>";
			$body.="</td></tr>";
			$body.="<tr><td width='600' align='center' style='color:#088db1; padding:15px 0 30px; font-size:15px;'>";
			$body.="<b>" . trim($row["Household"]) . ",</b>";
			$body.="</td></tr>";
			$body.="<tr><td width='600' align='center'>";
			$body.="<a href='http://www.jurisjewelclosingthedistance.com/?utm_source=invite&utm_medium=email&utm_campaign=save_the_date&hid=" . trim($row["HouseholdID"]) . "'><img src='http://www.jurisjewelclosingthedistance.com/images/save-the-date.jpg' alt='View Our Website www.JurisJewelClosingTheDistance.com' width='600'></a>";
			$body.="</td></tr>";
			$body.="<tr><td width='600' align='center' style='font-size:11px; color:#333333;'>";
			$body.="<em>(Click the image to view our website)</em>";
			$body.="</td></tr>";
			$body.="<tr><td width='600' align='center' style='padding: 15px 0;'>";
			$body.="<a href='https://calendar.google.com/calendar/ical/jurisjeweltungpalan%40gmail.com/private-18ac5ec8b33c1405dc8e23821eb398a3/basic.ics'><img src='http://www.jurisjewelclosingthedistance.com/images/save-the-date-button.jpg' alt='Add to Calendar' width='336'></a>";
			$body.="</td></tr>";
			$body.="<tr><td width='600' align='center' style='padding: 15px 0;'>";
			$body.="- Juris & Jewel";
			$body.="</td></tr>";
			$body.="</table>";
			$body.="</td></tr>";
			$body.="</table>";
			$body.="</body></html>";
				
			mail($to, $subject, $body, $headers);

			$query="UPDATE Households SET ElectronicSTDStatus = 'Sent' WHERE HouseholdID LIKE '" . $row["HouseholdID"] . "'";		
			$db->query($query);

			echo "success";
		}
	}

	mysqli_close($db);
?>