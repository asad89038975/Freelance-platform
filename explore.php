<?php
	include_once "session.php"; 
  $user_email = $_SESSION['login_user'];

  $sqlUser = "SELECT * FROM remoteuser WHERE status = 1 AND email = '$user_email'";
  $resultUser = $connection->query($sqlUser);

  if ($resultUser->num_rows > 0) {
  	while ($rowUser = $resultUser->fetch_assoc()) {
  		$user_image = $rowUser['img'];
  		$user_designation = $rowUser['designation'];
  	}
  }
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
			<div id="notification" class="notification">Welcome To Our Site 😊</div>
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
          <div class="row flex-column-reverse flex-lg-row d-flex align-items-start justify-content-start g-5 py-4">
          	<!-- for job cards show -->
            <div class="col-lg-9 col-md-10 col-12">
            	<div class="row d-flex">
            		<div class="col-12 mb-4">
            			<!-- job card start-->
            			
            			<?php
											$servername = "localhost"; 
											$username = "root";
											$password = ""; 
											$dbname = "freelance"; 

											// Create connection
											$connection = new mysqli($servername, $username, $password, $dbname);

											// Check connection
											if ($connection->connect_error) {
											    die("Connection failed: " . $connection->connect_error);
											}

										$sql = "SELECT * FROM freelance_job WHERE status=1 AND req_skill = designation";
										$result = $connection->query($sql);

										if ($result === false) {
										    die("Query failed: " . $connection->error);
										}

										if ($result->num_rows > 0) {
										    while ($row = $result->fetch_assoc()) {
										    		$job_id = $row['job_id'];
										        echo '<div class="card jobCard mb-4">';
														echo '<div class="card-body">';
														echo '<div class="d-flex justify-content-between">';
														echo '<span style="font-size: 11px !important;">' . date('d-m-Y', strtotime($row['del_time'])) . '</span>';
														echo '<a href="applyJob.php?user_email=' . $user_email . '&jobid='. $job_id .'" class="btn btn-sm applyBtn" align="center">Apply <i class="bi bi-send-arrow-up-fill ms-1"></i></a>';
														echo '</div>';
														echo '<h4 class="card-title fw-semibold">' . $row['title'] . '</h4>';
														echo '<h6 class="card-subtitle mb-2 text-white my-4" style="font-size: 11px !important;">$' . $row['job_price'] . '</h6>';
														echo '<p class="card-text my-4">' . $row['job_desc'] . '</p>';
														echo '<div class="text-start col-12">';
														echo '<ul class="d-flex align-items-center justify-content-start skillUl">';
														// Add the rest of your card content here

										        
										        // Skills list
										        $skills = explode(',', $row['req_skill']);
										        foreach ($skills as $skill) {
										            echo '<li class="skillL">' . $skill . '</li>';
										        }
										        
										        echo '</ul>';
										        echo '</div>';
										        echo '<a href="#" class="card-link text-white text-decoration-none" style="font-size: 12px !important;"><i class="bi bi-geo-alt me-2"></i> Pakistan</a>';
										        echo '</div>';
										        echo '</div>';
										    }
										} else {
										    echo "No jobs found.";
										}

										// Close the connection after using it
										$connection->close();
									?>


            			<!-- job card end-->
            		</div>
            	</div>
            </div>
            <!-- for others  -->
            <div class="col-lg-3 col-md-12 col-12 d-flex align-items-center justify-content-center">
						  <div class="card" align="center" style="width: 18rem;">
						  	<div class="d-flex align-items-center justify-content-center mt-3">
						    	<img src="<?php echo $user_image; ?>" style="width: 65px; height: 65px; border-radius: 50%; object-fit: cover;" class="card-img-top" alt="">
						  	</div>
						    <div class="card-body">
						      <h5 class="card-title text-center fs-6"><?php echo $user_designation; ?></h5>
						      <a href="profile.php" style="font-size: 12px;" class="card-link">Complete Your Profile</a>
						    </div>
						  </div>
						</div> 	
		</div>
	</section>
	<?php include "footer.php" ?>
	<?php include "bottomcdn.php" ?>
</body>
</html>