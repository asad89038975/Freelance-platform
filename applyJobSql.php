<?php
require_once "./connection.php"; // Include the connection file

if(isset($_POST['submit'])) {
    // Retrieve form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $designation = $_POST['designation'];
    $jobid = $_POST['jobid'];
    $skill_desc = $_POST['skill_desc'];

    try {
        // Prepare SQL insert statement
        $sql = "INSERT INTO apply_job (fullname, email, designation, job_id, skill_desc) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);

        // Bind parameters
        $stmt->bind_param("sssis", $fullname, $email, $designation, $jobid, $skill_desc);

        // Execute the query
        if ($stmt->execute()) {
            // Insertion successful
            header("location: applyJob.php?success=1&jobid=$jobid");
        } else {
            // Insertion failed
            echo "Error: " . $sql . "<br>" . $stmt->error;
            header("location: applyJob.php?success=0&jobid=$jobid");
        }

        // Close the statement and connection
        $stmt->close();
        $connection->close();
    } catch(Exception $e) {
        // Handle any exceptions
        echo "Error: " . $e->getMessage();
    }
}
?>
