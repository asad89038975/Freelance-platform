<?php
// Include the session file
include_once "session.php"; 

if (!isset($_SESSION['email'])) {
    // Redirect to index.php page
    header("Location: index.php");
    exit();
}

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
            <?php
              include_once "../connection.php";

              if ($connection) {
                  $sql = "SELECT * FROM freelance_job WHERE status=1";
                  $result = $connection->query($sql);

                  if ($result->num_rows > 0) {
                     echo "<table class='table table-dark table-md' border='1'>";
                      echo "<thead>
                      <tr class='border-bottom'>
                        <th scope='col'>No.</th>
                        <th scope='col'>Job Title</th>
                        <th scope='col'>Required Skills</th>
                        <th scope='col'>Skills Description</th>
                        <th scope='col'>Job Description</th>
                        <th scope='col'>Price</th><th>Time to deliver</th>
                        <th scope='col'>Status</th>
                        <th scope='col'>Action</th>
                      </tr>
                      </thead>";
                      while ($row = $result->fetch_assoc()) {       
                          echo "<tbody class='py-3'>";
                          echo "<tr>";
                          echo "<th scope='row'>1</th>";
                          echo "<td style='font-size: 13px;'>" . $row['title'] . "</td>";
                          echo "<td style='font-size: 13px;'>" . $row['req_skill'] . "</td>";
                          echo "<td style='font-size: 13px;'>" . $row['skill_desc'] . "</td>";
                          echo "<td style='font-size: 13px;'>" . $row['job_desc'] . "</td>";
                          echo "<td style='font-size: 13px;'>$" . $row['job_price'] . "</td>";
                          echo "<td style='font-size: 13px;'>" . $row['del_time'] . " days</td>";
                          echo "<td style='font-size: 13px;'>";
                          if ($row['status'] == 1) {
                              echo "<span class='badge rounded-pill bg-success'>Active</span>";
                          } else {
                              echo "<span class='badge rounded-pill bg-secondary'>Expired</span>";
                          }
                           
                           echo"</td>";
                          echo "<td> 
                          <a class='btn btn-sm btn-warning' style='font-size: 11px;' href=''>Edit</a> 
                          <a class='btn btn-sm btn-danger' style='font-size: 11px;' href=''>Delete</a> 
                          </td>";
                          echo "</tr>";
                          echo "</tbody>";
                      }
                 echo "</table>";

                      
                  } else {
                      echo "No jobs found.";
                  }

                  // Close the database connection
                  $connection->close();
              } else {
                  echo "Connection failed.";
              }
              ?>
                     
          </form>
        </div>
  </section>
  <?php include "footer.php" ?>
  <?php include "../bottomcdn.php" ?>
</body>
</html>