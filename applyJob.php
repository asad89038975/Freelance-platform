<?php 
  include_once "session.php";
  $jobid = $_GET['jobid'];

  $sql = "SELECT title FROM freelance_job WHERE job_id = '$jobid'";
  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $job_title = $row['title'];
    }
  }
    
?>
<!DOCTYPE html>
<html>
<head>
  <title>Apply Job</title>
  <?php include "topcdn.php"; ?>
</head>
<body>
    <section class="vh-100 bg-image">
      <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-12 col-lg-10 col-xl-10">
              <div class="card" style="border-radius: 15px;">
                <div class="card-body p-5">
                   <?php
                      if (isset($_GET["success"]) && ($_GET["success"]) == 1) {
                          echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6">Hurrah ! Job Applied Successfully ! <i class="bi bi-emoji-smile"></i></div>';
                      } 
                    ?>

                    <?php
                      if (isset($_GET["success"]) && ($_GET["success"]) == 0) {
                          echo '<div class="alert alert-warning px-3 py-1 fw-semibold fs-6">Oops ! Job Not Applied ! <i class="bi bi-emoji-sad"></i></div>';
                      } 
                    ?>

                  <h2 class="text-uppercase text-center mb-5">Apply For Remote</h2>

                  <form method="POST" action="applyJobSql.php" required>
                    <input type="hidden" value="<?php echo $jobid ?>" name="jobid">
                    <div class="row d-flex align-items-center justify-content-center">

                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
                        <input type="text" id="form3Example1cg" name="fullname" class="form-control form-control-md" required />
                        <label class="form-label" for="form3Example1cg">Full Name</label>
                      </div>

                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
                        <input type="email" id="form3Example3cg" name="email" class="form-control form-control-md" required />
                        <label class="form-label" for="form3Example3cg">Your Email</label>
                      </div>

                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
                        <input type="text" id="form8" name="designation" class="form-control form-control-md" required />
                        <label class="form-label" for="form8">Profession</label>
                      </div>

                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
                        <input type="text" id="form8" value="<?php echo $job_title; ?>" class="form-control form-control-md" disabled />
                        <label class="form-label" for="form8">Applied For</label>
                      </div>

                      <div class="form-outline mb-3 col-lg-12 col-md-12 col-12">
                        <textarea type="text" name="skill_desc" id="form9" class="form-control form-control-md" rows="4" required ></textarea>
                        <label class="form-label" for="form9">Describe Briefly Your Skills</label>
                      </div>

                     </div>   

                    <div class="d-flex justify-content-center">
                      <button type="submit"
                        class="btn w-25 btn-block btn-lg gradient-custom-4 text-body" value="submit" name="submit" style="color: #fff !important;">Apply</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
  <?php include "bottomcdn.php"; ?>
  <script>
      function validateForm(){
        var x = document.forms["myform"]["fname"].value;

        if (x == "" || x == null) {
          alert("Name must be filled");
          return false;
        }
      }
  </script>
</body>
</html>
