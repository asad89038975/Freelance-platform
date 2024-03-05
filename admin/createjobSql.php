<?php
// Include the connection file
include_once("../connection.php");


// Check if the connection is successful
if ($connection) {
    // Retrieve values from POST method
    $title = $_POST['title'];
    $req_skill = $_POST['req_skill'];
    $skill_desc = $_POST['skill_desc'];
    $job_desc = $_POST['job_desc'];
    $job_price = $_POST['job_price'];
    $del_time = $_POST['del_time'];

    // SQL INSERT INTO statement
    $sql = "INSERT INTO freelance_job (title, req_skill, skill_desc, job_desc, job_price, del_time)
            VALUES 
            ('$title', '$req_skill', '$skill_desc', '$job_desc', '$job_price', '$del_time')";

    // Execute the SQL statement
    if ($connection->query($sql) === TRUE) {
        header("Location: createJob.php?job=1");
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
         header("Location: createJob.php?job=0");
    }

    // Close the database connection
    $connection->close();
} else {
    echo "Connection failed.";
}
?>
