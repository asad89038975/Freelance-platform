<?php
    include("connection.php");
    session_start();
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $mypassword = mysqli_real_escape_string($connection, $_POST['password']); 
        
        // Check if the "Remember Me" checkbox is checked
        if(isset($_POST['remember']) && $_POST['remember'] == 'remember') {
            // Set cookie with email and password (you may want to hash the password for security)
            setcookie('email', $email, time() + (86400 * 30), "/"); // 86400 seconds = 1 day
            setcookie('password', $mypassword, time() + (86400 * 30), "/"); // Store password securely, or consider using a different approach
        } else {
            // Clear any existing cookies
            setcookie('email', '', time() - 3600, "/");
            setcookie('password', '', time() - 3600, "/");
        }
        
        // Using prepared statement to prevent SQL injection
        $sql = "SELECT email, password FROM remoteuser WHERE email = ? and password = ?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $mypassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        // Checking if a row was returned
        if(mysqli_stmt_num_rows($stmt) == 1) {
            $_SESSION['login_user'] = $email;
            header("location: explore.php?success=1");
            exit; // Always exit after a header redirect
        } else {
            // Redirect with login failure indication
            header("location: login.php?success=0");
            exit; // Always exit after a header redirect
        }
    }
?>
