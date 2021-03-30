<?php INCLUDE "../head.php"; ?>
<title>Guest List Summary | Tungpalan - Pajarillo Wedding</title>

<?php
	INCLUDE "../../db_config.php";
?>

<body class="wrapper interior" id="admin">
	<div class="main-content">
		<header class="content-wrapper align-center">
			<a href="index.php"><img src="/images/logo.png" height="60" alt="Juris & Jewel"></a>
			<h2 class="uppercase">Guest List Summary</h2>
		</header>

		
		<div class="content-wrapper xs-12">
			<h3>RSVP</h3>
			<table class="table display">
				<thead>
					<tr>
						<th class="dt-head-left">Side</th>
						<th class="dt-head-right">Invited</th>
						<th class="dt-head-right">Attending</th>
						<th class="dt-head-right">Not Attending</th>
						<th class="dt-head-right">No Response</th>		
					</tr>
				</thead>
				<?php
					$query="SELECT Side, sum(invited) as Invited, sum(attending) as Attending, sum(notattending) as NotAttending, sum(pending) as Pending from(SELECT Side, 1 as invited, case when InvitationRSVP like 'Attending' then 1 else 0 end as attending, case when InvitationRSVP like 'Declined' then 1 else 0 end as notattending, case when InvitationRSVP like '' or InvitationRSVP is null then 1 else 0 end as pending FROM Households h INNER JOIN Guests g ON h.HouseholdID = g.HouseholdID) as a GROUP BY side ORDER BY side";
					$result=$db->query($query);

					$numbers="<tbody>";
					$invited=0;
					$attending=0;
					$notattending=0;
					$pending=0;
					while($row=$result->fetch_assoc()){
						$numbers.="<tr>";
						$numbers.="<td>" . $row["Side"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["Invited"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["Attending"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["NotAttending"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["Pending"] . "</td>";
						$numbers.="</tr>";

						$invited+=$row["Invited"];
						$attending+=$row["Attending"];
						$notattending+=$row["NotAttending"];
						$pending+=$row["Pending"];
					}
					$numbers.="</tbody>";
					$numbers.="<tfoot>";
					$numbers.="<tr>";
					$numbers.="<td>&nbsp;</td>";
					$numbers.="<td class='align-right'>" . $invited . "</td>";
					$numbers.="<td class='align-right'>" . $attending . "</td>";
					$numbers.="<td class='align-right'>" . $notattending . "</td>";
					$numbers.="<td class='align-right'>" . $pending . "</td>";
					$numbers.="</tr>";
					$numbers.="</tfoot>";

					echo $numbers;
				?>
			</table>

			<h3>Seating Arrangement</h3>
			<table class="table display">
				<thead>
					<tr>
						<th class="dt-head-left">Table Number</th>
						<th class="dt-head-right">Total</th>
					</tr>
				</thead>
				<?php
					$query="SELECT case when TableNumber LIKE '' then 'No table yet' else TableNumber end as TableNumber, count(*) as Total FROM Guests WHERE InvitationRSVP LIKE 'Attending' GROUP BY TableNumber";
					$result=$db->query($query);

					$numbers="<tbody>";
					$totalGuests=0;
					while($row=$result->fetch_assoc()){
						$numbers.="<tr>";
						$numbers.="<td>" . $row["TableNumber"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["Total"] . "</td>";
						$numbers.="</tr>";

						$totalGuests+=$row["Total"];
					}
					$numbers.="</tbody>";
					$numbers.="<tfoot>";
					$numbers.="<tr>";
					$numbers.="<td>&nbsp;</td>";
					$numbers.="<td class='align-right'>" . $totalGuests . "</td>";
					$numbers.="</tr>";
					$numbers.="</tfoot>";

					echo $numbers;
				?>
			</table>

			<h3>Guest Distribution (Invited)</h3>
			<table class="table display">
				<thead>
					<tr>
						<th class="dt-head-left">Category</th>
						<th class="dt-head-right">Bride</th>
						<th class="dt-head-right">Groom</th>
						<th class="dt-head-right">Bride and Groom</th>
					</tr>
				</thead>
				<?php
					$query="SELECT Category, sum(bride) as Bride, sum(groom) as Groom, sum(brideandgroom) as Brideandgroom from(SELECT Category, case when side like 'bride' then 1 else 0 end as bride, case when side like 'groom' then 1 else 0 end as groom, case when side like 'bride and groom' then 1 else 0 end as brideandgroom FROM Households h INNER JOIN Guests g ON h.HouseholdID = g.HouseholdID) as a GROUP BY category ORDER BY category";
					$result=$db->query($query);

					$numbers="<tbody>";
					$bridesGuests=0;
					$groomsGuests=0;
					$brideAndGroomsGuests=0;
					while($row=$result->fetch_assoc()){
						$numbers.="<tr>";
						$numbers.="<td>" . $row["Category"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["Bride"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["Groom"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["Brideandgroom"] . "</td>";
						$numbers.="</tr>";

						$bridesGuests+=$row["Bride"];
						$groomsGuests+=$row["Groom"];
						$brideAndGroomsGuests+=$row["Brideandgroom"];
					}
					$numbers.="</tbody>";
					$numbers.="<tfoot>";
					$numbers.="<tr>";
					$numbers.="<td>&nbsp;</td>";
					$numbers.="<td class='align-right'>" . $bridesGuests . "</td>";
					$numbers.="<td class='align-right'>" . $groomsGuests . "</td>";
					$numbers.="<td class='align-right'>" . $brideAndGroomsGuests . "</td>";
					$numbers.="</tr>";
					$numbers.="</tfoot>";

					echo $numbers;
				?>
			</table>

			<h3>Guest Distribution (Attending)</h3>
			<table class="table display">
				<thead>
					<tr>
						<th class="dt-head-left">Category</th>
						<th class="dt-head-right">Bride</th>
						<th class="dt-head-right">Groom</th>
						<th class="dt-head-right">Bride and Groom</th>
					</tr>
				</thead>
				<?php
					$query="SELECT Category, sum(bride) as Bride, sum(groom) as Groom, sum(brideandgroom) as Brideandgroom from(SELECT Category, case when side like 'bride' then 1 else 0 end as bride, case when side like 'groom' then 1 else 0 end as groom, case when side like 'bride and groom' then 1 else 0 end as brideandgroom FROM Households h INNER JOIN Guests g ON h.HouseholdID = g.HouseholdID WHERE InvitationRSVP like 'Attending' ) as a GROUP BY category ORDER BY category";
					$result=$db->query($query);

					$numbers="<tbody>";
					$bridesGuests=0;
					$groomsGuests=0;
					$brideAndGroomsGuests=0;
					while($row=$result->fetch_assoc()){
						$numbers.="<tr>";
						$numbers.="<td>" . $row["Category"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["Bride"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["Groom"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["Brideandgroom"] . "</td>";
						$numbers.="</tr>";

						$bridesGuests+=$row["Bride"];
						$groomsGuests+=$row["Groom"];
						$brideAndGroomsGuests+=$row["Brideandgroom"];
					}
					$numbers.="</tbody>";
					$numbers.="<tfoot>";
					$numbers.="<tr>";
					$numbers.="<td>&nbsp;</td>";
					$numbers.="<td class='align-right'>" . $bridesGuests . "</td>";
					$numbers.="<td class='align-right'>" . $groomsGuests . "</td>";
					$numbers.="<td class='align-right'>" . $brideAndGroomsGuests . "</td>";
					$numbers.="</tr>";
					$numbers.="</tfoot>";

					echo $numbers;
				?>
			</table>

			<h3>Website Visits (Household)</h3>
			<table class="table display">
				<thead>
					<tr>
						<th class="dt-head-left">Status</th>
						<th class="dt-head-right">Total</th>
						<th class="dt-head-right">Total Sent</th>
						<th class="dt-head-right">Percentage</th>
					</tr>
				</thead>
				<?php
					$query="select sum(STDSent) as STDSent, sum(WebsiteOpened) as WebsiteOpened, sum(InvitationSent) as InvitationSent, sum(InvitationOpened) as InvitationOpened from(
select case when PrintedSTDStatus not like '' OR ElectronicSTDStatus not like '' then 1 else 0 end as STDSent, WebsiteOpened, case when PrintedInvitationStatus not like '' OR ElectronicInvitationStatus not like '' then 1 else 0 end as InvitationSent, InvitationOpened FROM Households) as A";
					$result=$db->query($query);
					$row=$result->fetch_assoc();

					$numbers="<tbody>";
					$numbers.="<tr>";
					$numbers.="<td>Website Opened</td>";
					$numbers.="<td class='dt-body-right'>" . $row["WebsiteOpened"] . "</td>";
					$numbers.="<td class='dt-body-right'>" . $row["STDSent"] . "</td>";
					$numbers.="<td class='dt-body-right'>" . round($row["WebsiteOpened"] / $row["STDSent"] * 100,2) . "</td>";
					$numbers.="</tr>";
					$numbers.="<tr>";
					$numbers.="<td>Invitation Opened</td>";
					$numbers.="<td class='dt-body-right'>" . $row["InvitationOpened"] . "</td>";
					$numbers.="<td class='dt-body-right'>" . $row["InvitationSent"] . "</td>";
					$numbers.="<td class='dt-body-right'>" . round($row["InvitationOpened"] / $row["InvitationSent"] * 100,2) . "</td>";
					$numbers.="</tr>";
					$numbers.="</tbody>";
					$numbers.="<tfoot>";
					$numbers.="<tr>";
					$numbers.="<td colspan='4'>&nbsp;</td>";
					$numbers.="</tr>";
					$numbers.="</tfoot>";

					echo $numbers;
				?>
			</table>

			<h3>Printed STD Status (Household)</h3>
			<table class="table display">
				<thead>
					<tr>
						<th class="dt-head-left">Status</th>
						<th class="dt-head-right">Total</th>
					</tr>
				</thead>
				<?php
					$query="select case when PrintedSTDStatus like 'Hand Delivered' then concat(PrintedSTDStatus,' - ',Country) when PrintedSTDStatus like '' and ElectronicSTDStatus not like '' then 'Electronic Only' when PrintedSTDStatus like '' and Category like 'B-List' then 'Invitation Only' ELSE PrintedSTDStatus end as Status, count(*) as Total from Households group by case when PrintedSTDStatus like 'Hand Delivered' then concat(PrintedSTDStatus,' - ',Country) when PrintedSTDStatus like '' and ElectronicSTDStatus not like '' then 'Electronic Only' when PrintedSTDStatus like '' and Category like 'B-List' then 'Invitation Only' ELSE PrintedSTDStatus end ORDER BY Status";
					$result=$db->query($query);

					$numbers="<tbody>";
					$total=0;
					while($row=$result->fetch_assoc()){
						$numbers.="<tr>";
						$numbers.="<td>" . $row["Status"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["Total"] . "</td>";
						$numbers.="</tr>";
						$total+=$row["Total"];
					}
					$numbers.="</tbody>";
					$numbers.="<tfoot>";
					$numbers.="<tr>";
					$numbers.="<td>&nbsp;</td>";
					$numbers.="<td class='align-right'>" . $total . "</td>";
					$numbers.="</tr>";
					$numbers.="</tfoot>";

					echo $numbers;
				?>
			</table>

			<h3>Electronic STD Status (Household)</h3>
			<table class="table display">
				<thead>
					<tr>
						<th class="dt-head-left">Status</th>
						<th class="dt-head-right">Total</th>
					</tr>
				</thead>
				<?php
					$query="select case when ElectronicSTDStatus like '' and PrintedSTDStatus NOT LIKE '' then 'Printed Only' when ElectronicSTDStatus like '' AND Category like 'B-List' then 'Invitation Only' when ElectronicSTDStatus like '' then 'Not Sent' else ElectronicSTDStatus end as Status, count(*) as Total from Households GROUP BY case when ElectronicSTDStatus like '' and PrintedSTDStatus NOT LIKE '' then 'Printed Only' when ElectronicSTDStatus like '' AND Category like 'B-List' then 'Invitation Only' when ElectronicSTDStatus like '' then 'Not Sent' else ElectronicSTDStatus end ORDER BY Status";
					$result=$db->query($query);

					$numbers="<tbody>";
					$total=0;
					while($row=$result->fetch_assoc()){
						$numbers.="<tr>";
						$numbers.="<td>" . $row["Status"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["Total"] . "</td>";
						$numbers.="</tr>";
						$total+=$row["Total"];
					}
					$numbers.="</tbody>";
					$numbers.="<tfoot>";
					$numbers.="<tr>";
					$numbers.="<td>&nbsp;</td>";
					$numbers.="<td class='align-right'>" . $total . "</td>";
					$numbers.="</tr>";
					$numbers.="</tfoot>";

					echo $numbers;
				?>
			</table>

			<h3>Printed Invitation Status (Household)</h3>
			<table class="table display">
				<thead>
					<tr>
						<th class="dt-head-left">Status</th>
						<th class="dt-head-right">Total</th>
					</tr>
				</thead>
				<?php
					$query="select case when PrintedInvitationStatus like '' and ElectronicInvitationStatus not like '' then 'Electronic Only' ELSE PrintedInvitationStatus end as Status, count(*) as Total from Households group by case when PrintedInvitationStatus like '' and ElectronicInvitationStatus not like '' then 'Electronic Only' ELSE PrintedInvitationStatus end ORDER BY Status";
					$result=$db->query($query);

					$numbers="<tbody>";
					$total=0;
					while($row=$result->fetch_assoc()){
						$numbers.="<tr>";
						$numbers.="<td>" . $row["Status"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["Total"] . "</td>";
						$numbers.="</tr>";
						$total+=$row["Total"];
					}
					$numbers.="</tbody>";
					$numbers.="<tfoot>";
					$numbers.="<tr>";
					$numbers.="<td>&nbsp;</td>";
					$numbers.="<td class='align-right'>" . $total . "</td>";
					$numbers.="</tr>";
					$numbers.="</tfoot>";

					echo $numbers;
				?>
			</table>

			<h3>Electronic Invitation Status (Household)</h3>
			<table class="table display">
				<thead>
					<tr>
						<th class="dt-head-left">Status</th>
						<th class="dt-head-right">Total</th>
					</tr>
				</thead>
				<?php
					$query="select case when ElectronicInvitationStatus like '' and PrintedInvitationStatus NOT LIKE '' then 'Printed Only' when ElectronicInvitationStatus like '' then 'Not Sent' else ElectronicInvitationStatus end as Status, count(*) as Total from Households GROUP BY case when ElectronicInvitationStatus like '' and PrintedInvitationStatus NOT LIKE '' then 'Printed Only' when ElectronicInvitationStatus like '' then 'Not Sent' else ElectronicInvitationStatus end ORDER BY Status";
					$result=$db->query($query);

					$numbers="<tbody>";
					$total=0;
					while($row=$result->fetch_assoc()){
						$numbers.="<tr>";
						$numbers.="<td>" . $row["Status"] . "</td>";
						$numbers.="<td class='dt-body-right'>" . $row["Total"] . "</td>";
						$numbers.="</tr>";
						$total+=$row["Total"];
					}
					$numbers.="</tbody>";
					$numbers.="<tfoot>";
					$numbers.="<tr>";
					$numbers.="<td>&nbsp;</td>";
					$numbers.="<td class='align-right'>" . $total . "</td>";
					$numbers.="</tr>";
					$numbers.="</tfoot>";

					echo $numbers;
				?>
			</table>
		</div>

		<?php mysqli_close($db); ?>

		<link href="https://fonts.googleapis.com/css?family=Raleway:500,600" rel="stylesheet">
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script type="text/javascript" src="/js/common.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/cr-1.5.0/fc-3.2.5/fh-3.1.4/r-2.2.2/rg-1.0.3/sl-1.2.6/datatables.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/cr-1.5.0/fc-3.2.5/fh-3.1.4/r-2.2.2/rg-1.0.3/sl-1.2.6/datatables.min.js"></script>

		<script>
			$(document).ready(function (){
			    $('.table').DataTable({
			    	paging:false,
			    	searching: false,
			    	fixedHeader:true,
			    	info:false,
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
					]
			    });
			});
		</script>
	</div>
</body>
</html>