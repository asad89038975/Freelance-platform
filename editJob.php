<?php 
  include_once "session.php";
  $jobId = $_GET['jobId'];
  $userId = $_GET['userId'];
  $user_email = $row['email'];

  $sql = "SELECT * FROM apply_job WHERE job_id = '$jobId' AND user_id = '$userId'";
  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $job_title = $row['job_title'];
      $job_price = $row['job_price'];
      $cover_letter = $row['cover_letter'];
    }
  }
   else {
          echo "No Applied Jobs found.";
      }
    
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Job Detail</title>
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
                      if (isset($_GET["status"]) && ($_GET["status"]) == 1) {
                          echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6">Hurrah ! Job Edit Successfully ! <i class="bi bi-emoji-smile"></i></div>';
                      } 
                    ?>

                    <?php
                      if (isset($_GET["status"]) && ($_GET["status"]) == 0) {
                          echo '<div class="alert alert-warning px-3 py-1 fw-semibold fs-6">Oops ! Something missing ! <i class="bi bi-emoji-sad"></i></div>';
                      } 
                    ?>

                  <h2 class="text-uppercase text-center mb-5">Edit Job Detail</h2>

                  <form method="POST" action="editJobSql.php" enctype="multipart/form-data">
                      <input type="hidden" value="<?php echo $jobId ?>" name="jobId">
                      <input type="hidden" value="<?php echo $user_email ?>" name="user_email">
                      <input type="hidden" value="<?php echo $job_title ?>" name="job_title">
                      <input type="hidden" value="<?php echo $job_price ?>" name="job_price">
                      <input type="hidden" value="<?php echo $userId ?>" name="userId"> <!-- Assuming user_id is already set -->
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
                              <textarea type="text" name="cover_letter" id="form9" class="form-control form-control-md" rows="4" required ><?php echo $cover_letter; ?></textarea>
                              <label class="form-label" for="form9"></label>
                          </div>
                          <div class="form-outline mb-3 col-lg-12 col-md-12 col-12">
                              <input type="file" id="form10" class="form-control form-control-md" name="related_work" required>
                              <label class="form-label" for="form10">Related Work</label>
                          </div>
                      </div>   
                      <div class="d-flex justify-content-center">
                          <button type="submit" class="btn btn-block btn-lg gradient-custom-4 text-body" name="submit" style="color: #fff !important;">Edit</button>
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
