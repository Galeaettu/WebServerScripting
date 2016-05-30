<?php
session_start();
include("connection.php");

if(isset($_POST['register'])){
	//if the button is clicked the data is fetched
	$email = $_POST['username'];
	$password = $_POST['password'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$dob = $_POST['dob'];
	$country = $_POST['country'];
	$role = "reg";

	$errors = array();

	$query = "SELECT * FROM tbl_users WHERE username = '$email'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$queryRole= "SELECT role FROM tbl_users WHERE username = '$username'";
	$resultRole = mysqli_query($link, $queryRole) or die(mysqli_error($link));

	if (mysqli_num_rows($resultRole) == 1) {
		$data = mysqli_fetch_array($resultRole);
		$role = $data['role'];
	}


	if (mysqli_num_rows($result) == 1) {
		$errors[] = "Username already registered.";
		$serialized_errors = serialize($errors);
		header("Location: registration.php?errors=$serialized_errors");
	}
	else{
		$password = password_hash($password, PASSWORD_DEFAULT); //hashes the password

		$insertQuery = "INSERT INTO tbl_users (username, password, role, first_name, last_name, dob, country, image) 
		VALUES('$email', '$password', '$role', '$firstname', '$lastname', '$dob', $country, '')";

		$_SESSION['username'] = $email;
		$_SESSION['loginTime'] = date("F j, Y, g:i a"); 
		$_SESSION['role'] = $role;  
		header("Location: index.php");
		mysqli_query($link, $insertQuery) or die(mysqli_error($link)); //executes the query
	}
}
?>