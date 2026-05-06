<?php
//session
session_start();

//connection
require("config/connection.php");

//alert message if user registered
if(isset($_GET['login'])){
	if($_GET['login'] == 1);
	echo "<script>alert('Registered Successfully');</script>";	
}

//alert message if user logout
if(isset($_GET['logout'])){
	if($_GET['logout'] == 1);
	echo "<script>alert('You are logged out');</script>";
}

//check form submission
if(isset($_POST['submit'])){
	$email = trim(mysqli_real_escape_string($connection, $_POST['email']));
	$password = md5($_POST['password']);
	$role = trim(mysqli_real_escape_string($connection, $_POST['role']));

//search for email and password row in table
$select = "SELECT * FROM `school` WHERE email='$email' AND password = '$password' AND role = '$role'";
$run = mysqli_query($connection, $select);

//check if details exist
	if(mysqli_num_rows($run) == 1){
	$user = mysqli_fetch_array($run);

	//store session value
	$_SESSION['email'] = $user['email'];
	$_SESSION['password'] = $user['password'];
	$_SESSION['role'] = $user['role'];
	
	//redirect to profile page
	header("location: index.php?user=1");
	}else{
		echo "<script>alert('Invalid input field');</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>FORMS</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["	assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="assets/css/demo.css" />
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
     
	  
      <!-- End Sidebar -->

			<div class="main-panel">
				
						<!-- Start Navbar -->
						
					  <!-- End Navbar -->
					
				
					<div class="content">
					  <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
						<div class="col-md-5">
						  <div class="card">
							<div class="card-header text-center">
							  <h4 class="card-title">Login</h4>
							</div>
							<div class="card-body">
							  <form method="POST">
								<div class="form-group">
								  <label for="email">Email Address</label>
								  <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
								</div>
								<div class="form-group">
								  <label for="password">Password</label>
								  <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
								</div>
								<div class="form-group">
								  <label for="role">Select Role</label>
								  <select class="form-control" id="role" name="role" required>
									<option value="" disabled selected>Select your role</option>
									<option value="admin">Admin</option>
									<option value="teacher">Teacher</option>
									<option value="student">Student</option>
								  </select>
								</div>


								<!-- Show Password Checkbox -->
								<div class="form-group form-check">
								  <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePassword()">
								  <label class="form-check-label" for="showPassword">Show Password</label>
								</div>

								<div class="form-group d-flex justify-content-between">
								  <a href="forgot_password.php">Forgot Password?</a>
								  <a href="register.php">Not registered? Sign up</a>
								</div>

								<div class="form-group text-center">
								  <button type="submit" class="btn btn-primary btn-block" name="submit">Login</button>
								</div>
							  </form>
							</div>
						  </div>
						</div>
					  </div>
					</div>
			</div>
			
			<!--   Core JS Files   -->
			
	<!-- show passord -->
	<script>
		function togglePassword(){
			var x =	document.getElementById("password");
		if(x.type === "password"){
			x.type = "text";
		}else{	
			x.type="password";
		}
	}
	</script>
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Google Maps Plugin -->
    <script src="assets/js/plugin/gmaps/gmaps.js"></script>

    <!-- Sweet Alert -->
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="assets/js/setting-demo2.js"></script>
  </body>
</html>

