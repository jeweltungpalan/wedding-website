<hr>
		
<p class="align-center uppercase border-arrow">View more</p>
<div class="group related">
	<?php
		if(strpos($url,"stay") == false){
			$related="";
			$related.="<a href='stay.php' class='box col xs-12 sm-6'>";
			$related.="<div class='col xs-12 sm-5'>";
			$related.="<div class='figure-wrapper'>";
			$related.="<figure>";
			$related.="<img src='../images/travel-stay.jpg' alt>";
			$related.="</figure>";
			$related.="</div>";
			$related.="</div>";
			$related.="<div class='col xs-12 sm-7'>";
			$related.="<h3 class='aqua-teal uppercase'>Stay</h3>";
			$related.="<p>Search where you can recharge after the party.</p>";
			$related.="<span class='button-circle'><i class='fas fa-chevron-right'></i></span>";
			$related.="</div>";
			$related.="</a>";

			echo $related;
		} 
		if(strpos($url,"eat") == false){
			$related="";
			$related.="<a href='eat.php' class='box col xs-12 sm-6'>";
			$related.="<div class='col xs-12 sm-5'>";
			$related.="<div class='figure-wrapper'>";
			$related.="<figure>";
			$related.="<img src='../images/travel-eat.jpg' alt>";
			$related.="</figure>";
			$related.="</div>";
			$related.="</div>";
			$related.="<div class='col xs-12 sm-7'>";
			$related.="<h3 class='aqua-teal uppercase'>Eat</h3>";
			$related.="<p>Try out recommended places to get grub.</p>";
			$related.="<span class='button-circle'><i class='fas fa-chevron-right'></i></span>";
			$related.="</div>";
			$related.="</a>";

			echo $related;
		}
		if(strpos($url,'explore') == false){
			$related="";
			$related.="<a href='explore.php' class='box col xs-12 sm-6'>";
			$related.="<div class='col xs-12 sm-5'>";
			$related.="<div class='figure-wrapper'>";
			$related.="<figure>";
			$related.="<img src='../images/travel-explore.jpg' alt>";
			$related.="</figure>";
			$related.="</div>";
			$related.="</div>";
			$related.="<div class='col xs-12 sm-7'>";
			$related.="<h3 class='aqua-teal uppercase'>Explore</h3>";
			$related.="<p>Discover what's on the ridge the next day.</p>";
			$related.="<span class='button-circle'><i class='fas fa-chevron-right'></i></span>";
			$related.="</div>";
			$related.="</a>";

			echo $related;
		}
	?>
</div>