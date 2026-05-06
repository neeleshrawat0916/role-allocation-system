<?php
session_start();

//connection
require("config/connection.php");


if (isset($_POST['assign'])) {
    $id = trim(mysqli_real_escape_string($connection, $_POST['id']));
    $role = trim(mysqli_real_escape_string($connection, $_POST['role']));
   
	
	// Validate role
    $allowed_roles = ['student', 'teacher', 'admin'];
	
	//update role in view table
$update = "UPDATE `school` SET role = '$role' WHERE id = '$id'";
$query = mysqli_query($connection, $update);

if($query){
	echo "<script>alert('Role assigned successfully');</script>";
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

			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<div class="container py-5">
		<div class="page-inner bg-light p-4 rounded shadow-sm">

			<h2 class="mb-4 text-center">Assign Role to User</h2>

			<form method="POST" action="" class="row g-3">

				<div class="col-md-6">
					<label for="userSelect" class="form-label">Select User</label>
					<select id="userSelect" name="id" class="form-select" required>
						<option selected disabled>Select User</option>
						<?php
						$get = "SELECT * FROM school";
						$query = mysqli_query($connection, $get);
						while ($data = mysqli_fetch_array($query)) {
							echo "<option value='" . $data['id'] . "'>" . htmlspecialchars($data['full_name']) . "</option>";
						}
						?>
					</select>
				</div>

				<div class="col-md-6">
					<label for="roleSelect" class="form-label">Assign Role</label>
					<select id="roleSelect" name="role" class="form-select" required>
						<option value="" selected disabled>Select Role</option>
						<option value="student">Student</option>
						<option value="teacher">Teacher</option>
						<option value="admin">Admin</option>	
					</select>
				</div>

				<div class="col-12 text-center">
					<button type="submit" name="assign" class="btn btn-primary px-4">Assign Role</button>
				</div>
			</form>

			<!-- FOOTER START -->
			<div class="mt-5">
				<?php include("include/footer.php"); ?>
			</div>
			<!-- FOOTER END -->

		</div>
	</div>

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

    <!-- Sweet Alert -->
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="assets/js/setting-demo.js"></script>
    <script src="assets/js/demo.js"></script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>
  </body>
</html>



