<?php
$host = 'localhost';
$dbname = "car_db";
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Connection successful, don't run any queries here
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
require_once 'backend/includes/auth.php';
requireAdmin();

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM bookings WHERE id=?");
$stmt->execute([$id]);
$b = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $status = $_POST['status'];
  $update = $pdo->prepare("UPDATE bookings SET status=? WHERE id=?");
  $update->execute([$status, $id]);
  header("Location: bookings.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>View Booking</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <h3>Booking Details</h3>
  <p><strong>id:</strong> <?= htmlspecialchars($b['user_name']) ?></p>
  <p><strong>car_id:</strong> <?= htmlspecialchars($b['user_email']) ?></p>
  <p><strong>customer_name:</strong> <?= $b['car_id'] ?></p>
  <p><strong>Pick_up_date:</strong> <?= $b['Pick_up_date'] ?></p>
  <p><strong>drop_off_date:</strong> <?= $b['drop_off_date'] ?></p>
  <p><strong>pick_up_location</strong> <?= $b['pick_up_location'] ?></p>
  <p><strong>drop_off_location</strong> <?= $b['drop_off_location'] ?></p>
  <p><strong>total_price</strong> <?= $b['total_price'] ?></p>
  <p><strong>Status:</strong> <?= $b['status'] ?></p>

  <form method="POST">
    <label>Update Status:</label>
    <select name="status" class="form-select mb-3">
      <option value="pending" <?= $b['status']=='pending'?'selected':'' ?>>Pending</option>
      <option value="confirmed" <?= $b['status']=='confirmed'?'selected':'' ?>>Confirmed</option>
      <option value="cancelled" <?= $b['status']=='cancelled'?'selected':'' ?>>Cancelled</option>
    </select>
    <button class="btn btn-primary">Update</button>
  </form>
</body>
</html>
