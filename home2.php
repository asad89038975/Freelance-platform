<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Freelance</title>
  <?php include "topcdn.php"; ?>
<style>
  @import url('https://fonts.googleapis.com/css?family=Muli&display=swap');
@import url('https://fonts.googleapis.com/css?family=Quicksand&display=swap');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body{
    font-family: 'Muli', sans-serif !important;
    background: #000;
      color: #fff;
}
/*nav section*/
.navbar{
  background-color: #0a58ca !important;
  color: #fff !important;
  box-shadow: 3px 3px 3px 3px #0a58ca6b;
}
.nav-link{
  color: #fff !important;
  font-size: 13px !important;
  font-weight: 500 !important;
  border-radius: 16px;
  padding: 7px 20px !important;
}
.nav-link:hover{
  color: #0a58ca !important;
  border-radius: 18px;
  background-color: #fff !important;
  font-size: 13px !important;
  font-weight: 500 !important;

}
.nav_btnL{
  color: #fff !important;
  font-size: 13px !important;
  font-weight: 500 !important;
}
.nav_btnS{
  color: #0a58ca !important;
  background-color: #fff !important;
  font-size: 13px !important;
  font-weight: 500 !important;
  border-radius: 18px;
  padding: 7px 20px;
}
.nav_btnS:hover{
  background-color: #dadada !important;
}

/*hero section*/

.fullscreen-section {
  height: 100vh;
  background-size: cover;
  background-position: center;
}
.background-filter {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-content: center;
  justify-content: center;
  flex-direction: column;
  background-color: rgba(0, 0, 0, 0.6); 
}

/*media query for hero section*/

@media (min-width: 768px) {
  .fullscreen-section {
    padding-top: 80px;
  }
}
/*.heroBg{
  height: 450px;
  width: 450px;
  border-radius: 50%;
}*/
.text-body-emphasis{
  color: #fff !important;
  font-size: 48px !important;
  font-weight: 600 !important;
  text-transform: uppercase;
  letter-spacing: 4px !important;
  line-height: 64px !important;
}
.remSpan{
  color: #0068ff !important; 
  font-size: 62px !important;
  font-weight: 700 !important;
}

</style>
</head>

<body>
  <!-- nav -->
  <?php include "nav.php"; ?>

  <main>

      <!-- hero section -->
      <section class="section fullscreen-section" style="background-image: url('assets/images/hero-bg2.jpg');">
        <div class="container col-xxl-12 px-4 py-5">
          <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <!-- <div class="col-12 col-sm-8 col-lg-6">
              <img src="assets/images/hero-bg.jpg" class="d-block mx-lg-auto img-fluid heroBg" alt="hero-bg" width="700" height="500" loading="lazy">
            </div> -->
            <!-- text field -->
            <div class="col-lg-12 background-filter">
              <div class="ms-lg-4">
                
                <h1 class="text-body-emphasis lh-1 mb-4">Find Genuine <span class="remSpan">Remote </span><br> job At Your DoorSTEP</h1>
                <p class="lead">"Discover and Apply to Remote Opportunities: Explore and Secure Verified Remote Jobs Tailored to Your Preferences."</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                  <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Primary</button>
                  <button type="button" class="btn btn-outline-secondary btn-lg px-4">Default</button>
                </div>

              </div>

            </div>
          </div>
        </div>
      </section>


  </main><!-- End #main -->

  <?php include "bottomcdn.php"; ?>

</body>

</html>