<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <?php include "topcdn.php"; ?>
</head>
<body>
    <section class="vh-100 bg-image">
      <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-12 col-lg-10 col-xl-10">
              <div class="card" style="border-radius: 15px;">
                <div class="card-body p-5">
                  <?php
                    if (isset($_GET["success"]) == 1) {
                        echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6">Hurrah ! Successfully Registered ! <i class="bi bi-emoji-smile"></i></div>';
                    } 
                    ?>

                    <?php
                    if (isset($_GET["error"]) == 1) {
                        echo '<div class="alert alert-danger px-3 py-1 fw-semibold fs-6">Oops ! You are missiong something. <i class="bi bi-emoji-frown"></i></div>';
                    } 
                    ?>

                    <?php
                    if (isset($_GET["password"]) == 1) {
                        echo '<div class="alert alert-warning px-3 py-1 fw-semibold fs-6">Oops ! Password not matched ! <i class="bi bi-emoji-dizzy"></i></div>';
                    } 
                  ?>
                  <?php
                    if (isset($_GET["existing_user"]) == 1) {
                        echo '<div class="alert alert-warning px-3 py-1 fw-semibold fs-6">Oops ! Email Already Exist ! <i class="bi bi-emoji-dizzy"></i></div>';
                    } 
                  ?>

                  <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                  <form method="POST" action="registerSql.php" required>
                    <div class="row d-flex align-items-center justify-content-center">

                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
                        <input type="text" id="form3Example1cg" name="fullname" class="form-control form-control-md" required />
                        <label class="form-label" for="form3Example1cg">Full Name</label>
                      </div>

                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
                        <input type="email" id="form3Example3cg" name="email" class="form-control form-control-md" required />
                        <label class="form-label" for="form3Example3cg">Your Email</label>
                      </div>

                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
                        <input type="text" id="form5" name="contact" class="form-control form-control-md" required />
                        <label class="form-label" for="form5">Contact No.</label>
                      </div>

                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
                        <input type="text" id="form6" name="address" class="form-control form-control-md" required />
                        <label class="form-label" for="form6">Address</label>
                      </div>

                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
                        <input type="text" id="form7" name="gender" class="form-control form-control-md" required />
                        <label class="form-label" for="form7">Gender</label>
                      </div>

                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
                        <input type="password" name="password" id="form3Example4cg" class="form-control form-control-md" required />
                        <label class="form-label" for="form3Example4cg">Password</label>
                      </div> 

                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
                        <input type="password" name="repassword" id="form3Example4cdg" class="form-control form-control-md" required />
                        <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                      </div>

                      <div class="form-outline mb-3 col-lg-6 col-md-12 col-12">
                        <input type="text" id="form8" name="designation" class="form-control form-control-md" required />
                        <label class="form-label" for="form8">Designation</label>
                      </div>

                      <div class="form-outline mb-3 col-lg-12 col-md-12 col-12">
                        <textarea type="text" name="skill_desc" id="form9" class="form-control form-control-md" rows="4" required ></textarea>
                        <label class="form-label" for="form9">Describe Briefly Your Skills</label>
                      </div>

                     </div>   

                    <div class="d-flex justify-content-center">
                      <button type="submit"
                        class="btn w-50 btn-block btn-lg gradient-custom-4 text-body" value="submit" name="submit" style="color: #fff !important;">Register</button>
                    </div>

                    <p class="text-center text-white mt-4 mb-0">Have already an account? <a href="login.php"
                        class="fw-bold text-body" style="color: #0168ff !important;"><u> Login here</u></a></p>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
  <?php include "bottomcdn.php"; ?>
  <script>
      function validateForm(){
        var x = document.forms["myform"]["fname"].value;

        if (x == "" || x == null) {
          alert("Name must be filled");
          return false;
        }
      }
  </script>
</body>
</html>
