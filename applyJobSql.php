<?php
require_once "connection.php"; // Include the connection file

if(isset($_POST['submit'])) {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $user_email = $_POST['user_email'];
    $job_title = $_POST['job_title'];
    $jobid = $_POST['jobid'];
    $cover_letter = $_POST['cover_letter'];
    
    // Check if a file is selected
    if(isset($_FILES['work']) && $_FILES['work']['error'] === UPLOAD_ERR_OK) {
        // Validate file type
        $allowed_types = array('image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/mpeg', 'application/pdf');
        $file_type = $_FILES['work']['type'];
        
        if(in_array($file_type, $allowed_types)) {
            // File type is allowed
            $related_work = $_FILES['work']['name'];
            
            try {
                // Prepare SQL insert statement
                $sql = "INSERT INTO apply_job (user_id, user_email, job_title, job_id, cover_letter, related_work) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $connection->prepare($sql);

                // Bind parameters
                $stmt->bind_param("ssssss", $user_id, $user_email, $job_title, $jobid, $cover_letter, $related_work);

                // Execute the query
                if ($stmt->execute()) {
                    // Insertion successful
                    // Move uploaded file to desired location if needed
                    move_uploaded_file($_FILES['work']['tmp_name'], 'desired_upload_path/' . $_FILES['work']['name']);
                    header("location: applyJob.php?success=1&jobid=$jobid&user_d=$user_id");
                } else {
                    // Insertion failed
                    echo "Error: " . $sql . "<br>" . $stmt->error;
                    header("location: applyJob.php?success=0&jobid=$jobid&user_d=$user_id");
                }

                // Close the statement and connection
                $stmt->close();
                $connection->close();
            } catch(Exception $e) {
                // Handle any exceptions
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Invalid file type
            echo "Error: Invalid file type. Allowed types are: image (JPEG, PNG, GIF), video (MP4, MPEG), PDF.";
        }
    } else {
        // No file selected or file upload error
        echo "Error: Please select a file to upload.";
    }
}
?>
