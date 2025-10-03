<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include "db.php";

$cars = $conn->query("SELECT COUNT(*) AS total FROM cars")->fetch_assoc()['total'];
$bookings = $conn->query("SELECT COUNT(*) AS total FROM bookings")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="assets/css/dashboard.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark px-3">
  <span class="navbar-brand">Car Admin Dashboard</span>
  <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
</nav>
<div class="container mt-4">
  <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
  <div class="row mt-4">
    <div class="col-md-6">
      <div class="card text-bg-primary mb-3">
        <div class="card-body">
          <h5>Total Cars</h5>
          <h3><?php echo $cars; ?></h3>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card text-bg-success mb-3">
        <div class="card-body">
          <h5>Total Bookings</h5>
          <h3><?php echo $bookings; ?></h3>
        </div>
      </div>
    </div>
  </div>
  <a href="manage_cars.php" class="btn btn-primary">Manage Cars</a>
  <a href="manage_bookings.php" class="btn btn-success">Manage Bookings</a>
</div>
</body>
</html>
