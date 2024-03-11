<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
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
                      if (isset($_GET["success"]) && ($_GET["success"]) == 0) {
                          echo '<div class="alert alert-danger px-3 py-1 fw-semibold fs-6">Not Verified Yet ! Go To Your <a href="https://gmail.com" target="_blank">Gmail</a> For Verify.<i class="bi bi-emoji-frown"></i></div>';
                      } 
                    ?>
                    <?php
                      if (isset($_GET["status"]) && ($_GET["status"]) == 3) {
                          echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6">Logout Successfully ! <i class="bi bi-emoji-frown"></i></div>';
                      } 
                    ?>
                  <h2 class="text-uppercase text-center mb-5">LOGIN</h2>

                  <form method="POST" action="loginSql.php">
                    <div class="row d-flex align-items-center justify-content-center">

                      <div class="form-outline mb-3 col-lg-12 col-md-12 col-12">
                        <input type="email" id="form3Example3cg" name="email" class="form-control form-control-lg" required />
                        <label class="form-label" for="form3Example3cg">Your Email</label>
                      </div>

                      <div class="form-outline mb-3 col-lg-12 col-md-12 col-12">
                        <div class="d-flex align-items-center justify-content-end">
                          <i type="button" class="bi bi-eye-fill mt-5 me-3" id="show_password" style="position: absolute;"></i>
                        </div>
                        <input type="password" name="password" id="password" class="form-control form-control-lg" required />
                        <label class="form-label" for="password">Your Password</label>
                      </div> 

                     </div>   

                    <div class="form-check d-flex justify-content-center mb-5">
                      <input class="form-check-input me-2" name="remember" type="checkbox" value="remember" id="form2Example3g" />
                      <label class="form-check-label" for="form2Example3g">
                        Remember Me
                      </label>
                    </div>

                    <!-- <div class="form-check d-flex justify-content-center mb-3">
                      <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                      <label class="form-check-label" for="form2Example3g">
                        I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                      </label>
                    </div> -->

                    <div class="d-flex justify-content-center ">
                      <button type="submit"
                        class="btn w-50 btn-block btn-lg gradient-custom-4 text-body" style="color: #fff !important;">Login</button>
                    </div>

                    <p class="text-center text-white mt-4 mb-0">Not registered yet? <a href="register.php"
                        class="fw-bold text-body" style="color: #0168ff !important;"><u> Sign Up</u></a></p>

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
