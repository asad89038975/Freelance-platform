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
        <a href="admin.php" class="bar">Admin /</a><a href="removedCandidate.php" class="bar ms-2">Removed candidates</a>
      </div>
          <div class="col-12 heading mt-3">
            <h3 class="text-white text-center my-4">Manage Candidates</h3>
          </div>
           <?php
              if (isset($_GET["status"]) && ($_GET["status"]) == 1) {
                  echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6">Candidate Hired Successfully ! <i class="bi bi-emoji-smile"></i></div>';
              } 
            ?>
            <?php
              if (isset($_GET["status"]) && ($_GET["status"]) == 0) {
                  echo '<div class="alert alert-danger px-3 py-1 fw-semibold fs-6">Oops, Something Missed ! <i class="bi bi-emoji-sad"></i></div>';
              } 
            ?>
             <?php
              if (isset($_GET["status"]) && ($_GET["status"]) == 2) {
                  echo '<div class="alert alert-warning px-3 py-1 fw-semibold fs-6">Candidate Rejected Successfully ! <i class="bi bi-emoji-smile"></i></div>';
              } 
            ?>
            <?php
              if (isset($_GET["status"]) && ($_GET["status"]) == 3) {
                  echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6">Canidates Removed Successfully! <i class="bi bi-emoji-sad"></i></div>';
              } 
            ?>
            
          <form>
            <?php
              include_once "../connection.php";

              if ($connection) {
                  $sql = "SELECT * FROM apply_job INNER JOIN remoteuser ON apply_job.user_id = remoteuser.user_id WHERE apply_job.status=1 AND apply_job.candidate_status=3";
                  $result = $connection->query($sql);
                  $counter = 0;

                  if ($result->num_rows > 0) {
                     echo "<table class='table table-dark table-lg' border='1'>";
                      echo "<thead>
                      <tr class='border-bottom'>
                        <th scope='col'>No.</th>
                        <th scope='col'>Job Title</th>
                        <th scope='col'>Candidate Name</th>
                        <th scope='col'>Related Work</th>
                        <th scope='col'>Cover Letter</th>
                        <th scope='col'>Apply Date</th>
                        <th scope='col'>Status</th>
                        <th scope='col'>Candidate<br>status</th>
                        <th scope='col'>Action</th>
                      </tr>
                      </thead>";
                      while ($row = $result->fetch_assoc()) {   
                        $job_id = $row['id'];
                        $user_coverLetter = $row['cover_letter'];
                        $counter++;

                          echo "<tbody class='py-3'>";
                          echo "<tr>";?>
                          <th scope='row'><?php echo $counter; ?></th><?php
                          echo "<td style='font-size: 11px;'>" . $row['job_title'] . "</td>";
                          echo "<td style='font-size: 11px;'>" . $row['fullname'] . "</td>";
                          ?>
                          <td style='font-size: 11px;'>
                              <a href="../assets/images/<?php echo $row['related_work']; ?>" target="_blank">View Cover Letter</a>
                          </td>
                          <td style='font-size: 11px;'>
                            <?php
                            $cover_letter = $row['cover_letter'];
                            $first_100_words = implode(' ', array_slice(str_word_count($cover_letter, 1), 0, 8));
                            ?>
                            <p><?php echo $first_100_words; ?>... <a data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $counter; ?>" href="<?php echo $row['cover_letter']; ?>">Read More</a></p>
                          </td>

                        <!-- Modal for view cover letter -->
                        <div class="modal fade" id="exampleModal<?php echo $counter; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content dashCont">
                              <div class="modal-header dashHead">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cover Letter</h1>
                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                              </div>
                              <div class="modal-body">
                                 <p class="text-white" style="font-size: 13px; word-spacing: 1px;"><?php echo $user_coverLetter; ?></p>
                              </div>
                              <div class="modal-footer dashFooter">
                                <button type="button" class="btn btn-secondary dashClose" data-bs-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>

                          <?php  
                          echo "<td style='font-size: 11px;'>" . $row['apply_date'] . "</td>";
                          echo "<td style='font-size: 11px;'>";
                          if ($row['status'] == 1) {
                              echo "<span class='badge rounded-pill bg-success'>Active</span>";
                          } else {
                              echo "<span class='badge rounded-pill bg-secondary'>Expired</span>";
                          }
                           echo"</td>";
                           echo "<td style='font-size: 11px;'>";
                          if ($row['candidate_status'] == 1) {
                              echo "<span class='badge rounded-pill bg-success'>Hired</span>";
                          } else if ($row['candidate_status'] == 2) {
                              echo "<span class='badge rounded-pill bg-secondary'>Rejected</span>";
                          }
                          else if ($row['candidate_status'] == 3) {
                              echo "<span class='badge rounded-pill bg-info'>Removed</span>";
                          }
                           echo"</td>";
                          echo '
                          <td> 
                          <div class="dropdown">
                            <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Action
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="hireSql.php?jobId='.$row['id'].'&userId='.$row['user_id'].'">Hire</a></li>
                              <li><a class="dropdown-item" href="rejectSql.php?jobId='.$row['id'].'&userId='.$row['user_id'].'">Reject</a> </li>
                              <li><a class="dropdown-item" href="removeSql.php?jobId='.$row['id'].'&userId='.$row['user_id'].'">Remove (candidate)</a></li>
                            </ul>
                          </div>
                          </td>';
                          echo "</tr>";
                          echo "</tbody>";
                      }
                 echo "</table>";

                      
                  } else {
                      echo "No Candidates found.";
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