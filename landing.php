<?php
	INCLUDE "../db_config.php";

	if($_GET["medium"] == 'email' && $_GET["campaign"] == 'savethedate'){
		// update status

		$redirect="http://" . $_SERVER['HTTP_HOST'] . "/";
		header("Location: " . $redirect);
	}
?>