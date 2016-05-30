<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-migrate-1.3.0.min.js"></script>
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"> -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/style.css">
		<title>Moth - Delete Users</title>
	</head>
	<body>
		<div class="container">
			<?php include("header.php");

			?>
			<?php 
			//gets the errors or messages and displays them
			if (isset($_GET['errors'])){
				$errors = unserialize($_GET['errors']);
				
			?>
				<div class="alert alert-warning" role="alert">
					<?php foreach ($errors as $error) {
						echo "<p class='text-center'>".$error."<p>";
					}
					?>
				</div>
				<?php
			}

			if(isset($_GET['id'])){
				$deleteUsername = $_GET['id'];
				$deleteUsername = mysqli_real_escape_string($link, $deleteUsername);

				//deletes the user when the button is clicked
				$queryDelete = "DELETE FROM tbl_users WHERE username = '$deleteUsername'";
				mysqli_query($link, $queryDelete);

				//checks if user was deleted
				if (mysqli_affected_rows($link) == 1) {
					header("Location:?user_deleted=yes");
				}
				else {
					header("Location:?user_deleted=no");
				}
			}

			if(isset($_GET['user_deleted'])){
				$deleteMessage = $_GET['user_deleted'];

				if($deleteMessage == 'yes'){
					//displays a message according to the 'user_deleted' GET variable
				?>
				<div class="alert alert-success" role="alert">
					<p class="text-center">User deleted successfully!</p>
				</div>
				<?php
				}
				else{
				?>
				<div class="alert alert-warning" role="alert">
					<p class="text-center">User was not deleted!</p>
				</div>
				<?php
				}
			}
			if($_SESSION['role'] != "admin"){
				$errors = array();
				// var_dump($_SESSION['role']);
				//This was used to show what the role of the user logged in was
				$errors[] = "You must be logged in as admin to delete users.";
				//passing serialized errors to be displayed in the index page
				$serialized_errors = serialize($errors);
				header("Location: index.php?errors=$serialized_errors");
			}
			?>

			<div class="jumbotron">
				<div class="container">
					<h1>Delete Users</h1>
				</div>
			</div>

			<div>
				<table class="table table-striped table-hover">
					<tr>
						<th>Username</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Date of Birth</th>
						<th>Country</th>
						<th>Delete</th>
					</tr>
					<?php
					$query = "SELECT * from tbl_users WHERE username <> 'admin'";
					$result = mysqli_query($link, $query) or die(mysqli_error($link));

					while ($userRow = mysqli_fetch_array($result)){
						$username = $userRow['username'];
			    		$firstname = $userRow['first_name'];
			    		$lastname = $userRow['last_name'];
			    		$dob = $userRow['dob'];

			    		//gets the country name
			    		$country = $userRow['country'];
			    		$countryQuery = "SELECT country from tbl_country WHERE id = $country";
			    		$resultCountry = mysqli_query($link, $countryQuery) or die(mysqli_error($link));
			    		$countryRow = mysqli_fetch_array($resultCountry);
			    		$country = $countryRow[0];
					?>
					<tr>
						<td><?php echo $username;?></td>
						<td><?php echo $firstname;?></td>
						<td><?php echo $lastname;?></td>
						<td><?php echo $dob;?></td>
						<td><?php echo $country;?></td>
						<td>
							<a href="?id=<?php echo $username; ?> "class='btn btn-danger btn-sm' role='button'> Delete
								<span class='glyphicon glyphicon-trash'>
								</span>
							</a>
							<?php
							?>
						</td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>

			<?php include("footer.php"); ?>
		</div>	
	</body>
</html>