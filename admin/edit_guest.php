<?php INCLUDE "../head.php"; ?>
<title>Edit Guest | Tungpalan - Pajarillo Wedding</title>

<?php
	INCLUDE "../../db_config.php";
	$query="SELECT * FROM Guests WHERE GuestID = " . $_GET["gid"];
	$result=$db->query($query);
	$row=$result->fetch_assoc()
?>

<body class="wrapper interior" id="admin">
	<div class="main-content xs-12">
		<header class="content-wrapper align-center">
			<a href="/""><img src="/images/logo.png" height="60" alt="Juris & Jewel"></a>
			<h2 class="uppercase">Edit Guest</h2>
		</header>

		<div class="content-wrapper">
			<form name="editHousehold" action="functions/edit_guest.php" method="post" class="group inner-row">
				<h3 class="xs-12 md-12">Basic Info</h3>

				<div class="col xs-12 md-4">
					<span class="field-name">Title</span>
					<input type="text" name="title" class="field" placeholder="Title" value="<?php echo $row["Title"] ?>">
				</div>
				<div class="col xs-12 md-4">
					<span class="field-name">First Name</span>
					<input type="text" name="firstname" class="field req" placeholder="First Name" value="<?php echo $row["FirstName"] ?>">
				</div>
				<div class="col xs-12 md-4">
					<span class="field-name">Last Name</span>
					<input type="text" name="lastname" class="field req" placeholder="Last Name" value="<?php echo $row["LastName"] ?>">
				</div>
				<div class="col xs-12 md-6">
					<span class="field-name">Nick Name</span>
					<input type="text" name="nickname" class="field req" placeholder="Nick Name" value="<?php echo $row["NickName"] ?>">
				</div>
				<div class="col xs-12 md-6">
					<span class="field-name">Role</span>
					<select name="role" class="field req">
						<option value="">Select Role</option>
						<option value="Bearer" <?php echo ($row["Role"] == "Bearer" ? "selected" : ""); ?>>Bearer</option>
						<option value="Best Man" <?php echo ($row["Role"] == "Best Man" ? "selected" : ""); ?>>Best Man</option>
						<option value="Bridesmaid" <?php echo ($row["Role"] == "Bridesmaid" ? "selected" : ""); ?>>Bridesmaid</option>
						<option value="Guest" <?php echo ($row["Role"] == "Guest" ? "selected" : ""); ?>>Guest</option>
						<option value="Groomsman" <?php echo ($row["Role"] == "Groomsman" ? "selected" : ""); ?>>Groomsman</option>
						<option value="Father of the Bride" <?php echo ($row["Role"] == "Father of the Bride" ? "selected" : ""); ?>>Father of the Bride</option>
						<option value="Father of the Groom" <?php echo ($row["Role"] == "Father of the Groom" ? "selected" : ""); ?>>Father of the Groom</option>
						<option value="Flower Girl" <?php echo ($row["Role"] == "Flower Girl" ? "selected" : ""); ?>>Flower Girl</option>
						<option value="Maid of Honor" <?php echo ($row["Role"] == "Maid of Honor" ? "selected" : ""); ?>>Maid of Honor</option>
						<option value="Mother of the Bride" <?php echo ($row["Role"] == "Mother of the Bride" ? "selected" : ""); ?>>Mother of the Bride</option>
						<option value="Mother of the Groom" <?php echo ($row["Role"] == "Mother of the Groom" ? "selected" : ""); ?>>Mother of the Groom</option>
						<option value="Primary Sponsor" <?php echo ($row["Role"] == "Primary Sponsor" ? "selected" : ""); ?>>Primary Sponsor</option>
						<option value="Secondary Sponsor" <?php echo ($row["Role"] == "Secondary Sponsor" ? "selected" : ""); ?>>Secondary Sponsor</option>
						<option value="VIP Guest" <?php echo ($row["Role"] == "VIP Guest" ? "selected" : ""); ?>>VIP Guest</option>
					</select>
				</div>

				<h3 class="xs-12 md-12">Contact Info</h3>
				<div class="col xs-12 md-6">
					<span class="field-name">Email Address</span>
					<input type="email" name="emailaddress" class="field email" placeholder="Email Address" value="<?php echo $row["EmailAddress"] ?>">
				</div>
				<div class="col xs-12 md-6">
					<span class="field-name">Phone</span>
					<input type="text" name="phone" class="field phone" placeholder="Phone (xxx-xxx-xxxx)" value="<?php echo $row["Phone"] ?>">
				</div>

				<div class="section-content buttons-wrapper align-center">
					<input type="hidden" name="gid" value="<?php echo $_GET['gid']; ?>">
					<a href="index.php?group=individual" class="button dark">Cancel</a>	<button type="submit" name="send" class="form-submit button dark default">Save</button>	
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