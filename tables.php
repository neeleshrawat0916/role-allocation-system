	<?php
	session_start();

	//connection
	require("config/connection.php");

$role = $_SESSION['role']; //assign session value

	if ($role == 'admin') {
    // Admin sees all users/students
    $sql = "SELECT * FROM school";
	} elseif ($role == 'teacher') {
		// Teacher sees only students
		$sql = "SELECT * FROM school WHERE role = 'student'";
	} elseif ($role == 'student') {
		// Student sees only students
		$sql = "SELECT * FROM school WHERE role = 'student'";
	}
	$query = mysqli_query($connection, $sql);
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
									  <a href="#">Teachers</a>
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
												<div class="card-title">SUBMITTED DATA</div>
											</div>
											<div class="card-body">
												
												<div class="table-responsive">
													<table class="table table-bordered">
														<thead>
														  <tr>
															<th>Profile Image</th>
															<th>Full Name</th>
															<th>Email</th>
															<th>Phone Number</th>
															<th>Address</th>
															<th>Subject Specialization</th>
															<th>Qualification</th>
															<th>Experience</th>
															<th>Password</th>
															<th>Role</th>
															<th>Update</th>
															<th>Delete</th>
														  </tr>
														</thead>
														<?php 
															while($fetch = mysqli_fetch_array($query)){
														?>
														<tbody>
															<tr>
																<td><img src = "<?php echo $fetch['profile_img']; ?>" width = "50" height = "50"</td>
																<td><?php echo $fetch['full_name']; ?></td>
																<td><?php echo $fetch['email']; ?></td>
																<td><?php echo $fetch['phone']; ?></td>
																<td><?php echo $fetch['address']; ?></td>
																<td><?php echo $fetch['subject_specialization']; ?></td>
																<td><?php echo $fetch['qualification']; ?></td>
																<td><?php echo $fetch['experience']; ?></td>
																<td><?php echo $fetch['password']; ?></td>
																<td><?php echo $fetch['role']; ?></td>
																<td><a href="update_teacher.php?id=<?php echo $fetch['id']; ?>">UPDATE</a></td>
																<td><a href="delete_teacher.php?id=<?php echo $fetch['id']; ?>">DELETE</a></td>
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
