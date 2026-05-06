<?php
//connection
require("config/connection.php");

// Check if the form was submitted
if(isset($_POST['submit'])){
	
// Collect form data safely
$full_name = trim(mysqli_real_escape_string($connection, $_POST['full_name']));
$email = trim(mysqli_real_escape_string($connection, $_POST['email']));
$phone = trim(mysqli_real_escape_string($connection, $_POST['phone']));
$address = trim(mysqli_real_escape_string($connection, $_POST['address']));
$subject_specialization = trim(mysqli_real_escape_string($connection, $_POST['subject_specialization']));
$qualification = trim(mysqli_real_escape_string($connection, $_POST['qualification']));
$experience = trim(mysqli_real_escape_string($connection, $_POST['experience']));

// Handle image upload
$profile_img = $_FILES['profile_image']['name'];
$tempname = $_FILES['profile_image']['tmp_name'];
$folder = "./img/" .$profile_img;

// Move uploaded file to the uploads directory
move_uploaded_file($tempname, $folder);

$password = md5($_POST['password']);


 // Prepare SQL Insert Statement
 $insert = "INSERT INTO `school`(`full_name`, `email`, `phone`, `address`, `subject_specialization`, `qualification`, `experience`, `profile_img`, `password`)
					VALUES ('$full_name', '$email', '$phone', '$address', '$subject_specialization', '$qualification', '$experience', '$folder', '$password')";
	$query = mysqli_query($connection, $insert);
	
	
	 if ($query) {
            // Send confirmation email
            $to = $email;
            $subject = "You are registered successfully";
            $message = "
                Hi $full_name,<br><br>
                You have been registered successfully.<br>
                <strong>Username:</strong> $email<br>
                <strong>Password:</strong> $password<br><br>
                Click <a href='http://samaandekho.com/login.php'>here</a> to login.
            ";
            $headers .= "From: neeleshrawat54@gmail.com";

		if(mail($to, $subject, $message, $headers)){

            echo "<script>alert('Registered, confirmation mail sent on your mail address')";
        } else {
            echo "<script>alert('Something went wrong, Please try again!');</script>";
        }
	
	//redirect to login page
	header("location: login.php?login=1");
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
    
		<div class="content ">
		  <div class="page-inner">
			<div class="page-header">
			  <h4 class="page-title"></h4>
			</div>
			<div class="row justify-content-center">
			  <div class="col-md-8">
				<div class="card">
				  <div class="card-header">
					<div class="card-title">New Registration</div>
				  </div>
				  <div class="card-body">
					<form action="register.php" method="POST" enctype="multipart/form-data">
					  <div class="form-group">
						<label for="fullName">Full Name</label>
						<input type="text" class="form-control" id="fullName" name="full_name" required>
					  </div>
					  <div class="form-group">
						<label for="email">Email Address</label>
						<input type="email" class="form-control" id="email" name="email" required>
					  </div>
					  <div class="form-group">
						<label for="phone">Phone Number</label>
						<input type="text" class="form-control" id="phone" name="phone" required>
					  </div>
					  <div class="form-group">
						<label for="address">Address</label>
						<textarea class="form-control" id="address" name="address" rows="3" required></textarea>
					  </div>
					  <div class="form-group">
						<label for="subject">Subject Specialization</label>
						<input type="text" class="form-control" id="subject" name="subject_specialization" required>
					  </div>
					  <div class="form-group">
						<label for="qualification">Qualification</label>
						<input type="text" class="form-control" id="qualification" name="qualification" required>
					  </div>
					  <div class="form-group">
						<label for="experience">Experience (in years)</label>
						<input type="number" class="form-control" id="experience" name="experience" min="0" required>
					  </div>
					  <div class="form-group">
						<label for="profileImage">Profile Photo</label>
						<input type="file" class="form-control-file" id="profileImage" name="profile_image" accept="image/*" required>
					  </div>
					  <div class="form-group">
						<label for="password">Set Password</label>
						<input type="password" class="form-control" id="password" name="password" required>
					  </div>
					  <div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">Register</button>
					  </div>
					</form>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>

	  </div>
	  
	  <!-- FORM End-->

        
    <!--   Core JS Files   -->
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
