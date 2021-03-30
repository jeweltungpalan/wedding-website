<?php INCLUDE "../head.php"; ?>
<title>Add Guest | Tungpalan - Pajarillo Wedding</title>

<?php
	INCLUDE "../../db_config.php";
	$query="SELECT HouseholdID, concat(Household,' - ',Country) as Household FROM Households ORDER BY Household";
	$result=$db->query($query);
?>

<body class="wrapper interior" id="admin">
	<div class="main-content">
		<header class="content-wrapper align-center">
			<a href="/""><img src="/images/logo.png" height="60" alt="Juris & Jewel"></a>
			<h2 class="uppercase">Add Guest</h2>
		</header>

		<div class="utilities">
			<div class="xs-12 md-12 group align-center">
				<a href="add_guest.php" class="utility-button tab current"><i class="fas fa-user"></i> Individual</a><a href="add_household.php" class="utility-button tab"><i class="fas fa-users"></i> Add Household</a>
			</div>
		</div>

		<div class="content-wrapper xs-12 md-12">
			<form name="editHousehold" action="functions/add_guest.php" method="post" class="group inner-row">
				<h3 class="xs-12 md-12">Basic Info</h3>

				<div class="col xs-12 md-4">
					<span class="field-name">Title</span>
					<input type="text" name="title" class="field" placeholder="Title">
				</div>
				<div class="col xs-12 md-4">
					<span class="field-name">First Name</span>
					<input type="text" name="firstname" class="field req" placeholder="First Name">
				</div>
				<div class="col xs-12 md-4">
					<span class="field-name">Last Name</span>
					<input type="text" name="lastname" class="field req" placeholder="Last Name">
				</div>
				<div class="col xs-12 md-6">
					<span class="field-name">Nick Name</span>
					<input type="text" name="nickname" class="field" placeholder="Nick Name">
				</div>
				<div class="col xs-12 md-6">
					<span class="field-name">Role</span>
					<select name="role" class="field req">
						<option value="">Select Role</option>
						<option value="Bearer">Bearer</option>
						<option value="Best Man">Best Man</option>
						<option value="Bridesmaid">Bridesmaid</option>
						<option value="Guest">Guest</option>
						<option value="Groomsman">Groomsman</option>
						<option value="Father of the Bride">Father of the Bride</option>
						<option value="Father of the Groom">Father of the Groom</option>
						<option value="Flower Girl">Flower Girl</option>
						<option value="Maid of Honor">Maid of Honor</option>
						<option value="Mother of the Bride">Mother of the Bride</option>
						<option value="Mother of the Groom">Mother of the Groom</option>
						<option value="Primary Sponsor">Primary Sponsor</option>
						<option value="Secondary Sponsor">Secondary Sponsor</option>
						<option value="VIP Guest">VIP Guest</option>
					</select>
				</div>

				<h3 class="xs-12 md-12">Contact Info</h3>
				<div class="col xs-12 md-6">
					<span class="field-name">Email Address</span>
					<input type="email" name="emailaddress" class="field email" placeholder="Email Address">
				</div>
				<div class="col xs-12 md-6">
					<span class="field-name">Phone</span>
					<input type="text" name="phone" class="field phone" placeholder="Phone (xxx-xxx-xxxx)">
				</div>

				<h3 class="xs-12 sm-12">Party Info</h3>
				<div class="col xs-12 md-12">
					<span class="field-name">Household</span>
					<select name="household" class="field req">
						<option value="">Select Household</option>
						<?php
							while($row=$result->fetch_assoc()){
								echo "<option value='" . $row["HouseholdID"] . "'>" . $row["Household"] . "</option>";
							}
						?>
					</select>
				</div>

				<div class="section-content buttons-wrapper align-center">
					<input type="hidden" name="group" value="individual">
					<a href="index.php?group=individual" class="button dark">Cancel</a>	<button type="submit" name="send" class="form-submit button dark default">Save</button>	
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