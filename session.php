<?php
include('connection.php');
session_start();

// Check if the session variable is not set but cookies are present
if (!isset($_SESSION['login_user']) && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];

    // Using prepared statement to prevent SQL injection
    $sql = "SELECT email FROM remoteuser WHERE email = ? AND password = ? AND verified = 1";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // If a row is returned, the user is valid, so set the session variable
    if (mysqli_stmt_num_rows($stmt) == 1) {
        $_SESSION['login_user'] = $email;
    }
}

// Redirect to login page if user is not logged in
if (!isset($_SESSION['login_user'])) {
    header("location:login.php");
    exit();
}

// Retrieve user information from the database
$user_check = $_SESSION['login_user'];
$ses_sql = mysqli_query($connection,"SELECT email, password FROM remoteuser WHERE email = '$user_check'");
$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
$login_session = $row['email'];
?>
