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
		<title>Moth - Profile</title>
	</head>
	<body>
		<div class="container">
			<?php include("header.php");

			?>
			<?php 			
			if (isset($_GET['errors'])){
				$errors = unserialize($_GET['errors']);
				
			?>
				<div class="alert alert-warning" role="alert">
					<?php foreach ($errors as $error) {
						echo "<p class='text-center'>".$error."</p>";
					}
					?>
				</div>
				<?php
				
			}

			if(!empty($_SESSION) && ($_SESSION['role'] == "reg")){
				$username = $_SESSION['username'];
				$query= "SELECT * FROM tbl_users WHERE username = '$username'";
		    	$result = mysqli_query($link, $query) or die(mysqli_error($link));

		    	if (mysqli_num_rows($result) == 1) {
		    		$data = mysqli_fetch_array($result);

		    		$username = $data['username'];
		    		$password = $data['password'];
		    		$firstname = $data['first_name'];
		    		$lastname = $data['last_name'];
		    		$dob = $data['dob'];

		    		$country = $data['country'];
		    		$countryQuery = "SELECT country from tbl_country WHERE id = $country";
		    		$resultCountry = mysqli_query($link, $countryQuery) or die(mysqli_error($link));
		    		$countryRow = mysqli_fetch_array($resultCountry);
		    		$country = $countryRow[0];

		    		$image = $data['image'];
		    		if(empty($image)){
		    			$image = "images/users/blank.jpg";
		    		}
			    }
			}
			else
			{
				$errors[] = "You must be logged in as a customer to access your profile.";
				$serialized_errors = serialize($errors);
				header("Location: index.php?errors=$serialized_errors");
			}
			?>
			<div class="jumbotron">
				<div class="container">
					<h1>Profile Page</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="col-sm-12">
						<div class= "panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title text-center"><?php echo $firstname." ".$lastname;?></h3>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-12">
										<div class="row">
											<div class="col-md-3">
												<img width="100px" height="100px" src="<?php echo $image;?>" class="img-responsive img-circle" alt="Responsive image">
											</div>
											<div class="col-md-9">
												<div class="col-sm-12">
													<div class="col-sm-6">
														<p><b>First Name:</b></p>
													</div>
													<div class="col-sm-6">
														<?php echo $firstname; ?>
													</div>
												</div>
												<div class="col-sm-12">
													<div class="col-sm-6">
														<p><b>Last Name:</b></p>
													</div>
													<div class="col-sm-6">
														<?php echo $lastname; ?>
													</div>
												</div>
												<div class="col-sm-12">
													<div class="col-sm-6">
														<p><b>Username:</b></p>
													</div>
													<div class="col-sm-6">
														<?php echo $username; ?>
													</div>
												</div>
												<div class="col-sm-12">
													<div class="col-sm-6">
														<p><b>Date of Birth:</b></p>
													</div>
													<div class="col-sm-6">
														<?php echo $dob; ?>
													</div>
												</div>
												<div class="col-sm-12">
													<div class="col-sm-6">
														<p><b>Country:</b></p>
													</div>
													<div class="col-sm-6">
														<?php echo $country; ?>
													</div>
												</div>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php include("footer.php"); ?>
		</div>	
	</body>
</html>