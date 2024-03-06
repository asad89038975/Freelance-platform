<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <?php include "../topcdn.php"; ?>
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
    <section class="vh-100 bg-image">
      <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-8 col-md-5 col-lg-4 col-xl-4">
              <div class="card" style="border-radius: 15px;">
                <div class="card-body p-5">
                    <?php
                      if (isset($_GET["admin"]) && ($_GET["admin"]) == 3) {
                          echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6">Logout Successfully ! <i class="bi bi-emoji-smile"></i></div>';
                      } 
                    ?>
                    <?php
                      if (isset($_GET["admin"]) && ($_GET["admin"]) == 0) {
                          echo '<div class="alert alert-danger px-3 py-1 fw-semibold fs-6">You are not admin ! <i class="bi bi-emoji-frown"></i></div>';
                      } 
                    ?>
                  <h2 class="text-center mb-5">Admin-Login</h2>

                  <form method="POST" action="adminLogin.php">
                    <div class="row d-flex align-items-center justify-content-center">

                      <div class="form-outline mb-3 col-lg-12 col-md-12 col-12">
                        <input type="email" id="form3Example3cg" name="email" class="form-control form-control-lg" required />
                        <label class="form-label" for="form3Example3cg">Your Email</label>
                      </div>

                      <div class="form-outline mb-3 col-lg-12 col-md-12 col-12">
                        <input type="password" name="password" id="form3Example4cg" class="form-control form-control-lg" required />
                        <label class="form-label" for="form3Example4cg">Your Password</label>
                      </div> 

                     </div>   

                    <div class="d-flex justify-content-center ">
                      <button type="submit"
                        class="btn w-50 btn-block btn-lg gradient-custom-4 text-body" style="color: #fff !important;">Login</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
  <?php include "../bottomcdn.php"; ?>
</body>
</html>
