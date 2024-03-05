<?php
include "session.php";

if (isset($_POST['submit'])) {
    // Get user email from form
    $user_email = $_POST['user_email'];

    // Check if file is uploaded without errors
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        // File upload path
        $targetDir = "assets/images/";
        $fileName = basename($_FILES["img"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check file size
        if ($_FILES["img"]["size"] > 2000000) {
            // Implement image resizing logic here if needed
            // Example: You can use libraries like GD or ImageMagick to resize the image
        }

        // Move uploaded file to desired directory
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFilePath)) {
            // File uploaded successfully, update database
            $sql = "UPDATE remoteuser SET img = '$targetFilePath' WHERE email = '$user_email'";
            
            // Execute SQL query
            if ($connection->query($sql) === TRUE) {
                header("location: profile.php?status=3");
            } else {
                echo "Error updating record: " . $connection->error;
                header("location: profile.php?status=4");
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No file uploaded or an error occurred.";
    }
}
?>
