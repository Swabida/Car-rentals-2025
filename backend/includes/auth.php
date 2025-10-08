<?php
// includes/auth.php
if (session_status() == PHP_SESSION_NONE) session_start();

function requireAdmin() {
  if (empty($_SESSION['admin_id'])) {
    header('Location: /admin/login.php');
    exit;
  }
}

function currentAdmin($pdo) {
  if (empty($_SESSION['admin_id'])) return null;
  $stmt = $pdo->prepare("SELECT id,username,email,fullname FROM admins WHERE id = ?");
  $stmt->execute([$_SESSION['admin_id']]);
  return $stmt->fetch();
}
