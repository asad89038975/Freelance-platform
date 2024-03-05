<?php
include_once "session.php";

$host = 'localhost';
$dbname = 'freelance';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}



// Retrieve form data
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare statement to check if email and password match
$stmt = $pdo->prepare("SELECT * FROM freelance_admin WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$admin = $stmt->fetch();

// Check if admin exists and password matches
if ($admin && $password === $admin['password']) {
    // Admin credentials are correct
    $_SESSION['email'] = $email; // Storing email in session
    header("Location: admin.php?admin=1");
} else {
    // Admin credentials are incorrect, redirect to index.php
    header("Location: index.php?admin=0");
    exit();
}
?>
