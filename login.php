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
					<form  class="form-horizontal" action="loginProcess.php" method="POST">
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group col-sm-6 col-sm-offset-2">
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-user" aria-hidden="true">
										</span>
									</span>
									<input type="email" class="form-control" id="username" name="username" placeholder="E-Mail Address">
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
			</div>

			<?php
			if (!isset($_SESSION['username'])) {
			?>
			<form action="loginProcess.php" method="post">
				Email: <input type="email" name="email" />
				<br/><br/>
				Password: <input type="password" name="password" />
				<br/><br/>
				<input type="submit" name="submit_btn" value="Login" />
			</form>
			<?php 
			} else {
				echo "Welcome! You are logged in as ".$_SESSION['username'];
				echo "<hr/>";
				?>
				<a href="logout.php"><button>Logout</button></a>
			<?php
			}  
			?>

			<?php include("footer.php"); ?>
		</div>	
	</body>
</html>