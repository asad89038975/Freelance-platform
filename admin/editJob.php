<?php
	include_once "session.php";
	include_once "../connection.php";

	$job_id = $_GET['jobid'];

	$sql = "SELECT * FROM freelance_job WHERE job_id = '$job_id'";
	$result = $connection->query($sql);

    	if ($result->num_rows > 0) {
    		while ($row = $result->fetch_assoc()) {   
               $jobid = $row['job_id'];
               $title = $row['title'];
               $req_skill = $row['req_skill'];
               $skill_desc = $row['skill_desc'];
               $job_desc = $row['job_desc'];
               $job_price = $row['job_price'];
               $del_time = $row['del_time'];

            }
    	} else {
                      echo "No jobs found.";
                  }
                  $connection->close();

?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Job</title>
  <?php include "../topcdn.php" ?>
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

</head>
<body>
  <?php include "nav.php" ?>
  <section class="section exploreS" style="margin-top: 80px; margin-bottom: 150px !important;">
    <div class="container col-xxl-12 px-3 py-5">
      <div class="py-2 px-2" style="background-color: #0a58ca38 !important; border-radius: 5px;">
        <a href="admin.php" class="bar">Admin /</a><a href="manageJob.php" class="bar ms-2">Manage Job</a>
      </div>
          <div class="col-12 heading mt-3">
            <h3 class="text-white text-center">EDIT JOB</h3>
          </div>
           <?php
              if (isset($_GET["job"]) && ($_GET["job"]) == 1) {
                  echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6">Job Updated Successfully ! <i class="bi bi-emoji-smile"></i></div>';
              } 
            ?>
            <?php
              if (isset($_GET["job"]) && ($_GET["job"]) == 0) {
                  echo '<div class="alert alert-danger px-3 py-1 fw-semibold fs-6">Oops, Something Missed ! <i class="bi bi-emoji-sad"></i></div>';
              } 
            ?>
            
          <form method="POST" action="editjobSql.php">
          	<input type="hidden" value="<?php echo $jobid; ?>" name="jobid">
            <div class="row d-flex align-items-center justify-content-center p-5">
              <div class="col-xxl-6 col-lg-6 col-md-6 col-12 form-group mb-3">
                <input type="text"  value="<?php echo $title; ?>" class="form-control" id="title" name="title">
                <label for="title" class="form-label">Job Title</label>
              </div>
              <div class="col-xxl-6 col-lg-6 col-md-6 col-12 form-group mb-3">
                <input type="text"  value="<?php echo $req_skill; ?>" class="form-control" id="req_skill" name="req_skill">
                <label for="req_skill" class="form-label">Required Skills</label>
              </div>
              <div class="col-xxl-6 col-lg-6 col-md-6 col-12 form-group mb-3">
                <textarea type="text" class="form-control" id="skill_desc" rows="3" name="skill_desc"><?php echo $skill_desc; ?></textarea>
                <label for="skill_desc" class="form-label">Skills Description</label>
              </div>
              <div class="col-xxl-6 col-lg-6 col-md-6 col-12 form-group mb-3">
                <textarea type="text" class="form-control" id="job_desc" rows="3" name="job_desc"><?php echo $job_desc; ?></textarea>
                <label for="job_desc" class="form-label">Job Description</label>
              </div>
              <div class="col-xxl-6 col-lg-6 col-md-6 col-12 form-group mb-3">
                <input type="text" value="<?php echo $job_price; ?>"  class="form-control" id="job_price" name="job_price">
                <label for="job_price" class="form-label">Price</label>
              </div>
               <div class="col-xxl-6 col-lg-6 col-md-6 col-12 form-group mb-3">
                <input type="date"  value="<?php echo $del_time; ?>" class="form-control" id="del_time" name="del_time">
                <label for="del_time" class="form-label">Time to deliver</label>
              </div>
              <div class="col-12 d-flex justify-content-center">
                <button type="submit"
                  class="btn w-25 btn-block btn-lg gradient-custom-4 text-body" value="submit" name="submit" style="color: #fff !important;">Edit</button>
              </div>
            </div>    
          </form>
        </div>
  </section>
  <?php include "footer.php" ?>
  <?php include "../bottomcdn.php" ?>
</body>
</html>