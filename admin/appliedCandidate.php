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
  <title>Applied Candidates</title>
  <?php include "../topcdn.php" ?>
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

</head>
<body>
  <?php include "nav.php" ?>
  <section class="section exploreS" style="margin-top: 80px; margin-bottom: 150px !important;">
    <div class="container col-xxl-12 px-3 py-5">
      <div class="py-2 px-2" style="background-color: #0a58ca38 !important; border-radius: 5px;">
        <a href="admin.php" class="bar">Admin /</a><a href="appliedCandidate.php" class="bar ms-2">Applied candidates</a>
      </div>
          <div class="col-12 heading mt-3">
            <h3 class="text-white text-center my-4">Manage Candidates</h3>
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
             <?php
              if (isset($_GET["delete"]) && ($_GET["delete"]) == 1) {
                  echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6">Job Deleted Successfully ! <i class="bi bi-emoji-smile"></i></div>';
              } 
            ?>
            <?php
              if (isset($_GET["delete"]) && ($_GET["delete"]) == 0) {
                  echo '<div class="alert alert-danger px-3 py-1 fw-semibold fs-6">Oops, Something Missed ! <i class="bi bi-emoji-sad"></i></div>';
              } 
            ?>
            
          <form>
            <?php
              include_once "../connection.php";

              if ($connection) {
                  $sql = "SELECT * FROM apply_job WHERE status=1";
                  $result = $connection->query($sql);
                  $counter = 0;

                  if ($result->num_rows > 0) {
                     echo "<table class='table table-dark table-lg' border='1'>";
                      echo "<thead>
                      <tr class='border-bottom'>
                        <th scope='col'>No.</th>
                        <th scope='col'>Job Title</th>
                        <th scope='col'>Candidate Name</th>
                        <th scope='col'>Cover Letter</th>
                        <th scope='col'>Related Work</th>
                        <th scope='col'>Apply Date</th>
                        <th scope='col'>Status</th>
                        <th scope='col'>Action</th>
                      </tr>
                      </thead>";
                      while ($row = $result->fetch_assoc()) {   
                        $job_id = $row['id'];
                        $counter++;

                          echo "<tbody class='py-3'>";
                          echo "<tr>";?>
                          <th scope='row'><?php echo $counter; ?></th><?php
                          echo "<td style='font-size: 11px;'>" . $row['job_title'] . "</td>";
                          echo "<td style='font-size: 11px;'>" . $row['user_id'] . "</td>";
                          echo "<td style='font-size: 11px;'>" . $row['cover_letter'] . "</td>";
                          echo "<td style='font-size: 11px;'>" . $row['related_work'] . "</td>";
                          echo "<td style='font-size: 11px;'>" . $row['apply_date'] . "</td>";
                          echo "<td style='font-size: 11px;'>";
                          if ($row['status'] == 1) {
                              echo "<span class='badge rounded-pill bg-success'>Active</span>";
                          } else {
                              echo "<span class='badge rounded-pill bg-secondary'>Expired</span>";
                          }
                           
                           echo"</td>";
                          echo '
                          <td> 
                          <div class="dropdown">
                            <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Action
                            </button>
                            <ul class="dropdown-menu">
                              <li class="text-center"><a class="dropdown-item" style="font-size: 12px; font-weight: 500;" href="editJob.php?jobid=$job_id">Edit</a></li>
                              <li class="text-center"><a class="dropdown-item" style="font-size: 12px; font-weight: 500;" href="deleteJob.php?jobid=$job_id">Delete</a> </li>
                              <li class="text-center"><a class="dropdown-item" style="font-size: 12px; font-weight: 500;" href="#">Something else here</a></li>
                            </ul>
                          </div>
                          </td>';
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