<?php
session_start();

function loginAdmin($email, $password, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM freelance_admin WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $admin = $stmt->fetch();

    if ($admin && $password === $admin['password']) {
        $_SESSION['email'] = $email;
        return true;
    } else {
        return false;
    }
}

function isAdminLoggedIn() {
    return isset($_SESSION['email']);
}

function logoutAdmin() {
    unset($_SESSION['email']);
}
?>
