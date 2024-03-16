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
            $message = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Welcome to Our Website!</title>
            </head>
            <body style="font-family: Arial, sans-serif; background-color: #000; color: #fff; padding: 20px;">

              <table style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <tr>
                  <td align="center">
                    <img src="https://example.com/logo.png" alt="Company Logo" style="max-width: 200px; margin-top: 20px;">
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <h1 style="font-size: 58px; font-weight: 600; color: #0168ff;">Welcome to Our Website!</h1>
                    <p style="color: #000;">Thank you for registering with us. We are thrilled to have you on board!</p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p style="font-size: 16px; line-height: 1.6; color: #000;">Dear User,</p>
                    <p style="font-size: 16px; line-height: 1.6; color: #000;">Thank you for joining our community! We are excited to have you as a member and look forward to serving you.</p>
                    <p style="font-size: 16px; line-height: 1.6; color: #000;">If you have any questions or need assistance, feel free to reach out to us at <a href="mailto: aigeneration.pk@gmail.com">aigeneration.pk@gmail.com</a>.</p>
                    <p style="font-size: 16px; line-height: 1.6; color: #000;">Best regards,<br>Remote Job</p>
                  </td>
                </tr>
              </table>

            </body>
            </html>
            ';


            $headers = 'From: Remote Jobs <your@example.com>' . "\r\n" .
                       'Reply-To: your@example.com' . "\r\n" .
                       'X-Mailer: PHP/' . phpversion() . "\r\n" .
                       'Content-type: text/html; charset=UTF-8';

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
