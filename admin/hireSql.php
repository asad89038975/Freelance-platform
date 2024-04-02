<?php
// Check if jobId and userId are set in the URL
if (isset($_GET['jobId']) && isset($_GET['userId'])) {
    // Get jobId and userId from the URL
    $jobId = $_GET['jobId'];
    $userId = $_GET['userId'];

    include_once("../connection.php");

    // Prepare SQL statement
    $sql = "UPDATE apply_job SET candidate_status = 1 WHERE job_id = ? AND user_id = ?";
    
    // Prepare and bind parameters
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $jobId, $userId);

    // Execute the statement
    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $connection->close();

    // Send email notification
    $to = $_GET['user_email'];
    $subject = 'Work Accepted Notification';
    $message ='
        <!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Work Accepted Notification!</title>
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
                    <h4 style="font-size: 34px; font-weight: 600; color: #0168ff;">Congratulation Your work has accepted!</h4>
                    <p style="color: #000;">Thank you for work with us. We are thrilled to have you on board!</p>
                  </td>
                </tr>
                <tr>
                  <td>
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

    mail($to, $subject, $message, $headers);

    // Redirect back to the page after updating the database
    header("Location: appliedCandidate.php?status=1");
    exit();
} else {
    // Redirect to an error page if jobId and userId are not set in the URL
    header("Location: appliedCandidate.php?status=0");
    exit();
}
?>
