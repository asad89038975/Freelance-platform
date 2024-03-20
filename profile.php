<?php 
	include "session.php";
	$user_email = $_SESSION['login_user'];

	$sql = "SELECT * FROM remoteuser WHERE email = '$user_email'";
	$result = mysqli_query($connection, $sql);

	if (mysqli_num_rows($result) > 0) {
		// User found, fetch user data
		$user_data = mysqli_fetch_assoc($result);

		$user_id = $user_data['user_id'];
		$fullname = $user_data['fullname'];
		$email = $user_data['email'];
		$contact = $user_data['contact'];
		$address = $user_data['address'];
		$gender = $user_data['gender'];
		$designation = $user_data['designation'];
		$skill_desc = $user_data['skill_desc'];
		$img = $user_data['img'];

		// Use the fetched data for further processing or display
		// For example, you can echo the user's fullname:
		//echo "Full Name: $fullname";
	} else {
		// User not found or session email does not match any user
		echo "User not found.";
	}

	// Close the database connection
	mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<?php include "topcdn.php"; ?>
</head>
<body>
  <main>
	<!-- nav -->
  <?php include "nav.php"; ?>
  	<section class="section" style="margin-top: 50px !important;">
  		<div class="container col-xxl-12 px-3 py-3">
  			<div class="row d-flex align-items-center justify-content-start g-5 py-4">
  				<div class="col-12">
  					<div class="card" style="border-radius: 15px;">
                       <div class="card-body p-lg-5 p-3">
                       		<?php
			                      if (isset($_GET["status"]) && ($_GET["status"]) == 1) {
			                          echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6">Profile Updates Successfully! <i class="bi bi-emoji-smile"></i></div>';
			                      } 
			                    ?>
			                    <?php
			                      if (isset($_GET["status"]) && ($_GET["status"]) == 2) {
			                          echo '<div class="alert alert-warning px-3 py-1 fw-semibold fs-6">You are missing Something ! <i class="bi bi-emoji-frown"></i></div>';
			                      } 
		                    ?>
		                    <?php
			                      if (isset($_GET["status"]) && ($_GET["status"]) == 3) {
			                          echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6"> Profile Image Updated ! <i class="bi bi-emoji-frown"></i></div>';
			                      } 
		                    ?>
		                    <?php
			                      if (isset($_GET["status"]) && ($_GET["status"]) == 4) {
			                          echo '<div class="alert alert-danger px-3 py-1 fw-semibold fs-6"> Profile Image Not Updated ! <i class="bi bi-emoji-frown"></i></div>';
			                      } 
		                    ?>
                       		<h2 class="text-uppercase text-center mb-4">Your Profile</h2>
			                <form method="POST" action="editProfileImg.php" enctype="multipart/form-data">
							    <div class="row d-flex align-items-center justify-content-center">
							        <div class="form-outline mb-3 col-lg-12 col-md-12 col-12">
							            <div class="row d-flex align-items-center justify-content-center flex-column">
							                <div class="col-lg-4 col-12 text-center mb-3">
							                	<input type="hidden" value="<?php echo $user_email; ?>" name="user_email">
							                    <!-- Display current profile image -->
							                    <img src="<?php echo $img; ?>" height="70" width="70" style="border-radius: 50%; object-fit: cover;">
							                </div>
							                <div class="col-lg-4 col-12">
							                    <!-- Input to select a new image -->
							                    <input type="file" id="form3Example1" name="img" class="form-control form-control-md" required />
							                    <label class="form-label" for="form3Example1">Edit Profile Photo</label>
											    <div class="d-flex justify-content-center">
							                      <button type="submit"
							                        class="btn btn-sm gradient-custom-4 text-body" value="submit" name="submit" style="color: #fff !important;">Update</button>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
							</form>

			                <form method="POST" action="editProfile.php" required>
			                <div class="row d-flex align-items-center justify-content-center">
			                	<input type="hidden" value="<?php echo $user_email; ?>" name="user_email">
			                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
			                        <input type="text" id="form3Example1cg" name="fullname" value="<?php echo $fullname; ?>" class="form-control form-control-md" required />
			                        <label class="form-label" for="form3Example1cg">Full Name</label>
			                      </div>

			                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
			                        <input type="email" id="form3Example3cg" name="email" value="<?php echo $email; ?>" class="form-control form-control-md" required />
			                        <label class="form-label" for="form3Example3cg">Your Email</label>
			                      </div>

			                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
			                        <input type="text" id="form5" name="contact" value="<?php echo $contact; ?>" class="form-control form-control-md" required />
			                        <label class="form-label" for="form5">Contact No.</label>
			                      </div>

			                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
			                        <input type="text" id="form6" name="address" value="<?php echo $address; ?>" class="form-control form-control-md" required />
			                        <label class="form-label" for="form6">Address</label>
			                      </div>

			                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
			                        <input type="text" id="form7" name="gender" value="<?php echo $gender; ?>" class="form-control form-control-md" required />
			                        <label class="form-label" for="form7">Gender</label>
			                      </div>

			                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
			                        <input type="text" id="form8" value="<?php echo $designation; ?>" name="designation" class="form-control form-control-md" required />
			                        <label class="form-label" for="form8">Designation</label>
			                      </div>

			                      <div class="form-outline mb-3 col-lg-12 col-md-12 col-12">
			                        <textarea type="text" name="skill_desc" id="form9" class="form-control form-control-md" rows="4" required ><?php echo htmlspecialchars($skill_desc); ?></textarea>
			                        <label class="form-label" for="form9">Describe Briefly Your Skills</label>
			                      </div>

			                     </div>   

			                    <div class="d-flex justify-content-center">
			                      <button type="submit"
			                        class="btn btn-block btn-lg gradient-custom-4 text-body" value="submit" name="submit" style="color: #fff !important;">Update</button>
			                    </div>

			                </form>
                       </div>
                    </div>   
  				</div>
  			</div>
  		</div>
  	</section>
  </main>

</body>
</html>