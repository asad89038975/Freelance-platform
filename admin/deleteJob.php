<?php
include_once("../connection.php");

if ($connection) {
    $jobid = $_GET['jobid'];

    // SQL query to delete data
    $sql = "DELETE FROM freelance_job WHERE job_id = '$jobid'";

    // Execute the query
    if ($connection->query($sql) === TRUE) {
        header("Location: manageJob.php?delete=1");
    } else {
        echo "Error deleting record: " . $connection->error;
        header("Location: manageJob.php?delete=0");
    }

    $connection->close();
} else {
    echo "Connection failed.";
}
?>
