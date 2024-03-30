<?php
include_once "session.php"; 
  $user_email = $_SESSION['login_user'];

?>

<!DOCTYPE html>
<html>
<head>
  <title>Applied Jobs</title>
  <?php include "topcdn.php" ?>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<body>
  <?php include "nav.php" ?>
  <section class="section exploreS" id="appliedJob" style="margin-top: 80px; margin-bottom: 50px !important;">
    <div class="container col-xxl-12 px-3 py-5">
          <div class="col-12 heading mt-3">
            <h3 class="text-white text-center my-4">Applied Jobs</h3>
          </div>
          <div class="row applyJobRow py-3">
          <form>
            <?php
              include "connection.php";

              if ($connection) {
                  $sql = "SELECT * FROM apply_job WHERE user_email='$user_email'";
                  $result = $connection->query($sql);

                  if ($result->num_rows > 0) {
                    
                      while ($row = $result->fetch_assoc()) {   
                        $job_id = $row['job_id'];

                          echo "<a href='editJob.php?jobId=" . $row['job_id'] . "&userId=" . $row['user_id'] . "'>";
                          echo "<div class='col-12 d-flex align-items-center justify-content-between applJobDiv'>";
                          echo "<p style='font-size: 11px; margin-top: 10px;'><strong>" . $row['job_title'] . "</strong></p>"; 
                          echo "<p style='font-size: 11px; margin-top: 10px;'>";
                          if ($row['status'] == 1) {
                              echo "<span class='badge rounded-pill bg-success'>Active</span>";
                          } else {
                              echo "<span class='badge rounded-pill bg-secondary'>Expired</span>";
                          }
                          echo "</p>";
                          echo "<p style='font-size: 11px; margin-top: 10px;'><em>" . $row['apply_date'] . "</em></p>";
                          echo "</div>";
                          echo "</a>";

                     } 
                  } else {
                      echo "No Applied Jobs found.";
                  }

                  // Close the database connection
                  $connection->close();
              } else {
                  echo "Connection failed.";
              }
              ?>
                     
          </form>
          </div>
        </div>
  </section>

  <section class="section exploreS" id="hiredJob" style="margin-bottom: 150px !important;">
    <div class="container col-xxl-12 px-3 py-5">
          <div class="col-12 heading mt-3">
            <h3 class="text-white text-center my-4">Hired Jobs</h3>
          </div>
          <div class="row applyJobRow py-3">
          <form>
            <?php
              include "connection.php";

              if ($connection) {
                  $sql = "SELECT * FROM apply_job WHERE user_email='$user_email' AND candidate_status=1";
                  $result = $connection->query($sql);

                  if ($result->num_rows > 0) {
                    
                      while ($row = $result->fetch_assoc()) {   
                        $job_id = $row['job_id'];

                          echo "<a href='editJob.php?jobId=" . $row['job_id'] . "&userId=" . $row['user_id'] . "'>";
                          echo "<div class='col-12 d-flex align-items-center justify-content-between applJobDiv'>";
                          echo "<p style='font-size: 11px; margin-top: 10px;'><strong>" . $row['job_title'] . "</strong></p>"; 
                          echo "<p style='font-size: 11px; margin-top: 10px;'>";
                          if ($row['status'] == 1) {
                              echo "<span class='badge rounded-pill bg-success'>Active</span>";
                          } else {
                              echo "<span class='badge rounded-pill bg-secondary'>Expired</span>";
                          }
                          echo "</p>";
                          echo "<p style='font-size: 11px; margin-top: 10px;'>";
                          if ($row['candidate_status'] == 1) {
                              echo "<span class='badge rounded-pill bg-success'>Accepted</span>";
                          } else {
                              echo "<span class='badge rounded-pill bg-secondary'>Rejected</span>";
                          }
                          echo "</p>";
                          echo "<p style='font-size: 11px; margin-top: 10px;'><em>" . $row['apply_date'] . "</em></p>";
                          echo "</div>";
                          echo "</a>";

                     } 
                  } else {
                      echo "No Applied Jobs found.";
                  }

                  // Close the database connection
                  $connection->close();
              } else {
                  echo "Connection failed.";
              }
              ?>
                     
          </form>
          </div>
        </div>
  </section>
  <?php include "footer.php" ?>
  <?php include "bottomcdn.php" ?>
</body>
</html>