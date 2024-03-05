<?php
	include_once "session.php"; 
  $user_email =	$_SESSION['login_user'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Explore</title>
	<?php include "topcdn.php" ?>

</head>
<body>
	<?php include "nav.php" ?>
	<section class="section exploreS" style="margin-top: 80px; margin-bottom: 150px !important;">
		<div class="container col-xxl-12 px-3 py-5">
			<div id="notification" class="notification">Welcome To Our Site  <i class="bi bi-emoji-smile-fill fs-4"></i></div>
			<?php
			    if (isset($_GET["success"]) && $_GET["success"] == 1) {
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
			<h4>Remote Jobs You Might Like</h4>
          <div class="row d-flex align-items-center justify-content-start g-5 py-4">
          	<!-- for job cards show -->
            <div class="col-lg-9 col-md-10 col-12">
            	<div class="row d-flex">
            		<div class="col-12">
            			<div class="card">
									  <div class="card-body">
									  	<span style="font-size: 11px !important;">20-11-2000</span>
									    <h4 class="card-title fw-semibold">Php Developer</h4>
									    <h6 class="card-subtitle mb-2 text-white my-4" style="font-size: 11px !important;">Fixed-price</h6>
									    <p class="card-text my-4">"Some quick example text to build on the card title and make up the bulk of the card's content."</p>
									    <div class="text-start col-12">
										    <ul class="d-flex align-items-center justify-content-start skillUl">
										        <li class="skillL">php</li>
										        <li class="skillL">full stack developer</li>
										        <li class="skillL">javascript</li>
										        <li class="skillL">my sql</li>
										        <li class="skillL">frontend</li>
										    </ul>
										  </div>
						    		  <a href="#" class="card-link text-white text-decoration-none" style="font-size: 12px !important;"><i class="bi bi-geo-alt me-2"></i> Pakistan</a>
						        </div>
						      </div>
            		</div>
            	</div>
            </div>
            <!-- for others  -->
            <div class="col-lg-3 col-md-12 col-12 d-flex align-items-center justify-content-center d-none">
            	<div class="card" style="width: 20rem;">
							  <img src="" class="card-img-top" alt="">
							  <div class="card-body">
							    <h5 class="card-title">Card title</h5>
							    <p class="card-text">Some quick</p>
							  </div>
							  <div class="card-body">
							    <a href="#" class="card-link">Complete Your Profile</a>
							  </div>
							</div>
            </div>
          </div>  	
		</div>
	</section>
	<?php include "footer.php" ?>
	<?php include "bottomcdn.php" ?>
</body>
</html>