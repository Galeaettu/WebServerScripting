<?php
session_start();
if (isset($_POST['update'])) {
	$password = $_POST['password'];
	$username = $_POST['username'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$dob = $_POST['dob'];
	$country = $_POST['country'];
	$role = "reg";

	$errors = array();
	$messages = array();

		//get tmp file name (already uploaded by php)
	$tmp_name = $_FILES['image']['tmp_name'];
	
	//define upload path (images folder/original name of file)
	$upload_path = "images/".$_FILES['image']['name'];
	
	//get file extension
	$ext = pathinfo($upload_path, PATHINFO_EXTENSION);
	
	//upload only if file extension is jpg, png, jpeg or gif...
	if ($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif") {
		//function move temporarily uploaded file to your upload path
		if (move_uploaded_file($tmp_name, $upload_path)) {
			require("connection.php");

			$password = password_hash($password, PASSWORD_DEFAULT);
		
			$update_sql = "UPDATE tbl_users SET password = '$password', first_name = '$firstname', last_name = '$lastname', dob = '$dob', country = $country, image='$upload_path' WHERE username='$username'";
			mysqli_query($link, $update_sql) or die(mysqli_error($link));
			
			if (mysqli_affected_rows($link) == 1) {
				$messages[] = "You have a new profile picture!";
			}
			
			$messages[] = "File uploaded successfully!";
		}
		else {
			$errors[] = "File not uploaded...";
		}
	}
	else {
		$errors[] = "Sorry, your file type is not accepted.";
	}
	if (!empty($messages)){
		$serialized_messages = serialize($messages);
		header("Location: personalDetails.php?messages=$serialized_messages");
	}
	if (!empty($errors)){
		$serialized_errors = serialize($errors);
		header("Location: personalDetails.php?errors=$serialized_errors");
	}	
}