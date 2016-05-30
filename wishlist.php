<?php
session_start();

if(isset($_GET['id'])){
	$productId = $_GET['id'];
	$username = $_SESSION['username'];
	$messages = array();
	$errors = array();
	require("connection.php");

	$query = "INSERT INTO tbl_wishlist(username, product) VALUES ('$username', $productId)";
	$result = mysqli_query($link, $query) ;
	if (mysqli_affected_rows($link) == 1)  {
		$messages[] = "Product has been added to the wishlist!";
		$serialized_messages = serialize($messages);
		header("Location: products.php?messages=$serialized_messages");
	}
	else{
		$errors[] ="Product was not added to wishlist, It may already be there.";
		$serialized_errors = serialize($errors);
		header("Location: products.php?errors=$serialized_errors");
	}
}

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
		<title>Moth - Wishlist</title>
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
						echo "<p class='text-center'>".$error."<p>";
					}
					?>
				</div>
				<?php
				
			}
			?>
			<div class="jumbotron">
				<div class="container">
					<h1>Wishlist</h1>
				</div>
			</div>
			<div>
				<?php
				if(!empty($_SESSION))
				{
					$username = $_SESSION['username'];
				?>
				<table class="table table-striped table-hover">
					<tr>
						<th>Product</th>
						<th></th>
						<th></th>
					</tr>
					<?php
					$query = "SELECT tbl_products.product AS productName, tbl_products.id AS prodID FROM tbl_products INNER JOIN tbl_wishlist ON tbl_products.id = tbl_wishlist.id WHERE tbl_wishlist.username = '$username'";
					$result = mysqli_query($link, $query) or die(mysqli_error($link));

					while ($productRow = mysqli_fetch_array($result)){
						$product = $productRow['productName'];
					?>
					<tr>
						<td><img width="60px" src="images/products/<?php echo $productRow['prodID'];?>.jpg" class="img-thumbnail"></td>
						<td><h3><?php echo $product;?></h3></td>
						<td></td>
					</tr>
					<?php
					}
					?>
				</table>
				<?php
				}
				else{
					$errors[] = "You must be logged in to access the wishlist.";
					$serialized_errors = serialize($errors);
					header("Location: index.php?errors=$serialized_errors");
				}
				?>
			</div>

			<?php include("footer.php"); ?>
		</div>	
	</body>
</html>