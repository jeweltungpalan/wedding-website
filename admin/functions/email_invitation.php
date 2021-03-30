<?php
	INCLUDE "../../../db_config.php";

	$from="Juris & Jewel<hello@jurisjewelclosingthedistance.com>";
	$bcc="jurisjeweltungpalan@gmail.com";
	$subject="You have an Invitation from Juris & Jewel!";

	$headers="From: " . $from . "\r\n";
	$headers.="Reply-To: ". $from . "\r\n";
	$headers.="BCC: " . $bcc . "\r\n";
	$headers.="MIME-Version: 1.0\r\n";
	$headers.="Content-Type: text/html; charset=ISO-8859-1";

	$query="SELECT * FROM (SELECT h.HouseholdID, Household, LastName as Name, GROUP_CONCAT(if(g.EmailAddress='',null,g.EmailAddress)) as EmailAddress FROM Households h INNER JOIN Guests g ON h.HouseholdID = g.HouseholdID WHERE ElectronicInvitationStatus not like 'sent' and PrintedInvitationStatus like '' and category not like 'b-list' GROUP BY HouseholdID, Household) as a where EmailAddress not like ''";
	$result=$db->query($query);

	if(mysqli_num_rows($result) == 0){
		$error_page="http://" . $_SERVER['HTTP_HOST'] . "/admin/index.php?group=household" . "?status=error";
		echo "error";
	}
	else{
		while($row=$result->fetch_assoc()){
			$query="SELECT NickName FROM Households h INNER JOIN Guests g ON h.HouseholdID=g.HouseholdID WHERE h.HouseholdID in(SELECT HouseholdID from Guests WHERE HouseholdID = " . $row["HouseholdID"] .")";
			$guests=$db->query($query);

			$to=$row["EmailAddress"];
			
			$body="<html>";
			$body.="<head><style type='text/css'>";
			$body.="table {border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; table-layout: fixed;}";
			$body.="table table { table-layout: auto; }";
			$body.="</style></head>";
			$body.="<body>";
			$body.="<table width='100%' border='0' cellspacing='0' cellpadding='0' style='color:#6c6c6c;' bgcolor='#ffffff'><tr><td align='center'>";
			$body.="<table width='600' border='0' align='center' cellpadding='0' cellspacing='0' class='deviceWidth'>";
			$body.="<tr><td width='600' align='center'>";
			$body.="<img src='http://www.jurisjewelclosingthedistance.com/images/logo.png' alt='Juris & Jewel' width='55'>";
			$body.="</td></tr>";
			if(mysqli_num_rows($guests) > 2){
				$body.="<tr><td width='600' align='center' style='color:#088db1; padding:15px 0 0; font-size:16px;'>";
				$body.="<b>" . trim($row["Household"]) . "</b>";
				$body.="</td></tr>";
				$body.="<tr><td width='600' align='center' style='font-size:12px;'>";
				$body.="<b>";
				$i=1;
				while($guest=$guests->fetch_assoc()){
					$body.=$guest["NickName"];
					if($i <> mysqli_num_rows($guests)){
						$body.=", ";
					}
					$i++;
				}
				$body.="</b>";
				$body.="</td></tr>";
			}
			else{
				$body.="<tr><td width='600' align='center' style='color:#088db1; padding:15px 0 0; font-size:16px;'>";
				$body.="<b>" . trim($row["Household"]) . "</b>";
				$body.="</td></tr>";
			}
			$body.="<tr><td width='600' align='center' style='padding:30px 0;'>";
			$body.="<a href='http://www.jurisjewelclosingthedistance.com/rsvp/invitation.php?utm_source=invite&utm_medium=email&utm_campaign=invitation&hid=" . $row["HouseholdID"] . "&name=" . $row["Name"] . "'>";
			$body.="<img src='http://www.jurisjewelclosingthedistance.com/images/invitation.jpg' alt='Open Your Invitation' width='600'>";
			$body.="</a>";
			$body.="</td></tr>";
			$body.="<tr><td width='600' align='center' style='padding: 15px 0;'>";
			$body.="- Juris & Jewel";
			$body.="</td></tr>";
			/*$body.="<tr><td width='600' align='center' style='padding: 30px 0;'>";
			$body.="<em>Note: We are resending this invitation just in case our previous email went to your spam folder. Please ignore if you have seen the invitation already.</em>";
			$body.="</td></tr>";*/
			$body.="</table>";
			$body.="</td></tr>";
			$body.="</table>";
			$body.="</body></html>";

			//echo $body;
			mail($to, $subject, wordwrap($body), $headers);

			$query="UPDATE Households SET ElectronicInvitationStatus = 'Sent' WHERE HouseholdID LIKE '" . $row["HouseholdID"] . "'";		
			$db->query($query);

			echo "<p>Sent to " . $to . "</p>";
		}
	}

	mysqli_close($db);
?>