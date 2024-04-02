<?php
// Check if job_id and status are set in the URL
if (isset($_GET['job_id']) && isset($_GET['status'])) {
    // Get job_id and status from the URL
    $job_id = $_GET['job_id'];
    $status = $_GET['status'];

    // Include the database connection file
    include_once("../connection.php");

    // Check if the connection is successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare SQL statement to get the current status
    $sql_get_status = "SELECT status FROM freelance_job WHERE job_id = ?";
    $stmt_get_status = $connection->prepare($sql_get_status);
    $stmt_get_status->bind_param("i", $job_id);
    $stmt_get_status->execute();
    $stmt_get_status->store_result();

    // Check if any rows are returned
    if ($stmt_get_status->num_rows > 0) {
        // Fetch the result
        $stmt_get_status->bind_result($current_status);
        $stmt_get_status->fetch();
        
        // Calculate the new status
        $new_status = ($current_status == 1) ? 0 : 1;

        // Prepare SQL statement to update the status
        $sql_update_status = "UPDATE freelance_job SET status = ? WHERE job_id = ?";
        $stmt_update_status = $connection->prepare($sql_update_status);
        $stmt_update_status->bind_param("ii", $new_status, $job_id);
        $stmt_update_status->execute();

        // Close statements
        $stmt_get_status->close();
        $stmt_update_status->close();

        // Redirect back to the page after updating the database
        header("Location: manageJob.php?status=1");
        exit();
    } else {
        // If no rows are returned, redirect to an error page
        header("Location: manageJob.php?status=0");
        exit();
    }
} else {
    // Redirect to an error page if job_id and status are not set in the URL
    header("Location: manageJob.php?status=0");
    exit();
}
?>
