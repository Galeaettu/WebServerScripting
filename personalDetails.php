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
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.10.0/validate.min.js"></script>
		<link rel="stylesheet" href="css/style.css">
		<title>Moth - Edit Details</title>
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
						echo $error;
					}
					?>
				</div>
				<?php
				
			}
			?>
			<div class="jumbotron">
				<div class="container">
					<div class="row">
						<div class="col-sm-9">
							<h1>Edit Personal Details</h1>
						</div>
						<div class="col-sm-3">
							<img src="images/users/galeaettu.jpg" class="img-responsive img-circle" alt="Responsive image">
						</div>
					</div>
					
					
				</div>
			</div>
			<?php 
			if(!empty($errors)){
			?>
			<div class="alert alert-warning" role="alert"><?php echo $errors[0];?></div>
			<?php
			}

			if(!empty($_SESSION)){
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
		    		$image = $data['image'];
			    }
		    }
			?>
			<div>
				<form id="reg_form" class="form-horizontal" action="registrationProcess.php" method="POST" >
					<div class="form-group">
						<label for="firstname" class="col-sm-2 control-label" >First Name:</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $firstname ?>">
						</div>
						<div class="col-sm-5 messages"></div>
					</div>
					<div class="form-group">
						<label for="lastname" class="col-sm-2 control-label">Last Name:</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $lastname ?>">
						</div>
						<div class="col-sm-5 messages"></div>
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-2 control-label">Username:</label>
						<div class="col-sm-5">
							<div class="input-group">
								<span class="input-group-addon">@</span>
								<input type="email" class="form-control" id="username" name="username" placeholder="E-Mail Address" value="<?php echo $username ?>" readonly>
							</div>
						</div>
						<div class="col-sm-5 messages"></div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-2 control-label">Password:</label>
						<div class="col-sm-5">
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>
						<div class="col-sm-5 messages"></div>
					</div>
					<div class="form-group">
						<label for="confirm-password" class="col-sm-2 control-label">Re-Type Password:</label>
						<div class="col-sm-5">
							<input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Re-Type Password">
						</div>
						<div class="col-sm-5 messages"></div>
					</div>
					<div class="form-group">
						<label for="dob" class="col-sm-2 control-label">Date of Birth:</label>
						<div class="col-sm-5">
							<input type="date" class="form-control" id="dob" name="dob" placeholder="YYYY-MM-DD" value="<?php echo $dob ?>">
						</div>
						<div class="col-sm-5 messages"></div>
					</div>
					<div class="form-group">
						<label for="country" class="col-sm-2 control-label">Country:</label>
						<div class="col-sm-5">
							<select class="form-control" name="country" id="country">
								<?php
								$query = "SELECT * FROM tbl_country";			
								$result = mysqli_query($link, $query) or die(mysqli_error($link));
								while ($rowCountry = mysqli_fetch_array($result)){
									if ($rowCountry['id'] == $country){
										$selected = "selected";
									}
									else{
										$selected = "";
									}
									echo "<option ".$selected." value=" .  $rowCountry['id'] . ">" . $rowCountry['country'] . "</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default" id="register" name="register">Update details.</button>
						</div>
					</div>
				</form>
			</div>
			<script>
			    (function() {
		      // Before using it we must add the parse and format functions
		      // Here is a sample implementation using moment.js
		      validate.extend(validate.validators.datetime, {
		        // The value is guaranteed not to be null or undefined but otherwise it
		        // could be anything.
		        parse: function(value, options) {
		          return +moment.utc(value);
		        },
		        // Input is a unix timestamp
		        format: function(value, options) {
		          var format = options.dateOnly ? "YYYY-MM-DD" : "YYYY-MM-DD hh:mm:ss";
		          return moment.utc(value).format(format);
		        }
		      });

		      // These are the constraints used to validate the form
		      var constraints = {
		      	firstname: {
		          // You need to pick a username too
		          presence: true,
		          // And it must be between 3 and 20 characters long
		          length: {
		            minimum: 3
		          },
		          format: {
		            // We don't allow anything that a-z and 0-9
		            pattern: "[a-z]+",
		            // but we don't care if the username is uppercase or lowercase
		            flags: "i",
		            message: "can only contain letters"
		          }
		        },
		        lastname: {
		          // You need to pick a username too
		          presence: true,
		          // And it must be between 3 and 20 characters long
		          length: {
		            minimum: 3
		          },
		          format: {
		            // We don't allow anything that a-z and 0-9
		            pattern: "[a-z]+",
		            // but we don't care if the username is uppercase or lowercase
		            flags: "i",
		            message: "can only contain letters"
		          }
		        },
		        username: {
		          // Email is required
		          presence: true,
		          // and must be an email (duh)
		          email: true
		        },
		        password: {
		          // Password is also required
		          presence: true,
		        },
		        "confirm-password": {
		          // You need to confirm your password
		          presence: true,
		          // and it needs to be equal to the other password
		          equality: {
		            attribute: "password",
		            message: "^The passwords does not match"
		          }
		        },
		        dob: {
		          // The user needs to give a birthday
		          presence: true,
		          // and must be born at least 18 years ago
		          date: {
		            latest: moment().subtract(18, "years"),
		            message: "^You must be at least 18 years old to use this service"
		          }
		        },
		      };

		      // Hook up the form so we can prevent it from being posted
		      var form = document.querySelector("form#reg_form");
		      form.addEventListener("submit", function(ev) {
		        ev.preventDefault();
		        handleFormSubmit(form);
		      });

		      // Hook up the inputs to validate on the fly
		      var inputs = document.querySelectorAll("input, textarea, select")
		      for (var i = 0; i < inputs.length; ++i) {
		        inputs.item(i).addEventListener("change", function(ev) {
		          var errors = validate(form, constraints) || {};
		          showErrorsForInput(this, errors[this.name])
		        });
		      }

		      function handleFormSubmit(form, input) {
		        // validate the form aainst the constraints
		        var errors = validate(form, constraints);
		        // then we update the form to reflect the results
		        showErrors(form, errors || {});
		        if (!errors) {
		          showSuccess();
		        }
		      }

		      // Updates the inputs with the validation errors
		      function showErrors(form, errors) {
		        // We loop through all the inputs and show the errors for that input
		        _.each(form.querySelectorAll("input[name], select[name]"), function(input) {
		          // Since the errors can be null if no errors were found we need to handle
		          // that
		          showErrorsForInput(input, errors && errors[input.name]);
		        });
		      }

		      // Shows the errors for a specific input
		      function showErrorsForInput(input, errors) {
		        // This is the root of the input
		        var formGroup = closestParent(input.parentNode, "form-group")
		          // Find where the error messages will be insert into
		          , messages = formGroup.querySelector(".messages");
		        // First we remove any old messages and resets the classes
		        resetFormGroup(formGroup);
		        // If we have errors
		        if (errors) {
		          // we first mark the group has having errors
		          formGroup.classList.add("has-error");
		          // then we append all the errors
		          _.each(errors, function(error) {
		            addError(messages, error);
		          });
		        } else {
		          // otherwise we simply mark it as success
		          formGroup.classList.add("has-success");
		        }
		      }

		      // Recusively finds the closest parent that has the specified class
		      function closestParent(child, className) {
		        if (!child || child == document) {
		          return null;
		        }
		        if (child.classList.contains(className)) {
		          return child;
		        } else {
		          return closestParent(child.parentNode, className);
		        }
		      }

		      function resetFormGroup(formGroup) {
		        // Remove the success and error classes
		        formGroup.classList.remove("has-error");
		        formGroup.classList.remove("has-success");
		        // and remove any old messages
		        _.each(formGroup.querySelectorAll(".help-block.error"), function(el) {
		          el.parentNode.removeChild(el);
		        });
		      }

		      // Adds the specified error with the following markup
		      // <p class="help-block error">[message]</p>
		      function addError(messages, error) {
		        var block = document.createElement("p");
		        block.classList.add("help-block");
		        block.classList.add("error");
		        block.innerText = error;
		        messages.appendChild(block);
		      }

		      function showSuccess() {
		        // We made it \:D/
		        // alert("Success!");
		        $('#reg_form').submit() 
		      }
		    })();
		</script>	

			<?php include("footer.php"); ?>
		</div>	
	</body>
</html>