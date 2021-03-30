<?php INCLUDE "../head.php"; ?>
<title>Edit Household | Tungpalan - Pajarillo Wedding</title>

<?php
	INCLUDE "../../db_config.php";
	$query="SELECT * FROM Households WHERE HouseholdID = " . $_GET["hid"];
	$result=$db->query($query);
	$row=$result->fetch_assoc();
?>

<body class="wrapper interior" id="admin">
	<div class="main-content xs-12">
		<header class="content-wrapper align-center">
			<a href="/"><img src="/images/logo.png" height="60" alt="Juris & Jewel"></a>
			<h2 class="uppercase">Edit Household</h2>
		</header>

		<div class="content-wrapper">
			<form name="editHousehold" action="functions/edit_household.php" method="post" class="group inner-row">
				<h3 class="xs-12 sm-12">Basic Info</h3>

				<div class="xs-12 sm-12">
					<span class="field-name">Household</span>
					<input type="text" name="household" class="field req" placeholder="Household" value="<?php echo $row["Household"] ?>">
				</div>
				<div class="col xs-12 sm-6">
					<span class="field-name">Side</span>
					<select name="side" class="field req">
						<option value="">Select Side</option>
						<option value="Bride" <?php echo ($row["Side"] == "Bride" ? "selected" : ""); ?>>Bride</option>
						<option value="Groom" <?php echo ($row["Side"] == "Groom" ? "selected" : ""); ?>>Groom</option>
						<option value="Bride and Groom" <?php echo ($row["Side"] == "Bride and Groom" ? "selected" : ""); ?>>Bride and Groom</option>
					</select>
				</div>
				<div class="col xs-12 sm-6">
					<span class="field-name">Category</span>
					<select name="category" class="field req">
						<option value="">Select Category</option>
						<option value="Immediate Family" <?php echo ($row["Category"] == "Immediate Family" ? "selected" : ""); ?>>Immediate Family</option>
						<option value="Extended Family" <?php echo ($row["Category"] == "Extended Family" ? "selected" : ""); ?>>Extended Family</option>
						<option value="Close Friends" <?php echo ($row["Category"] == "Close Friends" ? "selected" : ""); ?>>Close Friends</option>
						<option value="Acquaintances" <?php echo ($row["Category"] == "Acquaintances" ? "selected" : ""); ?>>Acquaintances</option>
						<option value="Family Friend" <?php echo ($row["Category"] == "Family Friend" ? "selected" : ""); ?>>Family Friend</option>
						<option value="B-List" <?php echo ($row["Category"] == "B-List" ? "selected" : ""); ?>>B-List</option>
					</select>
				</div>

				<h3 class="xs-12 sm-12">Contact Info</h3>
				<div class="xs-12 sm-12">
					<span class="field-name">Address</span>
					<input type="text" name="address" class="field" placeholder="Address" value="<?php echo $row["Address"] ?>">
				</div>
				<div class="col xs-12 sm-4">
					<span class="field-name">City</span>
					<input type="text" name="city" class="field" placeholder="City" value="<?php echo $row["City"] ?>">
				</div>
				<div class="col xs-12 sm-4">
					<span class="field-name">State/Province</span>
					<input type="text" name="stateprovince" class="field" placeholder="State / Province" value="<?php echo $row["StateProvince"] ?>">
				</div>
				<div class="col xs-12 sm-4">
					<span class="field-name">Zip/Postal Code</span>
					<input type="text" name="zippostalcode" class="field" placeholder="Zip / Postal Code" value="<?php echo $row["ZipPostalCode"] ?>">
				</div>
				<div class="xs-12 sm-12">
					<span class="field-name">Country</span>
					<input type="text" name="country" class="field req" placeholder="Country" value="<?php echo $row["Country"] ?>">
				</div>

				<h3 class="xs-12 sm-12">RSVP Info</h3>
				<div class="col xs-12 sm-4">
					<span class="field-name">Printed Save-the-Date Status</span>
					<select name="printedstdstatus" class="field">
						<option value="">Select Printed Save-the-Date Status</option>
						<option value="To Send" <?php echo ($row["PrintedSTDStatus"] == "To Send" ? "selected" : ""); ?>>To Send</option>
						<option value="Printed" <?php echo ($row["PrintedSTDStatus"] == "Printed" ? "selected" : ""); ?>>Printed</option>
						<option value="Domestic Mailed" <?php echo ($row["PrintedSTDStatus"] == "Domestic Mailed" ? "selected" : ""); ?>>Domestic Mailed</option>
						<option value="International Mailed" <?php echo ($row["PrintedSTDStatus"] == "International Mailed" ? "selected" : ""); ?>>International Mailed</option>
						<option value="Hand Delivered" <?php echo ($row["PrintedSTDStatus"] == "Hand Delivered" ? "selected" : ""); ?>>Hand Delivered</option>
					</select>
				</div>
				<div class="col xs-12 sm-4">
					<span class="field-name">Electronic Save-the-Date Status</span>
					<select name="electronicstdstatus" class="field">
						<option value="">Select Electronic Save-the-Date Status</option>
						<option value="Sent" <?php echo ($row["ElectronicSTDStatus"] == "" ?: "selected"); ?>>Sent</option>
					</select>
				</div>
				<div class="col xs-12 sm-4">
					<span class="field-name">Save-the-Date RSVP</span>
					<select name="stdrsvp" class="field">
						<span class="field-name">Save-the-Date RSVP</span>
						<option value="">Select Save-the-Date RSVP</option>
						<option value="Accepted" <?php echo ($row["STDRSVP"] == "Accepted" ? "selected" : ""); ?>>Accepted</option>
						<option value="Declined" <?php echo ($row["STDRSVP"] == "Declined" ? "selected" : ""); ?>>Declined</option>
					</select>
				</div>
				<div class="col xs-12 sm-6">
					<span class="field-name">Printed Invitation Status</span>
					<select name="printedinvitationstatus" class="field">
						<option value="">Select Printed Invitation Status</option>
						<option value="To Send" <?php echo ($row["PrintedInvitationStatus"] == "To Send" ? "selected" : ""); ?>>To Send</option>
						<option value="Printed" <?php echo ($row["PrintedInvitationStatus"] == "Printed" ? "selected" : ""); ?>>Printed</option>
						<option value="Domestic Mailed" <?php echo ($row["PrintedInvitationStatus"] == "Domestic Mailed" ? "selected" : ""); ?>>Domestic Mailed</option>
						<option value="International Mailed" <?php echo ($row["PrintedInvitationStatus"] == "International Mailed" ? "selected" : ""); ?>>International Mailed</option>
						<option value="Hand Delivered" <?php echo ($row["PrintedInvitationStatus"] == "Hand Delivered" ? "selected" : ""); ?>>Hand Delivered</option>
					</select>
				</div>
				<div class="col xs-12 sm-6">
					<span class="field-name">Electronic Invitation Status</span>
					<select name="electronicinvitationstatus" class="field">
						<option value="">Select Electronic Invitation Status</option>
						<option value="Sent" <?php echo ($row["ElectronicInvitationStatus"] == "" ?: "selected"); ?>>Sent</option>
					</select>
				</div>
				<div class="col xs-12 sm-6">
					<span class="field-name">Printed Thank You Card Status</span>
					<select name="printedthankyoucardstatus" class="field">
						<option value="">Select Printed Thank You Card Status</option>
						<option value="To Send" <?php echo ($row["PrintedThankYouCardStatus"] == "To Send" ? "selected" : ""); ?>>To Send</option>
						<option value="Printed" <?php echo ($row["PrintedThankYouCardStatus"] == "Printed" ? "selected" : ""); ?>>Printed</option>
						<option value="Domestic Mailed" <?php echo ($row["PrintedThankYouCardStatus"] == "Domestic Mailed" ? "selected" : ""); ?>>Domestic Mailed</option>
						<option value="International Mailed" <?php echo ($row["PrintedThankYouCardStatus"] == "International Mailed" ? "selected" : ""); ?>>International Mailed</option>
						<option value="Hand Delivered" <?php echo ($row["PrintedThankYouCardStatus"] == "Hand Delivered" ? "selected" : ""); ?>>Hand Delivered</option>
					</select>
				</div>
				<div class="col xs-12 sm-6">
					<span class="field-name">Electronic Thank You Card Status</span>
					<select name="electronicthankyoucardstatus" class="field">
						<option value="">Select Electronic Thank You Card Status</option>
						<option value="Sent" <?php echo ($row["ElectronicThankYouCardStatus"] == "" ?: "selected"); ?>>Sent</option>
					</select>
				</div>

				<h3 class="xs-12 sm-12">Party Info</h3>
				<?php
					$query="SELECT * FROM Households h INNER JOIN Guests g ON h.HouseholdID = g.HouseholdID WHERE h.HouseholdID = " . $_GET["hid"];
					$result=$db->query($query);

					$guestNumber=1;
					while($guest=$result->fetch_assoc()){
						$individual="<h4 class='xs-12 sm-12'>Guest " . $guestNumber . "</h4>";
						$individual.="<div class='col xs-12 sm-4'>";
						$individual.="<span class='field-name'>Title</span>";
						$individual.="<input type='text' name='title-" . $guest["GuestID"] . "' class='field' placeholder='Title' value='" . $guest["Title"] . "'>";
						$individual.="</div>";
						$individual.="<div class='col xs-12 sm-4'>";
						$individual.="<span class='field-name'>First Name</span>";
						$individual.="<input type='text' name='firstname-" . $guest["GuestID"] . "' class='field req' placeholder='First Name' value='" . $guest["FirstName"] . "'>";
						$individual.="</div>";
						$individual.="<div class='col xs-12 sm-4'>";
						$individual.="<span class='field-name'>Last Name</span>";
						$individual.="<input type='text' name='lastname-" . $guest["GuestID"] . "' class='field req' placeholder='Last Name' value='" . $guest["LastName"] . "'>";
						$individual.="</div>";
						$individual.="<div class='col xs-12 sm-6'>";
						$individual.="<span class='field-name'>Nick Name</span>";
						$individual.="<input type='text' name='nickname-" . $guest["GuestID"] . "' class='field' placeholder='Nick Name' value='" . $guest["NickName"] . "'>";
						$individual.="</div>";
						$individual.="<div class='col xs-12 sm-6'>";
						$individual.="<span class='field-name'>Role</span>";
						$individual.="<select name='role-" . $guest["GuestID"] . "' class='field req'>";
						$individual.="<option value=''>Select Role</option>";
						$individual.="<option value='Bearer'" . ($guest["Role"] == "Bearer" ? "selected" : "") . ">Bearer</option>";
						$individual.="<option value='Best Man'" . ($guest["Role"] == "Best Man" ? "selected" : "") . ">Best Man</option>";
						$individual.="<option value='Bridesmaid'" . ($guest["Role"] == "Bridesmaid" ? "selected" : "") . ">Bridesmaid</option>";
						$individual.="<option value='Guest'" . ($guest["Role"] == "Guest" ? "selected" : "") . ">Guest</option>";
						$individual.="<option value='Groomsman'" . ($guest["Role"] == "Groomsman" ? "selected" : "") . ">Groomsman</option>";
						$individual.="<option value='Father of the Bride'" . ($guest["Role"] == "Father of the Bride" ? "selected" : "") . ">Father of the Bride</option>";
						$individual.="<option value='Father of the Groom'" . ($guest["Role"] == "Father of the Groom" ? "selected" : "") . ">Father of the Groom</option>";
						$individual.="<option value='Flower Girl'" . ($guest["Role"] == "Flower Girl" ? "selected" : "") . ">Flower Girl</option>";
						$individual.="<option value='Maid of Honor'" . ($guest["Role"] == "Maid of Honor" ? "selected" : "") . ">Maid of Honor</option>";
						$individual.="<option value='Mother of the Bride'" . ($guest["Role"] == "Mother of the Bride" ? "selected" : "") . ">Mother of the Bride</option>";
						$individual.="<option value='Mother of the Groom'" . ($guest["Role"] == "Mother of the Groom" ? "selected" : "") . ">Mother of the Groom</option>";
						$individual.="<option value='Primary Sponsor'" . ($guest["Role"] == "Primary Sponsor" ? "selected" : "") . ">Primary Sponsor</option>";
						$individual.="<option value='Secondary Sponsor'" . ($guest["Role"] == "Secondary Sponsor" ? "selected" : "") . ">Secondary Sponsor</option>";
						$individual.="<option value='VIP Guest'" . ($guest["Role"] == "VIP Guest" ? "selected" : "") . ">VIP Guest</option>";
						$individual.="</select>";
						$individual.="</div>";
						$individual.="<div class='col xs-12 sm-6'>";
						$individual.="<span class='field-name'>Email Address</span>";
						$individual.="<input type='text' name='emailaddress-" . $guest["GuestID"] . "' class='field' placeholder='Email Address' value='" . $guest["EmailAddress"] . "'>";
						$individual.="</div>";
						$individual.="<div class='col xs-12 sm-6'>";
						$individual.="<span class='field-name'>Phone</span>";
						$individual.="<input type='text' name='phone-" . $guest["GuestID"] . "' class='field' placeholder='Phone' value='" . $guest["Phone"] . "'>";
						$individual.="</div>";
						$guestNumber+=1;

						echo $individual;
					}
				?>

				<div class="section-content buttons-wrapper align-center">
					<input type="hidden" name="hid" value="<?php echo $_GET['hid']; ?>">
					<a href="index.php?group=household" class="button dark">Cancel</a>	<button type="submit" name="send" class="form-submit button dark default">Save</button>	
				</div>	
			</form>
		</div>

		<?php mysqli_close($db); ?>		

		<link href="https://fonts.googleapis.com/css?family=Raleway:500,600" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script type="text/javascript" src="/js/common.js"></script>
	</div>
</body>
</html>