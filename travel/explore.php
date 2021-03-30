<?php INCLUDE "../head.php"; ?>
<title>Explore in Tagaytay | Tungpalan - Pajarillo Wedding</title>

<?php
	INCLUDE "../../db_config.php";
	$query="SELECT * FROM ThingsToDo ORDER BY Distance";
	$result=$db->query($query);
?>

<body class="wrapper interior travel-wrapper" id="explore">
	<div class="header-bg">
		<?php INCLUDE "../header.php"; ?>
		<svg class="divider bottom right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon fill="#088db1" points="0,100 100,0 100,100 0,100" />
		</svg>
	</div>

	<div class="banner-wrapper">
		<div class="banner">
			<div class="content-wrapper xs-12">
				<h1 class="align-center underline">Explore</h1>
			</div>
			<svg class="divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
				<polygon fill="#FFFFFF" points="0,0 0,100 100,100 0,0" />
			</svg>
		</div>
	</div>

	<div class="main-content content-wrapper">
		<div class="title-wrapper">
			<h2 class="xs-12 uppercase prussian-blue title"><span>Discover Something New</span></h2> 
			<p class="xs-12 uppercase gray toggle-view-buttons">View as: <a href="javascript:void(0)" class="current button-toggle" data-filter-value=".tiles"><i class="fas fa-th-large"></i></a> <a href="javascript:void(0)" class="button-toggle" data-filter-value=".map"><i class="fas fa-map"></i></a></p>
		</div>
		<p class="xs-12 caption">Take advantage of your weekend getaway by exploring some must-see spots.</p>

		<div class="toggle-view">
			<div class="tiles group toggle-visibility invisible">
				<?php				
					while($row=$result->fetch_assoc()){
						$thumb="../images/explore/" . strtolower(str_replace("'", "", str_replace(" ", "-", $row["Name"]))) . ".jpg";
						$tile="";
				    	$tile.="<div class='tile col xs-12 sm-6 md-4 lg-3'>";
				    	if($row["Website"] != ''){
					    	$tile.="<a href='http://" . $row["Website"] . "' target='_blank' class='link-external'><img src='" . $thumb . "' alt='" . $row["Name"] . "'></a>";
					    }
					    else{
					    	$tile.="<img src='" . $thumb . "' alt='" . $row["Name"] . "'>";
					    }	
					    if($row["ImageSource"] != ''){
					    	$tile.="<span class='disclaimer'>Photo: " . $row["ImageSource"] . "</span>";
					    }
					    else{
					    	$tile.="<span class='disclaimer'>&nbsp;</span>";
					    }		
					    $tile.="<address>";
					    if($row["Website"] != ''){
					    	$tile.="<h3 class='aqua-teal uppercase'><a href='http://" . $row["Website"] . "' target='_blank' class='link-external'>" . $row["Name"] . "</a></h3>";
					    }
					    else{
					    	$tile.="<h3 class='aqua-teal uppercase'>" . $row["Name"] . "</h3>";
					    }
					    $tile.="<span class='street-address'>" . $row["Address"] . "</span>";
					    if($row["Address"] != ''){
					    	$tile.="<br>";
					    }
					    $tile.="<span class='locality'>" . $row["City"] . "</span>, <span class='region'>" . $row["Province"] . "</span>, <span class='postal-code'>" . $row["Zip"] . "</span>";
					    $tile.="</address>";
					    $tile.="<p class='uppercase bondi-blue link-map'><a href='javascript:void(0)' class='bondi-blue' data-lat='" . $row["Latitude"] . "' data-lon='" . $row["Longitude"] . "'>View on map</a> <i class='fas fa-chevron-circle-right' data-fa-transform='shrink-3'></i></p>";
					    $tile.="<p>(" . $row["Distance"] . " km from ceremony venue)</p>";
				    	$tile.="<hr>";
				    	$tile.="<p><span class='Description'>Type:</span> <span class='turquoise-blue'>" . $row["Type"] . "</span></p>";
				    	$tile.="</div>";

				    	echo $tile;
				    }
				?>
			</div>
			<div class="map toggle-visibility xs-12 invisible">
				<iframe src="https://www.google.com/maps/d/embed?mid=1dFFwxrS4q62TtxTh5zTI9h9wZcrhosml&z=13" width="100%" height="646" frameBorder="0" style="border:0; margin-top: -46px;"></iframe></iframe>
			</div>
		</div>

		<?php 
			$url="http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];	
			INCLUDE "related.php"; 
		?>
	</div>
	
	<?php
		mysqli_close($db);
	?>

	<?php INCLUDE "../interior-footer-cta.php"; ?>
	<?php INCLUDE "../footer.php"; ?>
</body>
</html>