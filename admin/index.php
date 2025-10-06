<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();
$admin = currentAdmin($pdo);

// Example counts
$c1 = $pdo->query("SELECT COUNT(*) FROM cars")->fetchColumn();
$b1 = $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn();
?>
<!doctype html>
<html><head><title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<nav class="mb-3"><a href="cars.php">Cars</a> | <a href="bookings.php">Bookings</a> | <a href="logout.php">Logout</a></nav>
<h2>Welcome, <?=htmlspecialchars($admin['username'])?></h2>
<div class="row mt-3">
  <div class="col-md-3"><div class="card p-3">Cars<br><strong><?=$c1?></strong></div></div>
  <div class="col-md-3"><div class="card p-3">Bookings<br><strong><?=$b1?></strong></div></div>
</div>
</body></html>
