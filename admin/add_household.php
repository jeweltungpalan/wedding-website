<?php INCLUDE "../head.php"; ?>
<title>Add Household | Tungpalan - Pajarillo Wedding</title>

<?php
	INCLUDE "../../db_config.php";
	$query="SELECT HouseholdID, concat(Household,' - ',Country) as Household FROM Households ORDER BY Household";
	$result=$db->query($query);
?>

<body class="wrapper interior" id="admin">
	<div class="main-content">
		<header class="content-wrapper align-center">
			<a href="/""><img src="/images/logo.png" height="60" alt="Juris & Jewel"></a>
			<h2 class="uppercase">Add Household</h2>
		</header>

		<div class="utilities">
			<div class="xs-12 md-12 group align-center">
				<a href="add_guest.php" class="utility-button tab"><i class="fas fa-user"></i> Individual</a><a href="add_household.php" class="utility-button tab current"><i class="fas fa-users"></i> Add Household</a>
			</div>
		</div>

		<div class="content-wrapper xs-12 md-12">
			<form name="addHousehold" action="functions/add_household.php" method="post" class="group inner-row">
				<h3 class="xs-12 sm-12">Basic Info</h3>

				<div class="xs-12 sm-12">
					<span class="field-name">Household</span>
					<input type="text" name="household" class="field req" placeholder="Household" value="<?php echo $row["Household"] ?>">
				</div>
				<div class="col xs-12 sm-6">
					<span class="field-name">Side</span>
					<select name="side" class="field req">
						<option value="">Select Side</option>
						<option value="Bride">Bride</option>
						<option value="Groom">Groom</option>
						<option value="Bride and Groom">Bride and Groom</option>
					</select>
				</div>
				<div class="col xs-12 sm-6">
					<span class="field-name">Category</span>
					<select name="category" class="field req">
						<option value="">Select Category</option>
						<option value="Immediate Family">Immediate Family</option>
						<option value="Extended Family">Extended Family</option>
						<option value="Close Friends">Close Friends</option>
						<option value="Acquaintances">Acquaintances</option>
						<option value="Family Friend">Family Friend</option>
						<option value="B-List">B-List</option>
					</select>
				</div>

				<h3 class="xs-12 sm-12">Contact Info</h3>
				<div class="xs-12 sm-12">
					<span class="field-name">Address</span>
					<input type="text" name="address" class="field" placeholder="Address">
				</div>
				<div class="col xs-12 sm-4">
					<span class="field-name">City</span>
					<input type="text" name="city" class="field" placeholder="City">
				</div>
				<div class="col xs-12 sm-4">
					<span class="field-name">State/Province</span>
					<input type="text" name="stateprovince" class="field" placeholder="State / Province">
				</div>
				<div class="col xs-12 sm-4">
					<span class="field-name">Zip/Postal Code</span>
					<input type="text" name="zippostalcode" class="field" placeholder="Zip / Postal Code">
				</div>
				<div class="xs-12 sm-12">
					<span class="field-name">Country</span>
					<input type="text" name="country" class="field req" placeholder="Country">
				</div>

				<h3 class="xs-12 sm-12">RSVP Info</h3>
				<div class="col xs-12 sm-4">
					<span class="field-name">Printed Save-the-Date Status</span>
					<select name="printedstdstatus" class="field">
						<option value="">Select Printed Save-the-Date Status</option>
						<option value="To Send">To Send</option>
						<option value="Printed">Printed</option>
						<option value="Domestic Mailed">Domestic Mailed</option>
						<option value="International Mailed">International Mailed</option>
						<option value="Hand Delivered">Hand Delivered</option>
					</select>
				</div>
				<div class="col xs-12 sm-4">
					<span class="field-name">Electronic Save-the-Date Status</span>
					<select name="electronicstdstatus" class="field">
						<option value="">Select Electronic Save-the-Date Status</option>
						<option value="Sent">Sent</option>
					</select>
				</div>
				<div class="col xs-12 sm-4">
					<span class="field-name">Save-the-Date RSVP</span>
					<select name="stdrsvp" class="field">
						<span class="field-name">Save-the-Date RSVP</span>
						<option value="">Select Save-the-Date RSVP</option>
						<option value="Accepted">Accepted</option>
						<option value="Declined">Declined</option>
					</select>
				</div>
				<div class="col xs-12 sm-6">
					<span class="field-name">Printed Invitation Status</span>
					<select name="printedstdstatus" class="field">
						<option value="">Select Printed Invitation Status</option>
						<option value="To Send">To Send</option>
						<option value="Printed">Printed</option>
						<option value="Domestic Mailed">Domestic Mailed</option>
						<option value="International Mailed">International Mailed</option>
						<option value="Hand Delivered">Hand Delivered</option>
					</select>
				</div>
				<div class="col xs-12 sm-6">
					<span class="field-name">Electronic Invitation Status</span>
					<select name="electronicstdstatus" class="field">
						<option value="">Select Electronic Invitation Status</option>
						<option value="Sent">Sent</option>
					</select>
				</div>

				<div class="section-content buttons-wrapper align-center">
					<a href="index.php?group=household" class="button dark">Cancel</a>	<button type="submit" name="send" class="form-submit button dark default">Save</button>	
				</div>	
			</form>

			<?php mysqli_close($db); ?>
		</div>

		<link href="https://fonts.googleapis.com/css?family=Raleway:500,600" rel="stylesheet">
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script type="text/javascript" src="/js/common.js"></script>
	</div>
</body>
</html>