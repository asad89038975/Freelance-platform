<?php 
  include_once "session.php";
  $jobid = $_GET['jobid'];
  $user_id = $_GET['user_d'];
  $user_email = $row['email'];

  $sql = "SELECT title, job_price FROM freelance_job WHERE job_id = '$jobid'";
  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $job_title = $row['title'];
      $job_price = $row['job_price'];
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
                <div class="card-body p-lg-5 p-3">
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

                  <h2 class="text-uppercase text-center mb-5">Apply For Remote Job</h2>

                  <form method="POST" action="applyJobSql.php" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $jobid ?>" name="jobid">
                      <input type="hidden" value="<?php echo $user_email ?>" name="user_email">
                      <input type="hidden" value="<?php echo $job_title ?>" name="job_title">
                      <input type="hidden" value="<?php echo $job_price ?>" name="job_price">
                      <input type="hidden" value="<?php echo $user_id ?>" name="user_id"> <!-- Assuming user_id is already set -->
                      <div class="row d-flex align-items-center justify-content-center">
                          <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
                              <input type="text" id="form8" value="<?php echo $job_title; ?>" name="job_title" class="form-control form-control-md" disabled />
                              <label class="form-label" for="form8">Applied For</label>
                          </div>
                          <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
                              <input type="text" id="form8" value="<?php echo $job_price; ?>" name="job_price" class="form-control form-control-md" disabled />
                              <label class="form-label" for="form8">Job Price</label>
                          </div>
                          <div class="form-outline mb-3 col-lg-12 col-md-12 col-12">
                              <textarea type="text" name="cover_letter" id="form9" class="form-control form-control-md" rows="4" required ></textarea>
                              <label class="form-label" for="form9">Cover Letter</label>
                          </div>
                          <div class="form-outline mb-3 col-lg-12 col-md-12 col-12">
                              <input type="file" id="form10" class="form-control form-control-md" name="work">
                              <label class="form-label" for="form10">Related Work</label>
                          </div>
                      </div>   
                      <div class="d-flex justify-content-center">
                          <button type="submit" class="btn btn-block btn-lg gradient-custom-4 text-body" name="submit" style="color: #fff !important;">Apply</button>
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
