<?php
	INCLUDE "../../../db_config.php";

	$from="Juris & Jewel<hello@jurisjewelclosingthedistance.com>";
	$bcc="jurisjeweltungpalan@gmail.com";
	$subject="Help Kick Off the Festivities The Night Before with Juris & Jewel!";

	$headers="From: " . $from . "\r\n";
	$headers.="Reply-To: ". $from . "\r\n";
	$headers.="BCC: " . $bcc . "\r\n";
	$headers.="MIME-Version: 1.0\r\n";
	$headers.="Content-Type: text/html; charset=ISO-8859-1";

	$query="SELECT * FROM (SELECT h.HouseholdID, Household, LastName as Name, GROUP_CONCAT(if(g.EmailAddress='',null,g.EmailAddress)) as EmailAddress FROM Households h INNER JOIN Guests g ON h.HouseholdID = g.HouseholdID WHERE InvitationRSVP LIKE 'Attending' GROUP BY HouseholdID, Household) as a where EmailAddress not like '' and HouseholdID = 93";
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
			$body.="<img src='http://www.jurisjewelclosingthedistance.com/images/welcome-drinks.jpg' alt='Juris & Jewel Welcome Drinks' width='600'>";
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
			$body.="If you're already in Tagaytay the night before our wedding, <br>drop by, say hi and join us at our";
			$body.="</td></tr>";
			$body.="<tr><td width='600' align='center' style='padding:20px 0 30px;'>";
			$body.="<span style='font-size:30px; color:#088db1;'>WELCOME DRINKS PARTY</span>";
			$body.="</td></tr>";
			$body.="<tr><td width='150' align='center' style='padding:0; border-top: 1px solid #CCCCCC;'>";
			$body.="&nbsp;";
			$body.="</td></tr>";
			$body.="<tr><td width='600' align='center' style='padding:0; vertical-align:middle'>";
			$body.="<strong style='font-size:25px;'>12 <span style='font-size:14px;'>◇</span> 21 <span style='font-size:14px;'>◇</span> 2018</strong><br><span style='font-size: 16px;'>December 21, 2018</span><br>Our Last Monthsary!";
			$body.="</td></tr>";
			$body.="<tr><td width='150' align='center' style='padding:0; border-bottom: 1px solid #CCCCCC;'>";
			$body.="&nbsp;";
			$body.="</td></tr>";
			$body.="<tr><td width='600' align='center' style='padding:15px 0;'>";
			$body.="Friday, 8:00pm<br><strong>Terraza Al Fresco at Balay Dako, Tagaytay</strong>";
			$body.="</td></tr>";
			$body.="<tr><td width='600' align='center' style='padding:15px 0;'>";
			$body.="Attire: <strong>Smart Casual</strong>";
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