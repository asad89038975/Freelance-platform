<?php
session_start();
include "connection.php"; // Assuming this file contains your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $verification_code = mysqli_real_escape_string($connection, $_POST['verification_code']);
    
    // Retrieve email from session
    if(isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    } else {
        // Handle the case where email is not available in the session
        header("Location: verify.php?error=email_not_found");
        exit;
    }

    // Check if the verification code matches the one stored in the database
    $check_query = "SELECT * FROM remoteuser WHERE email='$email' AND verification_code='$verification_code'";
    $check_result = mysqli_query($connection, $check_query);
    $existing_user = mysqli_fetch_assoc($check_result);
    
    if ($existing_user) {
        // Verification successful, update the "verified" column in the database
        $update_query = "UPDATE remoteuser SET verified = 1 WHERE email='$email'";
        if (mysqli_query($connection, $update_query)) {
            // Redirect to login page with verification success message
            header("Location: login.php?verified=1");
            // Send verification success email to user
            $to = $email;
            $subject = 'Welcome to Our Site';
            $message = "Dear User,\n\n";
            $message .= "I hope you are doing well.\n\n";
            $message .= 'Welcome to our site 😊';
            $message .= "Good to see you!\n\n";
            $message .= "Regards,\nRemote Job";

            $headers = 'From: Remote Jobs <your@example.com>' . "\r\n" .
                'Reply-To: your@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            // Send the email
            mail($to, $subject, $message, $headers);

            exit;
        } else {
            // Handle database update error
            header("Location: verify.php?error=database_update_error");
            exit;
        }
    } else {
        // Verification failed, redirect back to verification page
        header("Location: verify.php?verified=0");
        exit;
    }
} else {
    // Handle invalid request method
    header("Location: verify.php?error=invalid_request_method");
    exit;
}

mysqli_close($connection);
?>
