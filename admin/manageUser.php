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
	<?php include "../topcdn.php" ?>
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>

	<?php include "nav.php" ?>
  <section class="section exploreS" style="margin-top: 80px; margin-bottom: 150px !important;">
    <div class="container col-xxl-12 px-3 py-5">
      <div class="py-2 px-2" style="background-color: #0a58ca38 !important; border-radius: 5px;">
        <a href="admin.php" class="bar">Admin /</a><a href="createJob.php" class="bar ms-2">create Job</a>
      </div>
          <div class="col-12 heading mt-3">
            <h3 class="text-white text-center">MANAGE USER</h3>
          </div>
             <?php
              if (isset($_GET["delete"]) && ($_GET["delete"]) == 1) {
                  echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6">User Deleted Successfully ! <i class="bi bi-emoji-smile"></i></div>';
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
                  $sql = "SELECT * FROM remoteuser WHERE status=1 AND BAN=0";
                  $result = $connection->query($sql);
                  $counter = 0;

                  if ($result->num_rows > 0) {
                     echo "<table class='table table-dark table-lg' border='1'>";
                      echo "<thead>
                      <tr class='border-bottom'>
                        <th scope='col'>No.</th>
                        <th scope='col'>Full Name</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>Contact No.</th>
                        <th scope='col'>Address</th>
                        <th scope='col'>Gender</th>
                        <th scope='col'>Password</th>
                        <th scope='col'>Designation</th>
                        <th scope='col'>Skill Desc.</th>
                        <th scope='col'>Image</th>
                        <th scope='col'>Ban</th>
                        <th scope='col'>Reg. Date</th>
                        <th scope='col'>Status</th>
                        <th scope='col'>Action</th>
                      </tr>
                      </thead>";
                      while ($row = $result->fetch_assoc()) { 
                      $user_id = $row['user_id'];  
                        $counter++;

                          echo "<tbody class='py-3'>";
                          echo "<tr>";?>
                          <th scope='row'><?php echo $counter; ?></th><?php
                          echo "<td style='font-size: 11px;'>" . $row['fullname'] . "</td>";
                          echo "<td style='font-size: 11px;'>" . $row['email'] . "</td>";
                          echo "<td style='font-size: 11px;'>" . $row['contact'] . "</td>";
                          echo "<td style='font-size: 11px;'>" . $row['address'] . "</td>";
                          echo "<td style='font-size: 11px;'>" . $row['gender'] . "</td>";
                          echo "<td style='font-size: 11px;'>" . $row['password'] . "</td>";
                          echo "<td style='font-size: 11px;'>" . $row['designation'] . "</td>";
                          echo "<td style='font-size: 11px;'>" . $row['skill_desc'] . "</td>";
                          echo "<td style='font-size: 11px;'>" . $row['img'] . "</td>";
                          echo "<td style='font-size: 11px;'>";

                          	if ($row['ban'] == 0) {
                              echo "<span class='badge rounded-pill bg-success'>Active</span>";
                          } else {
                              echo "<span class='badge rounded-pill bg-secondary'>Ban</span>";
                          }
                          echo "</td>";

                          echo "<td style='font-size: 11px;'>" . $row['entry_date'] . "</td>";
                          echo "<td style='font-size: 11px;'>";

                          if ($row['status'] == 1) {
                              echo "<i class='bi bi-toggle-on text-success'></i>";
                          } else {
                              echo "<i class='bi bi-toggle-off'></i>";
                          }
                           
                           echo"</td>";
                          echo "<td> 
                          <a class='btn btn-sm btn-danger' style='font-size: 11px;' href='deleteUser.php?userid=$user_id'>Delete</a> 
                          </td>";
                          echo "</tr>";
                          echo "</tbody>";
                      }
                 echo "</table>";

                      
                  } else {
                      echo "No Users found.";
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