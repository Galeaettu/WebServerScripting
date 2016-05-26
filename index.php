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
		<title>Moth Clothing</title>
	</head>
	<body>
		<div class="container">
			<?php include("header.php");

			if (isset($_SESSION)) { 
			?>
			<div class="well well-sm">
				<h5 class="text-center">Logged in as <b><?php echo $_SESSION['username']; ?></b> at <?php echo $_SESSION['loginTime']; ?></h5>
			</div>
			<?php 			
			}
			if (isset($_GET['errors'])){
				$errors = unserialize($_GET['errors']);
				
			?>
				<div class="alert alert-warning" role="alert">
					<?php foreach ($errors as $error) {
						echo $error;
					}
					?>
				</div>
				<?php
				
			}
			?>

			<?php include("footer.php"); ?>
		</div>	
	</body>
</html>