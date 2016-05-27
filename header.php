<?php include("connection.php"); ?>
<div class="page-header">
	<h1>Moth <small>Clothing for the masses</small></h1>
</div>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
	      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
	     	</button>
	      	<a class="navbar-brand" href="index.php">Home</a>
	    </div>

	    <?php
	    if(empty($_SESSION)){

	    }
	    $query= "SELECT role FROM tbl_users WHERE username = ''";
	    ?>

	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    	<ul class="nav navbar-nav">
	    		<li><a href = "products.php">Products</a></li>
	    		<?php
			    if(!empty($_SESSION)){
			    	$username = $_SESSION['username'];
			    	$query= "SELECT role FROM tbl_users WHERE username = '$username'";
			    	$result = mysqli_query($link, $query) or die(mysqli_error($link));#

			    	if (mysqli_num_rows($result) == 1) {
			    		$data = mysqli_fetch_array($result);
			    		$role = $data['role'];
			    		if($role == "reg"){
				    		?>
				    		<li class="dropdown">
				    			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Personal Profile <span class="caret"></span></a>
				    			<ul class="dropdown-menu">
				    				<li><a href="wishlist.php">Products added to list</a></li>
				    				<li><a href="personalDetails.php">Edit personal details</a></li>
				    			</ul>
				    		</li>
				    	<?php
				    	}
				    }
			    }
			    ?>
	    		
	    		<li><a href = "contactUs.php">Contact Us</a></li>
	    		<?php
			    if(!empty($_SESSION)){
			    	$username = $_SESSION['username'];
			    	$query= "SELECT role FROM tbl_users WHERE username = '$username'";
			    	$result = mysqli_query($link, $query) or die(mysqli_error($link));#

			    	if (mysqli_num_rows($result) == 1) {
			    		$data = mysqli_fetch_array($result);
			    		$role = $data['role'];
			    		if($role == "admin"){
				    		?>
				    		<li class="dropdown">
				    			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
				    			<ul class="dropdown-menu">
				    				<li><a href="deleteUser.php">Delete users</a></li>
				    				<li><a href="errorLog.php">Error log</a></li>
				    				<li><a href="statistics.php">Statistics</a></li>
				    				<li><a href="comments.php">Comments</a></li>
				    			</ul>
				    		</li>
				    	<?php
				    	}
				    }
			    }
			    ?>
	    		<?php
			    if(empty($_SESSION)){
			    ?>
	    		<li><a href = "login.php">Log In</a></li>
	    		<?php
		    	}else{
		    	?>
	    		<li><a href = "logout.php">Log Out</a></li>
	    		<?php } ?>
	    	</ul>
	    </div>
	</div>
</nav>