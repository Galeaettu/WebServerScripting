<?php
	$link = mysqli_connect("localhost", "root", "", "christiangalea2ed9s", 3306);
	
	if (mysqli_connect_error()) {
		die("Error connecting to database: ".mysqli_connect_error());
	}
?>
