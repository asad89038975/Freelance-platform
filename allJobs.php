<?php
	include_once "session.php"; 
  $user_email = $_SESSION['login_user'];

  $sqlUser = "SELECT * FROM remoteuser WHERE status = 1 AND email = '$user_email'";
  $resultUser = $connection->query($sqlUser);

  if ($resultUser->num_rows > 0) {
  	while ($rowUser = $resultUser->fetch_assoc()) {
  		$user_id = $rowUser['user_id'];
  		$user_image = $rowUser['img'];
  		$user_designation = $rowUser['designation'];
  	}
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>All Preffered Jobs</title>
	<?php include "topcdn.php" ?>

</head>
<body>
	<?php include "nav.php" ?>
	<section class="section exploreS" style="margin-top: 80px; margin-bottom: 150px !important;">
		<!-- hero section -->
			<div class="col-12 d-flex align-items-center justify-content-center" style="position: relative; min-height: 350px;">
			    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
			    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url(assets/images/banner3.jpg); background-position: 50% 50%; object-fit: cover; filter: brightness(70%);"></div>
			    <h1 class="text-center" style="position: relative; z-index: 1; font-size: 60px; font-weight: 900; font-family: 'Quicksand', sans-serif !important; color: white;">Let's redefine success <br> together</h1>
			</div>
		<div class="container col-xxl-12 px-3 py-5">
			<h4 class="exploreH">All Preffered Jobs</h4>
          <div class="row d-flex align-items-center justify-content-center py-5">	
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

				$sql = "SELECT * FROM freelance_job WHERE status=1";
				$result = $connection->query($sql);

				if ($result === false) {
				    die("Query failed: " . $connection->error);
				}

				if ($result->num_rows > 0) {
				    while ($row = $result->fetch_assoc()) {
				    		$job_id = $row['job_id'];
				        echo '<div class="card jobCard col-xxl-4 col-lg-4 col-md-6 col-12 me-3 mb-4">';
								echo '<div class="card-body">';
								echo '<div class="d-flex justify-content-between">';
								echo '<span style="font-size: 11px !important;">' . date('d-m-Y', strtotime($row['del_time'])) . '</span>';
								echo '<a href="applyJob.php?user_email=' . $user_email . '&jobid='. $job_id .' &user_d='. $user_id .'" class="btn btn-sm applyBtn" align="center">Apply <i class="bi bi-send-arrow-up-fill ms-1"></i></a>';
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
						    echo '<div class="card jobCard mb-4">';
						    echo '<div class="card-body">';
						    echo '<div class="text-center"><h4>No job related to your skill</h4></div>';
						    echo '</div>';
						    echo '</div>';
						}

						// Close the connection after using it
						$connection->close();
					?>


            			<!-- job card end-->
					</div>
	</section>
	<?php include "footer.php" ?>
	<?php include "bottomcdn.php" ?>
</body>
</html>