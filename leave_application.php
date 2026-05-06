<?php
//session 
session_start();

//connection
require("config/connection.php");

//access session value

$full_name = $_SESSION['full_name'];


if (isset($_POST['submit'])) {
	$from_date = trim(mysqli_real_escape_string($connection, $_POST['from_date']));
	$to_date = trim(mysqli_real_escape_string($connection, $_POST['to_date']));
	$leave_type = trim(mysqli_real_escape_string($connection, $_POST['leave_type']));
	$total_days = (strtotime($to_date)-strtotime($from_date))/(60*60*24)+1; //total leave days
	$status = 'Pending'; //status should be pending by-default in db table
	
	//insert data into database
	$insert = "INSERT INTO `leave_application` (`full_name`,`from_date`,`to_date`,`leave_type`,`total_days`,`status`) VALUES ('$full_name', '$from_date', '$to_date', '$leave_type', '$total_days', '$status')";
	$query = mysqli_query($connection, $insert);
	
	//send mail to admin
	$to = "neeleshrawat0916@gmail.com";	
	$sub = "Leave Application";
	$msg = "<!doctype html>
			<html>
				<body>
					<strong>Respected Sir/Madam,</strong>

						I am <strong> $full_name, </strong> a student of Class 9-A. 
						I am unable to attend the class, kindly grant me <strong> $leave_type</strong> from <strong>$from_date</strong> to <strong>$to_date </strong> 
						Thank you,
						Yours faithfully,
						$full_name
				</body>
			</html>
			";
	$headers = "From: neeleshrawat54@gmail.com";
	if(mail($to, $sub, $msg, $headers)){
		echo "<script>alert('Leave application received');</script>";
	}else{
		echo "<script>alert('Something went wrong, Please try again!');</script>";
	}
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>LEAVE APPLICATION</title>
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

								<form method="POST">
									<h4>Leave Application</h4>

									<div class="mb-3">
										<label for="from_date">From Date:</label>
										<input type="date" name="from_date" id="from_date" class="form-control" required>
									</div>

									<div class="mb-3">
										<label for="to_date">To Date:</label>
										<input type="date" name="to_date" id="to_date" class="form-control" required>
									</div>

									<div class="mb-3">
										<label for="leave_type">Leave Purpose:</label>
										<select name="leave_type" id="leave_type" class="form-control" required>
											<option value="">--Select--</option>
											<option value="medical leave">Medical Leave</option>
											<option value="casual leave">Casual Leave</option>
											<option value="sick leave">Sick Leave</option>
											<option value="other">Other</option>
										</select>
									</div>

									<div class="mb-3">
										<button type="submit" name="submit" class="btn-submit">Submit</button>
									</div>
								</form>
							</div>
						</div>
			</div>
		
		
			<!-- FOOTER END -->
			
			<?php
			include("include/footer.php");
			?>
			
			<!-- FOOTER END -->
		</div>

      
    
    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="assets/js/kaiadmin.min.js"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="assets/js/setting-demo2.js"></script>
    <script>
      $("#displayNotif").on("click", function () {
        var placementFrom = $("#notify_placement_from option:selected").val();
        var placementAlign = $("#notify_placement_align option:selected").val();
        var state = $("#notify_state option:selected").val();
        var style = $("#notify_style option:selected").val();
        var content = {};

        content.message =
          'Turning standard Bootstrap alerts into "notify" like notifications';
        content.title = "Bootstrap notify";
        if (style == "withicon") {
          content.icon = "fa fa-bell";
        } else {
          content.icon = "none";
        }
        content.url = "profile.php";
        content.target = "_blank";

        $.notify(content, {
          type: state,
          placement: {
            from: placementFrom,
            align: placementAlign,
          },
          time: 1000,
        });
      });
    </script>
  </body>
</html>
