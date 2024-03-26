<?php
// Check if jobId and userId are set in the URL
if (isset($_GET['jobId']) && isset($_GET['userId'])) {
    // Get jobId and userId from the URL
    $jobId = $_GET['jobId'];
    $userId = $_GET['userId'];

    include_once("../connection.php");

    // Prepare SQL statement
    $sql = "UPDATE apply_job SET candidate_status = 3 WHERE id = ? AND user_id = ?";
    
    // Prepare and bind parameters
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $jobId, $userId);

    // Execute the statement
    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $connection->close();

    // Redirect back to the page after updating the database
    header("Location: appliedCandidate.php?status=3");
    exit();
} else {
    // Redirect to an error page if jobId and userId are not set in the URL
    header("Location: appliedCandidate.php?status=0");
    exit();
}
?>
