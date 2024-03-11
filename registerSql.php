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
        $verification_code = md5(uniqid(rand(), true));

        $sql = "INSERT INTO remoteuser (fullname, email, contact, address, gender, password, designation, skill_desc, verification_code) 
                VALUES ('$fullname', '$email', '$contact', '$address', '$gender', '$password', '$designation', '$skill_desc', '$verification_code')";

        if (mysqli_query($connection, $sql)) {
            // Send verification email
            $to = $email;
            $subject = 'Verification Email';
            $message = 'Please click the following link to verify your email: https://localhost/Freelance-platform/verify.php?code=' . $verification_code;
            $headers = 'From: Remote Job' . "\r\n" .
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
