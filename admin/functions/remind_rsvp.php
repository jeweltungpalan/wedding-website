<?php
	INCLUDE "../../../db_config.php";

	$from="Juris & Jewel<hello@jurisjewelclosingthedistance.com>";
	$bcc="jurisjeweltungpalan@gmail.com";
	$subject="Juris & Jewel are Waiting for your RSVP!";

	$headers="From: " . $from . "\r\n";
	$headers.="Reply-To: ". $from . "\r\n";
	$headers.="BCC: " . $bcc . "\r\n";
	$headers.="MIME-Version: 1.0\r\n";
	//$headers.="Content-Type: multipart/alternative;boundary=" . $boundary . "\r\n";
	$headers.="Content-Type: text/html; charset=ISO-8859-1";

	$query="SELECT * FROM (SELECT h.HouseholdID, Household, FirstName, LastName, GROUP_CONCAT(if(g.EmailAddress='',null,g.EmailAddress)) as EmailAddress FROM Households h INNER JOIN Guests g ON h.HouseholdID = g.HouseholdID WHERE category not like 'b-list' and InvitationRSVP like '' GROUP BY HouseholdID, Household) as a where EmailAddress not like ''";
	$result=$db->query($query);

	if(mysqli_num_rows($result) == 0){
		$error_page="http://" . $_SERVER['HTTP_HOST'] . "/admin/index.php?group=household" . "?status=error";
		echo "error";
	}
	else{
		while($row=$result->fetch_assoc()){
			//$boundary = uniqid('np');

			$query="SELECT NickName FROM Households h INNER JOIN Guests g ON h.HouseholdID=g.HouseholdID WHERE h.HouseholdID in(SELECT HouseholdID from Guests WHERE HouseholdID = " . $row["HouseholdID"] .")";
			$guests=$db->query($query);

			$to=$row["EmailAddress"];

			/*$body="\r\n\r\n--" . $boundary . "\r\n";
			$body.="Content-type: text/plain;charset=ISO-8859-1\r\n\r\n";
			
			$body.="We hope you received our wedding invitation that was sent to you early this month. Unfortunately, we have not yet received an RSVP from you and we just wanted to know see if you will be attending as we need to get the final numbers to our caterer. Hoping you'll be there!\n";
			$body.="Please RSVP by visiting this link: http://www.jurisjewelclosingthedistance.com/rsvp/invitation.php?utm_source=invite&utm_medium=email&utm_campaign=invitation&hid=" . $row["HouseholdID"] . "&name=" . $row["Name"];
			
			$body.="\r\n\r\n--" . $boundary . "\r\n";
			$body.="Content-type: text/html;charset=ISO-8859-1\r\n\r\n";*/

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
			$body.="<tr><td width='600' align='center' style='padding:30px 0 0;'>";
			$body.="We hope you received our wedding invitation that was sent to you early this month. Unfortunately, we have not yet received an RSVP from you and we just wanted to see if you will be attending as we need to get the final numbers to our caterer. Hoping you'll be there!";
			$body.="</td></tr>";
			$body.="<tr><td width='600' align='center' style='padding:15px 0;'>";
			$body.="Please RSVP as soon as possible by clicking the button below!";
			$body.="</td></tr>";
			$body.="<tr><td width='600' align='center' style='padding:0;'>";
			$body.="<a href='http://www.jurisjewelclosingthedistance.com/rsvp/index.php?firstname=" . $row["FirstName"] . "&lastname=" . $row["LastName"] . "'>";
			$body.="<img src='http://www.jurisjewelclosingthedistance.com/images/rsvp-button.png' alt='RSVP here' width='336'>";
			$body.="</a>";
			$body.="</td></tr>";
			$body.="<tr><td width='600' align='center' style='padding: 15px 0;'>";
			$body.="- Juris & Jewel";
			$body.="</td></tr>";
			$body.="</table>";
			$body.="</td></tr>";
			$body.="</table>";
			$body.="</body></html>";

			//echo $body;
			mail($to, $subject, wordwrap($body), $headers);

			echo "<p>Sent to " . $to . "</p>";
		}
	}

	mysqli_close($db);
?>