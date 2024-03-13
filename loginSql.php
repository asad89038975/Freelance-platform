<?php
include("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $mypassword = mysqli_real_escape_string($connection, $_POST['password']);

    // Calculate expiration time for 15 days
    $expiration_time = time() + (86400 * 15); // 86400 seconds in a day

    // Check if the "Remember Me" checkbox is checked
    if (isset($_POST['remember']) && $_POST['remember'] == 'remember') {
        // Set cookie with email and password (you may want to hash the password for security)
        setcookie('email', $email, $expiration_time, "/"); // Expiring in 15 days
        setcookie('password', $mypassword, $expiration_time, "/"); // Expiring in 15 days
    } else {
        // Clear any existing cookies
        setcookie('email', '', time() - 3600, "/");
        setcookie('password', '', time() - 3600, "/");
    }

    // Using prepared statement to prevent SQL injection
    $sql = "SELECT email, password FROM remoteuser WHERE email = ? AND password = ? AND verified = 1";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $mypassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Checking if a row was returned
    if (mysqli_stmt_num_rows($stmt) == 1) {
        $_SESSION['login_user'] = $email;
        header("location: explore.php?success=1");
        exit; // Always exit after a header redirect
    } else {
        // Check if there is no account with this email
        $check_email_query = "SELECT email FROM remoteuser WHERE email = ?";
        $check_email_stmt = mysqli_prepare($connection, $check_email_query);
        mysqli_stmt_bind_param($check_email_stmt, "s", $email);
        mysqli_stmt_execute($check_email_stmt);
        mysqli_stmt_store_result($check_email_stmt);
        if (mysqli_stmt_num_rows($check_email_stmt) == 0) {
            header("location: login.php?status=4");
            exit; // Always exit after a header redirect
        }

        // Redirect with login failure indication
        header("location: login.php?status=invalid_login");
        exit; // Always exit after a header redirect
    }
}
?>
