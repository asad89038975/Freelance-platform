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
        <a href="admin.php" class="bar">Admin /</a><a href="addSkill.php" class="bar ms-2">Add Skill</a>
      </div>
      <div class="col-12 heading mt-3">
        <h3 class="text-white text-center">ADD Skill</h3>
      </div>
      <?php
        if (isset($_GET["skill"]) && ($_GET["skill"]) == 1) {
            echo '<div class="alert alert-success px-3 py-1 fw-semibold fs-6">Skill Added Successfully ! <i class="bi bi-emoji-smile"></i></div>';
        } 
      ?>
      <?php
        if (isset($_GET["skill"]) && ($_GET["skill"]) == 0) {
            echo '<div class="alert alert-danger px-3 py-1 fw-semibold fs-6">Oops, Something Missed ! <i class="bi bi-emoji-sad"></i></div>';
        } 
      ?>
      <form method="POST" action="addSkillSql.php">
        <div class="row d-flex align-items-center justify-content-center p-5">
          <div class="col-xxl-6 col-lg-6 col-md-6 col-12 form-group mb-3">
            <label for="skill_names" class="form-label">Skill Name:</label>
            <input type="text" class="form-control" id="skill_names" name="skill_name">
          </div>
          <div class="col-12 d-flex justify-content-center">
            <button type="submit"
              class="btn w-25 btn-block btn-lg gradient-custom-4 text-body" value="submit" name="submit" style="color: #fff !important;">Add</button>
          </div>
        </div>
      </form>      
    </div>
  </section>
<?php include "footer.php" ?>
<?php include "../bottomcdn.php" ?>
</body>
</html>    