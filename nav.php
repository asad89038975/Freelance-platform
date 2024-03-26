<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
  <div class="container">
    <a class="navbar-brand text-light fs-3 fw-bold text-uppercase me-5" href="explore.php">Remote Job</a>
    <button class="navbar-toggler" style="background-color: #fff !important; font-size: 14px;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active me-2" aria-current="page" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#joinS">Why Join</a>
        </li>
      </ul>
      <div class="d-flex">
       <?php 
    if(isset($_SESSION['login_user'])) {
?>
    <!-- profile card -->
    <div>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu" style="background: none !important;"> 
            <li class="nav-item dropdown" style="background: none !important; padding: 0px !important;">
                <a class="nav-link dropdown-toggle" style="background: none !important; padding: 5px 12px !important;" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-pic">
                        <?php
                            include "connection.php";

                            $sql = "SELECT img FROM remoteuser WHERE email = '$user_email'";
                            $result = mysqli_query($connection, $sql);

                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    // Note the use of double quotes for string interpolation
                                    echo "<img class='pImg' src='" . $row['img'] . "'>";
                                } else {
                                    echo "<img class='pImg' src='https://source.unsplash.com/250x250?girl'>";
                                }
                            } else {
                                // If the query fails, display an error message
                                echo "Error: " . mysqli_error($connection);
                            }

                            mysqli_close($connection);
                            ?>
                        <img src="" alt="Profile Picture">
                    </div>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <!-- <li><a class="dropdown-item" href="#"><i class="fas fa-sliders-h fa-fw"></i> Account</a></li> -->
                    <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user fa-fw"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="applied.php"><i class="fas fa-briefcase fa-fw"></i> Applied Jobs</a></li>
                    <!-- <li><hr class="dropdown-divider"></li> -->
                    <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- profile card -->
<?php } else {?>
    <a class="nav_btnL btn btn-md me-2" href="login.php"><i class="bi bi-person-lock"></i> Login</a>
    <a class="nav_btnS btn btn-md" href="register.php">Sign Up</a>
<?php } ?>

          
          
      </div>
    </div>
  </div>
</nav>