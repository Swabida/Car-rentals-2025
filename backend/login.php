<?php
require_once __DIR__ . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && $user['password'] === $password) {
        // Start session and redirect
        session_start();
        $_SESSION['admin'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Invalid username or password'); window.history.back();</script>";
    }
}
?>



