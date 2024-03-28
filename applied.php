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
  <section class="section exploreS" style="margin-top: 80px; margin-bottom: 150px !important;">
    <div class="container col-xxl-12 px-3 py-5">
          <div class="col-12 heading mt-3">
            <h3 class="text-white text-center my-4">Applied Jobs</h3>
          </div>
          <form>
            <?php
              include "connection.php";

              if ($connection) {
                  $sql = "SELECT * FROM apply_job WHERE user_email='$user_email'";
                  $result = $connection->query($sql);
                  $counter = 0;

                  if ($result->num_rows > 0) {
                     echo "<table class='table table-dark table-lg'>";
                      echo "<thead>
                      <tr>
                        <th scope='col'>No.</th>
                        <th scope='col'>Job Title</th>
                        <th scope='col'>Related Work</th>
                        <th scope='col'>Cover Letter</th>
                        <th scope='col'>Apply Date</th>
                        <th scope='col'>Status</th>
                        <th scope='col'>Action</th>
                      </tr>
                      </thead>";
                      while ($row = $result->fetch_assoc()) {   
                        $job_id = $row['job_id'];
                        $user_coverLetter = $row['cover_letter'];
                        $counter++;

                          echo "<tbody class='py-3'>";
                          echo "<tr>";?>
                          <th scope='row'><?php echo $counter; ?></th><?php
                          echo "<td style='font-size: 11px;'>" . $row['job_title'] . "</td>";
                          ?>
                          <td style='font-size: 11px;'>
                              <a href="<?php echo $row['related_work']; ?>" target="_blank">View Cover Letter</a>
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
                          echo '
                          <td> 
                          <div class="dropdown">
                            <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Action
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="editJob.php?jobId='.$row['job_id'].'&userId='.$row['user_id'].'">Edit (job)</a></li>
                            </ul>
                          </div>
                          </td>';
                          echo "</tr>";
                          echo "</tbody>";
                      }
                 echo "</table>";

                      
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
  </section>
  <?php include "footer.php" ?>
  <?php include "bottomcdn.php" ?>
</body>
</html>