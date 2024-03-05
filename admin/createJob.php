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
      <div class="py-2 px-2" style="background-color: #0a58ca38 !important; border-radius: 5px;">
        <a href="admin.php" class="bar">Admin /</a><a href="createJob.php" class="bar ms-2">create User</a>
      </div>
          <div class="col-12 heading mt-3">
            <h3 class="text-white text-center">ADD JOB</h3>
          </div>
           <?php
              if (isset($_GET["job"]) && ($_GET["job"]) == 1) {
                  echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6">Job Added Successfully ! <i class="bi bi-emoji-smile"></i></div>';
              } 
            ?>
            <?php
              if (isset($_GET["job"]) && ($_GET["job"]) == 0) {
                  echo '<div class="alert alert-danger px-3 py-1 fw-semibold fs-6">Oops, Something Missed ! <i class="bi bi-emoji-sad"></i></div>';
              } 
            ?>
            
          <form method="POST" action="createjobSql.php">
            <div class="row d-flex align-items-center justify-content-center p-5">
              <div class="col-xxl-6 col-lg-6 col-md-6 col-12 form-group mb-3">
                <input type="text" class="form-control" id="title" name="title">
                <label for="title" class="form-label">Job Title</label>
              </div>
              <div class="col-xxl-6 col-lg-6 col-md-6 col-12 form-group mb-3">
                <input type="text" class="form-control" id="req_skill" name="req_skill">
                <label for="req_skill" class="form-label">Required Skills</label>
              </div>
              <div class="col-xxl-6 col-lg-6 col-md-6 col-12 form-group mb-3">
                <textarea type="text" class="form-control" id="skill_desc" rows="3" name="skill_desc"></textarea>
                <label for="skill_desc" class="form-label">Skills Description</label>
              </div>
              <div class="col-xxl-6 col-lg-6 col-md-6 col-12 form-group mb-3">
                <textarea type="text" class="form-control" id="job_desc" rows="3" name="job_desc"></textarea>
                <label for="job_desc" class="form-label">Job Description</label>
              </div>
              <div class="col-xxl-6 col-lg-6 col-md-6 col-12 form-group mb-3">
                <input type="text" class="form-control" id="job_price" name="job_price">
                <label for="job_price" class="form-label">Price</label>
              </div>
               <div class="col-xxl-6 col-lg-6 col-md-6 col-12 form-group mb-3">
                <input type="date" class="form-control" id="del_time" name="del_time">
                <label for="del_time" class="form-label">Time to deliver</label>
              </div>
              <div class="col-12 d-flex justify-content-center">
                <button type="submit"
                  class="btn w-25 btn-block btn-lg gradient-custom-4 text-body" value="submit" name="submit" style="color: #fff !important;">Add</button>
              </div>
            </div>    
          </form>
        </div>
  </section>
  <?php include "footer.php" ?>
  <?php include "../bottomcdn.php" ?>
</body>
</html>