<?php INCLUDE "head.php"; ?>
<title>Stationery List Summary | Tungpalan - Pajarillo Wedding</title>

<?php
	INCLUDE "../db_config.php";
?>

<body class="wrapper interior" id="admin">
	<div class="main-content">
		<header class="content-wrapper align-center">
			<a href="index.php"><img src="/images/logo.png" height="60" alt="Juris & Jewel"></a>
			<h2 class="uppercase">Stationery List Summary</h2>
		</header>
		
		<div class="content-wrapper xs-12">
			<h3>Printed STD Status (Household)</h3>
			<table class="table display">
				<thead>
					<tr>
						<th class="dt-head-left">Status</th>
						<th class="dt-head-right">Total</th>
					</tr>
				</thead>
				<?php
					$query="SELECT case when PrintedSTDStatus like 'Hand Delivered' then concat(PrintedSTDStatus, ' - ', Country) else PrintedSTDStatus end as Status, count(*) as Total FROM Households WHERE PrintedSTDStatus NOT IN ('', 'To Send', 'Printed') GROUP BY case when PrintedSTDStatus like 'Hand Delivered' then concat(PrintedSTDStatus, ' - ', Country) else PrintedSTDStatus end";
					$result=$db->query($query);

					$numbers="<tbody>";
					while($row=$result->fetch_assoc()){
						$numbers.="<tr>";
						$numbers.="<td class='status'>" . $row["Status"] . "</td>";
						$numbers.="<td class='dt-body-right std'>" . $row["Total"] . "</td>";
						$numbers.="</tr>";
						$total+=$row["Total"];
					}
					$numbers.="</tbody>";

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
					$query="select case when PrintedInvitationStatus like 'Printed' then 'Hand Delivered' ELSE PrintedInvitationStatus end as Status, count(*) as Total from Households WHERE PrintedInvitationStatus NOT LIKE '' group by case when PrintedInvitationStatus like 'Printed' then 'Hand Delivered' ELSE PrintedInvitationStatus end ORDER BY Status";
					$result=$db->query($query);

					$numbers="<tbody>";
					$total=0;
					while($row=$result->fetch_assoc()){
						$numbers.="<tr>";
						$numbers.="<td>" . $row["Status"] . "</td>";
						$numbers.="<td class='dt-body-right invitation'>" . $row["Total"] . "</td>";
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