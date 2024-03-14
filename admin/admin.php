<?php
	include_once "session.php"; 

	if (!isset($_SESSION['email'])) {
		// Redirect to index.php page
		header("Location: index.php");
		exit();
	}

	$admin_email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Explore</title>
	<?php include "../topcdn.php" ?>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">

</head>
<body>
	<?php include "nav.php" ?>
	<section class="section exploreS" style="margin-top: 80px; margin-bottom: 150px !important;">
		<div class="container col-xxl-12 px-3 py-5">
			<div id="notification" class="notification">Welcome Back Admin 😊 </div>
			<?php
			    if (isset($_GET["admin"]) && $_GET["admin"] == 1) {
			        // JavaScript to display the notification message with timeout
			        echo '<script>';
			        echo 'document.addEventListener("DOMContentLoaded", function() {';
			        echo 'var notification = document.getElementById("notification");';
			        echo 'notification.style.display = "block";'; 
			        echo 'setTimeout(function() {';
			        echo 'notification.style.display = "none";'; 
			        echo '}, 3000);';
			        echo '});';
			        echo '</script>';
			    } 
			?>
			<div class="py-2 px-2" style="background-color: #0a58ca38 !important; border-radius: 5px;">
				<a href="admin.php" class="bar">Admin /</a>
			</div>
          <div class="row d-flex align-items-center justify-content-center p-lg-4 p-3">
          	<!-- cards job -->
	            <div class="col-xxl-4 col-lg-4 col-md-6 col-12 adCard mb-4">
		          	<a href="createJob.php" class="text-decoration-none">
		            	<div class="card py-2 px-3">
						  <div class="card-body">
						    <h5 class="card-title">Create Job</h5>
						  </div>
						</div>
		          	</a>
	            </div>
          	<!-- cards job -->          	
          	<!-- cards manage job -->
	            <div class="col-xxl-4 col-lg-4 col-md-6 col-12 adCard mb-4">
		          	<a href="manageJob.php" class="text-decoration-none">
		            	<div class="card py-2 px-3">
						  <div class="card-body">
						    <h5 class="card-title">Job Management</h5>
						  </div>
						</div>
		          	</a>
	            </div>
          	<!-- cards manage job -->
          	<!-- cards manage user -->
	            <div class="col-xxl-4 col-lg-4 col-md-6 col-12 adCard mb-4">
		          	<a href="manageUser.php" class="text-decoration-none">
		            	<div class="card py-2 px-3">
						  <div class="card-body">
						    <h5 class="card-title">User Management</h5>
						  </div>
						</div>
		          	</a>
	            </div>
          	<!-- cards manage user -->
          	<!-- cards Add skill -->
	            <div class="col-xxl-4 col-lg-4 col-md-6 col-12 adCard mb-4">
		          	<a href="addSkill.php" class="text-decoration-none">
		            	<div class="card py-2 px-3">
						  <div class="card-body">
						    <h5 class="card-title">Add Skill</h5>
						  </div>
						</div>
		          	</a>
	            </div>
          	<!-- cards Add skill -->
          </div>  	
		</div>
	</section>
	<?php include "footer.php" ?>
	<?php include "../bottomcdn.php" ?>
</body>
</html>