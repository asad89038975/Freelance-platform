<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
  <div class="container">
    <a class="navbar-brand text-light fs-3 fw-bold text-uppercase me-5" href="explore.php">Remote Job</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active me-2" aria-current="page" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Why Join</a>
        </li>
      </ul>
      <div class="d-flex">
       <?php 
            if(isset($_SESSION['email'])) {
        ?>
      <a class="nav_btnL btn btn-md me-2" href="admin_logout.php"><i class="fas fa-sign-out-alt fa-fw"></i> Logout</a>
      <?php } else {?>
          <a class="nav_btnL btn btn-md me-2" href="login.php"><i class="bi bi-person-lock"></i> Login</a>
          <a class="nav_btnS btn btn-md" href="register.php">Sign Up</a>
      <?php } ?>

          
          
      </div>
    </div>
  </div>
</nav>