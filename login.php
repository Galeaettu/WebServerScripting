<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"> -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/style.css">
		<title>Moth - Log In</title>
	</head>
	<body>
		<div class="container">
			<?php include("header.php"); ?>

			<div class="jumbotron">
				<div class="container">
					<h1>Log In</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5 col-md-offset-4">
					<form  class="form-horizontal" action="login.php" method="POST">
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group col-sm-6 col-sm-offset-2">
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-user" aria-hidden="true">
										</span>
									</span>
									<input type="text" class="form-control" id="username" name="username" placeholder="E-Mail Address">
								</div>
							</div>
							<div class="col-sm-5 messages"></div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group col-sm-6 col-sm-offset-2">
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-lock" aria-hidden="true">
										</span>
									</span>
									<input type="password" class="form-control" id="password" name="password" placeholder="Password">
								</div>
							</div>
							<div class="col-sm-5 messages"></div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group col-sm-6 col-sm-offset-4">
									<button type="submit" class="btn btn-default" id="login" name="login">Log In.</button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<?php
					if (isset($_POST['login'])) {
					$username = $_POST['username'];
					$password = $_POST['password'];
					
					$errors = array();
					
					if (empty($username)) {
						$errors[] = "Username required";
					}
					// else if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
					// 	$errors[] = "Invalid email address";
					// }
					
					if (empty($password)) {
						$errors[] = "Please enter a password";
					}

					if(count($errors) == 0){
						$query = "SELECT * FROM tbl_users WHERE username='$username'";
						$result = mysqli_query($link, $query) or die(mysqli_error($link));

						if (mysqli_num_rows($result) == 1) {
							$data = mysqli_fetch_array($result);
							$password_hash_in_db = $data['password'];
							
							if (password_verify($password, $password_hash_in_db)) {
								$_SESSION['username'] = $username;
								$_SESSION['loginTime'] = date("F j, Y, g:i a");   
								header("Location: index.php");
							}
							//the email provided is correct however the password provided is incorrect
							else {
								$errors[] = "Username and/or password incorrect";
							
								$serialized_errors = serialize($errors);
								header("Location: index.php?errors=$serialized_errors");
							}
						}
						else {
							$errors[] = "Username and/or password incorrect";
							
							$serialized_errors = serialize($errors);
							header("Location: index.php?errors=$serialized_errors");
						}
					}
					else {
						$serialized_errors = serialize($errors);
						header("Location: index.php?errors=$serialized_errors");
					}
				}
				?>
			</div>
			<?php include("footer.php"); ?>
		</div>	
	</body>
</html>