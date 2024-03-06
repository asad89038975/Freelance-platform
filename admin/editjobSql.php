<?php
include_once("../connection.php");

if ($connection) {
    $jobid = $_POST['jobid'];
    $title = $_POST['title'];
    $req_skill = $_POST['req_skill'];
    $skill_desc = $_POST['skill_desc'];
    $job_desc = $_POST['job_desc'];
    $job_price = $_POST['job_price'];
    $del_time = $_POST['del_time'];

    $sql = "UPDATE freelance_job SET title = '$title', req_skill = '$req_skill', skill_desc = '$skill_desc', job_desc = '$job_desc', job_price = '$job_price', del_time = '$del_time' WHERE job_id = '$jobid'";

    if ($connection->query($sql) === TRUE) {
        header("Location: editJob.php?job=1&jobid=$jobid");
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
         header("Location: editJob.php?job=0");
    }

    // Close the database connection
    $connection->close();
} else {
    echo "Connection failed.";
}
?>
