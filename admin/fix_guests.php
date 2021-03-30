<?php
	INCLUDE "../../db_config.php";

	$query="SELECT GuestID, FirstName from Guests where lastname like ''";
	$result=$db->query($query);
	while($row=$result->fetch_assoc()){
		$name=explode(' ',$row["FirstName"]);
		if(count($name) == 3){
			$update="UPDATE Guests SET FirstName = replace(FirstName, ' " . $name[2] . "', ''), LastName = '". $name[2] . "' WHERE GuestID = " . $row["GuestID"];
			echo $update . "<br>";
			$db->query($update); 
		}
    }
	
	mysqli_close($db);
?>