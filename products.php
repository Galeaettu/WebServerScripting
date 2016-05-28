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
		<title>Moth - Products</title>
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
					<h1>Products</h1>
				</div>
			</div>

			<div class="row">
			<?php
			$query = "SELECT * FROM tbl_products";
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			while ($userProduct = mysqli_fetch_array($result)){
				$product = $userProduct['product'];
				$prodId = $userProduct['id'];
				if (!empty($_SESSION)){
					$wishLink = "wishlist.php?id=$prodId";
					$wishModal = "";
				}
				else{
					$wishLink ="#";
					$wishModal = "data-toggle='modal' data-target='#myModal'";
				}
			?>	
				<div class="col-sm-6 col-md-4">
				    <div class="thumbnail">
				        <img src="images/products/<?php echo $prodId; ?>.jpg" alt="...">
					    <div class="caption">
						    <h3 class="text-center"><?php echo $product;?></h3>
						    <p class="text-center"><a href="<?php echo $wishLink; ?>" class="btn btn-success" role="button" <?php echo $wishModal; ?>>Add to Wishlist</a></p>
						</div>
					</div>
				</div>
			<?php 
			}
			?>
			</div>

			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			    <div class="modal-dialog modal-sm" role="document">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                <h4 class="modal-title" id="myModalLabel">Customers Only</h4>
			            </div>
			            <div class="modal-body">
			                <p>You must be logged in to add a product to your wishlist.</p>
			                <p>New customer? <a class="btn btn-primary btn-sm text-center" href="registration.php" role="button">Register Now!</a></p>			                
			            </div>
			            <div class="modal-footer">
			                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			            </div>
			        </div>
			    </div>
			</div>

			<?php include("footer.php"); ?>
		</div>	
	</body>
</html>