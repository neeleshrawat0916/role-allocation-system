<?php
//session
session_start();

//connection
require("config/connection.php");

//POP UP alert
if(isset($_GET['user'])){
	if($_GET['user'] == 1);
	echo "<script>alert('Login successfully');</script>";
}
// Check if user is logged in
   if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
      header("Location: login.php");
      exit;
   }
	
	$role = $_SESSION['role']; //access session data
	$email = $_SESSION['email']; //access session data
	$password = $_SESSION['password']; //access session data
	


// Get user from database
$select = "SELECT * FROM school WHERE role = '$role' AND email = '$email' AND password = '$password'";
$query = mysqli_query($connection, $select);


$user = mysqli_fetch_array($query);

		// display the latest leave of logged in student
		$user['latest_leave_date'] = 'N/A'; // default value

		if ($user['role'] == 'student') {
			$full_name = $user['full_name'];
			$leave_query = "SELECT from_date FROM leave_application WHERE full_name = '$full_name' AND `status` = 'approved' ORDER BY from_date DESC LIMIT 1";
			$leave_result = mysqli_query($connection, $leave_query);

			if ($leave_result && mysqli_num_rows($leave_result) > 0) {
				$leave_row = mysqli_fetch_array($leave_result);
				$user['latest_leave_date'] = $leave_row['from_date'];
			} else {
				$user['latest_leave_date'] = 'No recent leave found';
			}
		}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>SCHOOL</title>
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
          urls: ["assets/css/fonts.min.css"],
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
      <?php 
	  include("include/sidebar.php");
	  ?>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
         
          <!-- Navbar Header -->
          <?php
		  include("include/header.php");	
		  ?>
          <!-- End Navbar -->
        </div>

        <div class="container">
			<div class="page-inner">
				<div class="mt-5 mx-auto" style="max-width: 800px;">
					<h3 class="text-light text-center">USER DETAILS</h3>
					
						<div class="text-center mb-4">
						  <img src="<?php echo $user['profile_img']; ?>" class="rounded-circle" width="150" height="150" alt="Profile Image">
						</div>
						<table class="table table-bordered text-center">
							
								<tr><th>Role</th> <td><?php echo $user['role']?></td></tr>
								<tr><th>Name</th> <td><?php echo $user['full_name']?></td></tr>
								<tr><th>Phone Number</th> <td><?php echo $user['phone']?></td></tr>
								<tr><th>Email Id</th> <td><?php echo $user['email']?></td></tr>
								<tr><th>Qualification</th> <td><?php echo $user['qualification']?></td></tr>
								<tr><th>Address</th> <td><?php echo $user['address']?></td></tr>
								<tr><th>Latest Leave</th> <td><?php echo $user['latest_leave_date']?></td></tr>
								
						</table>
				
				</div>
			</div>
		</div>