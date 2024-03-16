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
            font-family: "Muli", sans-serif !important;
            background: #000;
            color: #fff;
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
            border-radius: 10px;
            box-shadow: 3px 3px 3px 3px #0a58ca7a;
        }
        .verification-code p {
            margin: 0;
            font-size: 16px;
            line-height: 1.5;
            color: #fff;
        }
        .verification-code h2 {
            margin-top: 0;
            font-size: 24px;
            color: #fff;
        }
    </style>
</head>
<body style="background-color: #000 !important;">
    <div class="container my-5">
        <div class="logo">
            <h2 class="fs-1" style="color: #0168ff;">Remote Job</h2>
        </div>
        <div class="verification-code mb-5" style="background: transparent; box-shadow: 3px 3px 3px 3px #0a58ca7a !important;">
            <h2 style="color: #000 !important;">Verification Code</h2>
            <p style="color: #000 !important;">Your verification code is: ' . $verification_code . '</p>
        </div>
    </div>
</body>
</html>
';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Remote Jobs <your@example.com>' . "\r\n" .
           'Reply-To: your@example.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);


            $_SESSION['fullname'] = $fullname;
            $_SESSION['email'] = $email;
            header("Location: verify.php?success=1&email=" . urlencode($email));
            exit;
        } else {
            header("Location: register.php?error=1");
            exit;
        }

        mysqli_close($connection);
    }
?>
