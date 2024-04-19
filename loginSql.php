<?php
include("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Hash the entered password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Calculate expiration time for 15 days
    $expiration_time = time() + (86400 * 15); // 86400 seconds in a day

    // Check if the "Remember Me" checkbox is checked
    if (isset($_POST['remember']) && $_POST['remember'] == 'remember') {
        // Set cookie with email and hashed password
        setcookie('email', $email, $expiration_time, "/"); // Expiring in 15 days
        setcookie('password', $hashed_password, $expiration_time, "/"); // Expiring in 15 days
    } else {
        // Clear any existing cookies
        setcookie('email', '', time() - 3600, "/");
        setcookie('password', '', time() - 3600, "/");
    }

    // Using prepared statement to prevent SQL injection
    $sql = "SELECT email, password FROM remoteuser WHERE email = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Bind the result variables
    mysqli_stmt_bind_result($stmt, $db_email, $db_password);

    // Fetch the result
    mysqli_stmt_fetch($stmt);

    // Verify password
    if (mysqli_stmt_num_rows($stmt) == 1 && password_verify($password, $db_password)) {
        $_SESSION['login_user'] = $email;
        header("location: explore.php?success=1");
        exit; // Always exit after a header redirect
    } else {
        // Redirect with login failure indication
        header("location: login.php?status=invalid_login");
        exit; // Always exit after a header redirect
    }
}
?>
