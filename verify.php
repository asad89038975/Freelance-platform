<?php
session_start();

// Retrieve email from URL parameter
if (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Verification</title>
  <?php include "topcdn.php"; ?>
</head>
<body>
    <section class="vh-100 bg-image">
      <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-6 col-lg-5 col-xl-5">
              <div class="card" style="border-radius: 15px;">
                <div class="card-body p-5">
                    <?php
                      if (isset($_GET["success"]) && ($_GET["success"]) == 1) {
                          echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6">Please Verify Your Account! Go To Your <a href="https://gmail.com" target="_blank">Gmail</a>.<i class="bi bi-emoji-smile"></i></div>';
                      } 
                    ?>
                    <?php
                      if (isset($_GET["verified"]) && ($_GET["verified"]) == 0) {
                          echo '<div class="alert alert-warning px-3 py-1 fw-semibold fs-6">Incorrect Verification Code.<i class="bi bi-emoji-smile"></i></div>';
                      } 
                    ?>
                  <h2 class="text-uppercase text-center mb-5">Verification</h2>

                  <form method="POST" action="verifySql.php">
                    <div class="row d-flex align-items-center justify-content-center">

                      <div class="form-outline mb-3 col-lg-12 col-md-12 col-12">
                        <input type="num" id="verification_code" name="verification_code" class="form-control form-control-lg" required />
                        <label class="form-label" for="verification_code">Enter Verification Code</label>
                      </div>

                     </div>   

                    <div class="d-flex justify-content-center ">
                      <button type="submit"
                        class="btn w-50 btn-block btn-lg gradient-custom-4 text-body" style="color: #fff !important;">Send</button>
                    </div>

                    <p class="text-center text-white mt-4 mb-0">Already Verified? <a href="login.php"
                        class="fw-bold text-body" style="color: #0168ff !important;"><u> Login</u></a></p>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
  <?php include "bottomcdn.php"; ?>
</body>
</html>
