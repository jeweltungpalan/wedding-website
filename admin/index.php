<?php INCLUDE "../head.php"; ?>
<title>Guest List | Tungpalan - Pajarillo Wedding</title>

<?php
	INCLUDE "../../db_config.php";
?>

<body class="wrapper interior" id="admin">
	<div class="main-content">
		<header class="content-wrapper align-center">
			<a href="/"><img src="/images/logo.png" height="60" alt="Juris & Jewel"></a>
			<h2 class="uppercase">Guest List</h2>
			<p class="bondi-blue no-margin"><a href="guest_list_summary.php">View Full Summary</a></p>
		</header>

		<?php
			$query="SELECT count(GuestID) as NumberInvited, sum(Attending) as Attending, sum(Not_Attending) as Not_Attending, sum(Pending) as Pending from(SELECT GuestID, case when InvitationRSVP LIKE 'Attending' then 1 else 0 end as 'Attending', case when InvitationRSVP LIKE 'Declined' then 1 else 0 end as 'Not_Attending', case when InvitationRSVP like '' OR InvitationRSVP is null then 1 else 0 end as 'Pending' FROM Households h INNER JOIN Guests g ON h.HouseholdID = g.HouseholdID) as A";
			$result=$db->query($query);
			$row=$result->fetch_assoc()
		?>
		<div class="content-wrapper" id="summary">
			<div class="md-8 center-row group align-center">
				<div class="col xs-6 sm-3">
					<strong>Total Guests</strong>
					<p class="number"><?php echo $row["NumberInvited"]; ?></p>
				</div>
				<div class="col xs-6 sm-3">
					<strong>Attending</strong>
					<p class="number"><?php echo $row["Attending"]; ?></p>
				</div>
				<div class="col xs-6 sm-3">
					<strong>Not Attending</strong>
					<p class="number"><?php echo $row["Not_Attending"]; ?></p>
				</div>
				<div class="col xs-6 sm-3">
					<strong>No Response</strong>
					<p class="number"><?php echo $row["Pending"]; ?></p>
				</div>
			</div>
		</div>

		<?php
			if($_GET['status'] != '' && $_GET['status'] == 'success'){
				echo "<div class='align-center'><p class='notification success'>You have successfully updated a record!</p></div>";
			}
		?>

		<div class="utilities">
			<div class="xs-12 md-12 group">
				<div class="pull-right">
					<button type="button" name="sendstd" class="utility-button default" id="sendstd"><i class="fas fa-envelope fa-fw"></i> Send STD</button><a href="add_guest.php" class="utility-button default"><i class="fas fa-user-plus fa-fw"></i> Add Guest</a>
				</div>
				<div class="buttons-group">
					<a href="?group=individual" class="utility-button tab <?php echo ($_GET['group'] != 'household' ? 'current' : ''); ?>"><i class="fas fa-user"></i> Individual</a><a href="?group=household" class="utility-button tab <?php echo ($_GET['group'] == 'household' ? 'current' : ''); ?>"><i class="fas fa-users"></i> Household</a>
				</div>
			</div>
		</div>

		<div class="xs-12 md-12">
			<table class="table display">
				<thead>
					<tr>
						<?php 
							if($_GET['group'] != '' && $_GET['group'] == 'household'){
								echo 
									"<th class='no-sort'></th>
									<th>Row</th>
									<th class='dt-head-left'>Name</th>
									<th class='dt-head-left'>Side</th>
									<th class='dt-head-left'>Category</th>
									<th class='dt-head-right'># Invited</th>
									<th>Email</th>
									<th class='dt-head-left'>Country</th>
									<th class='dt-head-left'>Printed Invitation Status</th>
									<th class='dt-head-left'>Electronic Invitation Status</th>
									<th class='dt-head-left'>Printed Thank You Card Status</th>
									<th class='dt-head-left'>Electronic Thank You Card Status</th>
									<th>Website Opened</th>
									<th>Invitation Opened</th>
									<th>Song</th>
									<th>Message</th>"
								;
							}
							else{
								echo 
									"<th>Row</th>
									<th class='hidden'>Household</th>
									<th class='dt-head-left'>Name</th>
									<th class='dt-head-left'>Side</th>
									<th class='dt-head-left'>Role</th>
									<th class='dt-head-left'>Email</th>
									<th class='dt-head-left'>Country</th>
									<th class='dt-head-left'>Printed Invitation Status</th>
									<th class='dt-head-left'>Electronic Invitation Status</th>
									<th>Invitation RSVP</th>
									<th>Table Number</th>
									<th>Website Opened</th>
									<th>Invitation Opened</th>"
								;
							}
						?>							
					</tr>
				</thead>
				<tbody>
				<?php
					if($_GET['group'] != '' && $_GET['group'] == 'household'){
						$query="SELECT h.HouseholdID as ID, Household, Side, Category, count(*) as NumberInvited, PrintedInvitationStatus, ElectronicInvitationStatus, PrintedThankYouCardStatus, ElectronicThankYouCardStatus, case when WebsiteOpened = 1 then 'Y' else 'N' end as WebsiteOpened,  case when InvitationOpened = 1 then 'Y' else 'N' end as InvitationOpened, GROUP_CONCAT(if(g.EmailAddress='',null,g.EmailAddress)) as EmailAddress, Country, Song, Artist, replace(Message, '''','') as Message FROM Households h INNER JOIN Guests g ON h.HouseholdID = g.HouseholdID GROUP BY h.HouseholdID, Household, Side, Category, PrintedInvitationStatus, ElectronicInvitationStatus, PrintedThankYouCardStatus, ElectronicThankYouCardStatus, WebsiteOpened, InvitationOpened, Country, Song, Artist, Message ORDER BY h.HouseholdID";
					}
					else{
						$query="SELECT h.HouseholdID, g.GuestID as ID, concat(h.Household,'′s Household - ',Country) as Household, concat(g.Title,' ',g.FirstName,' ',g.LastName) as Name, Side, Role, EmailAddress, Country, PrintedInvitationStatus, ElectronicInvitationStatus, InvitationRSVP, TableNumber, case when WebsiteOpened = 1 then 'Y' else 'N' end as WebsiteOpened, case when InvitationOpened = 1 then 'Y' else 'N' end as InvitationOpened FROM Households h INNER JOIN Guests g ON h.HouseholdID = g.HouseholdID ORDER BY HouseholdID ASC, GuestID ASC";
					}
					
					$result=$db->query($query);
					$rowNumber=1;
					while($row=$result->fetch_assoc()){
						$table="";
				    	$table.="<tr>";
				    	if($_GET['group'] != '' && $_GET['group'] == 'household'){
				    		$table.="<td><input type='checkbox' name='household' class='householdtosend' value='" . $row["ID"] . "'></td>";
				    		$table.="<td class='dt-body-center'>" . $rowNumber . "</td>";
				    		$table.="<td><a href='edit_household.php?hid=" . $row["ID"] . "' class='bondi-blue'>" . $row["Household"] . "</a></td>";
				    		$table.="<td>" . $row["Side"] . "</td>";
				    		$table.="<td>" . $row["Category"] . "</td>";
				    		$table.="<td class='dt-body-right'>" . $row["NumberInvited"] . "</td>";
				    		if($row["EmailAddress"] != ''){
					    		$table.="<td class='dt-body-center icons' title='" .$row["EmailAddress"]. "'><i class='fas fa-envelope fa-fw'></i></td>";
					    	}
					    	else{
					    		$table.="<td class='dt-body-center'>&nbsp;</td>";
					    	}
					    	$table.="<td>" . $row["Country"] . "</td>";		    	
				    		$table.="<td>" . $row["PrintedInvitationStatus"] . "</td>";
					    	$table.="<td>" . $row["ElectronicInvitationStatus"] . "</td>";
					    	$table.="<td>" . $row["PrintedThankYouCardStatus"] . "</td>";
					    	$table.="<td>" . $row["ElectronicThankYouCardStatus"] . "</td>";
					    	$table.="<td class='dt-body-center'>" . $row["WebsiteOpened"] . "</td>";
					    	$table.="<td class='dt-body-center'>" . $row["InvitationOpened"] . "</td>";
					    	if($row["Song"] != ''){
					    		$table.="<td class='dt-body-center icons' title='" .$row["Song"]. " by " .$row["Artist"] ."'><i class='fas fa-music fa-fw'></i></td>";
					    	}
					    	else{
					    		$table.="<td class='dt-body-center'>&nbsp;</td>";
					    	}
					    	if($row["Message"] != ''){
					    		$table.="<td class='dt-body-center icons' title='" .$row["Message"]. "'><i class='fas fa-sticky-note fa-fw'></i></td>";
					    	}
					    	else{
					    		$table.="<td class='dt-body-center'>&nbsp;</td>";
					    	}
				    	}
				    	else{
				    		$table.="<td class='dt-body-center'>" . $rowNumber . "</td>";
				    		$table.="<td>" . $row["Household"] . "</td>";
				    		$table.="<td><a href='edit_guest.php?gid=" . $row["ID"] . "' class='bondi-blue'>" . $row["Name"] . "</a></td>";
				    		$table.="<td>" . $row["Side"] . "</td>";
				    		$table.="<td>" . $row["Role"] . "</td>";			    	
					    	$table.="<td>" . $row["EmailAddress"] . "</td>";
					    	$table.="<td>" . $row["Country"] . "</td>";	
				    		$table.="<td>" . $row["PrintedInvitationStatus"] . "</td>";
					    	$table.="<td>" . $row["ElectronicInvitationStatus"] . "</td>";
					    	$table.="<td class='dt-body-center'>" . $row["InvitationRSVP"] . "</td>";
					    	$table.="<td class='dt-body-center'>" . $row["TableNumber"] . "</td>";
					    	$table.="<td class='dt-body-center'>" . $row["WebsiteOpened"] . "</td>";
					    	$table.="<td class='dt-body-center'>" . $row["InvitationOpened"] . "</td>";
				    	}			    	
				    	$table.="</tr>";
				    	$rowNumber+=1;

				    	echo $table;
				    }
				?>
				</tbody>
			</table>
		</div>

		<?php mysqli_close($db); ?>

		<link href="https://fonts.googleapis.com/css?family=Raleway:500,600" rel="stylesheet">
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script type="text/javascript" src="/js/common.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/cr-1.5.0/fc-3.2.5/fh-3.1.4/r-2.2.2/rg-1.0.3/sl-1.2.6/datatables.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/cr-1.5.0/fc-3.2.5/fh-3.1.4/r-2.2.2/rg-1.0.3/sl-1.2.6/datatables.min.js"></script>

		<?php
			if($_GET['group'] != '' && $_GET['group'] == 'household'){
				$rowGroup="";
			}
			else{
				$rowGroup=",rowGroup: { dataSrc: 1 }";
			}
		?>
		<script>
			$(document).ready(function (){
			    $('.table').DataTable({
			    	paging:false,
			    	fixedHeader:true,
				    orderMulti:true,				   
				    "columnDefs": [
				    	{
			          		"targets": 'no-sort',
			          		"orderable": false,
						},
						{
							"targets": 'hidden',
			                "visible": false
						}
					],
					order: [[ 0, 'asc' ]]
					<?php echo $rowGroup; ?>
			    });
			});
		</script>
	</div>
</body>
</html>