<?php
	include_once "session.php"; 
 $admin_email =	$_SESSION['email'];
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
			<a href="#"><h5>Admin/</h5></a>
          <div class="row d-flex align-items-center justify-content-start g-5 py-4">
          	<!-- cards show -->
            <div class="col-xxl-4 col-lg-4 col-md-6 col-12">
            	<div class="card">
							  <div class="card-body">
							    <h5 class="card-title">Create Job</h5>
							  </div>
							</div>
            </div>
          </div>  	
		</div>
	</section>
	<?php include "../footer.php" ?>
	<?php include "../bottomcdn.php" ?>
</body>
</html>