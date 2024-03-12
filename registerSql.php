<?php
    session_start();
    include "connection.php";

    if (isset($_POST['submit'])) {

        $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $contact = mysqli_real_escape_string($connection, $_POST['contact']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $gender = mysqli_real_escape_string($connection, $_POST['gender']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $repassword = mysqli_real_escape_string($connection, $_POST['repassword']);
        $designation = mysqli_real_escape_string($connection, $_POST['designation']);
        $skill_desc = mysqli_real_escape_string($connection, $_POST['skill_desc']);

        // Check if the email already exists in the database
        $check_query = "SELECT * FROM remoteuser WHERE email='$email'";
        $check_result = mysqli_query($connection, $check_query);
        $existing_user = mysqli_fetch_assoc($check_result);
        
        if ($existing_user) {
            header("Location: register.php?existing_user=1");
            exit;
        }

        if ($password !== $repassword) {
            header("Location: register.php?password=1");
            exit;
        }

        // Generate a verification code
        $verification_code = rand(10,10000);

        $sql = "INSERT INTO remoteuser (fullname, email, contact, address, gender, password, designation, skill_desc, verification_code) 
                VALUES ('$fullname', '$email', '$contact', '$address', '$gender', '$password', '$designation', '$skill_desc', '$verification_code')";

        if (mysqli_query($connection, $sql)) {
            // Send verification email
$to = $email;
$subject = 'Verification Email';
$message = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
        }
        .verification-code {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .verification-code p {
            margin: 0;
            font-size: 16px;
            line-height: 1.5;
            color: #333333;
        }
        .verification-code h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333333;
        }
    </style>
</head>
<body>
    <div class="container" style="border: 1px solid #000;">
        <div class="logo">
            <h2 style="color: #0168ff;">Remote Job</h2>
        </div>
        <div class="verification-code">
            <h2>Verification Code</h2>
            <p>Your verification code is: ' . $verification_code . '</p>
        </div>
    </div>
</body>
</html>
';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Remote Job <your@example.com>' . "\r\n" .
           'Reply-To: your@example.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);


            $_SESSION['fullname'] = $fullname;
            $_SESSION['email'] = $email;
            header("Location: register.php?success=1");
            exit;
        } else {
            header("Location: register.php?error=1");
            exit;
        }

        mysqli_close($connection);
    }
?>
