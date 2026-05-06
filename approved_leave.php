<?php
// Start session
session_start();

// Connection
require("config/connection.php");

// Check if session variable exists
if (!isset($_SESSION['full_name'])) {
    echo "<script>alert('Session expired. Please log in again.');</script>";
    exit;
}

// Access session value
$full_name = $_SESSION['full_name'];

// Query to fetch all approved leave applications
$sql = "SELECT * FROM `leave_application` WHERE `full_name` = '$full_name' AND `status` = 'Approved' ORDER BY `from_date` DESC";
$sql_query = mysqli_query($connection, $sql);


?>

<!DOCTYPE html>
	<html lang="en">
	  <head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>VIEW</title>
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
								<div class="page-header">
								  <h3 class="fw-bold mb-3">View</h3>
								  <ul class="breadcrumbs mb-3">
									<li class="nav-home">
									  <a href="#">
										<i class="icon-home"></i>
									  </a>
									</li>
									<li class="separator">
									  <i class="icon-arrow-right"></i>
									</li>
									<li class="nav-item">
									  <a href="#">Leave</a>
									</li>
									<li class="separator">
									  <i class="icon-arrow-right"></i>
									</li>
									<li class="nav-item">
									  <a href="#">Data</a>
									</li>
								  </ul>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="card">
											<div class="card-header">
												<div class="card-title">Approved Leave</div>
											</div>
											<div class="card-body">
												
												<div class="table-responsive">
													<table class="table table-bordered">
														<thead>
														  <tr>
															
															<th>Full Name</th>
															<th>From</th>
															<th>To</th>
															<th>Leave Type</th>
															
														  </tr>
														</thead>
														<?php 
															while($fetch = mysqli_fetch_array($sql_query)){
														?>
														<tbody>
															<tr>
																
																<td><?php echo $fetch['full_name']; ?></td>
																<td><?php echo $fetch['from_date']; ?></td>
																<td><?php echo $fetch['to_date']; ?></td>
																<td><?php echo $fetch['leave_type']; ?></td>
																
															</tr>
														</tbody>
														<?php
															}
														?>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
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
			content.url = "index.php";
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
