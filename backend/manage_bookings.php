<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include "db.php";

// Approve / Cancel booking
if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    $conn->query("UPDATE bookings SET status='approved' WHERE booking_id=$id");
}
if (isset($_GET['cancel'])) {
    $id = $_GET['cancel'];
    $conn->query("UPDATE bookings SET status='cancelled' WHERE booking_id=$id");
}

$result = $conn->query("SELECT b.booking_id, c.name AS car_name, b.user_name, b.pickup_date, b.return_date, b.status 
                        FROM bookings b 
                        JOIN cars c ON b.car_id=c.car_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Bookings</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2>Manage Bookings</h2>
  <table class="table table-bordered">
    <tr><th>ID</th><th>Car</th><th>User</th><th>Pickup</th><th>Return</th><th>Status</th><th>Action</th></tr>
    <?php while($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $row['booking_id']; ?></td>
        <td><?php echo $row['car_name']; ?></td>
        <td><?php echo $row['user_name']; ?></td>
        <td><?php echo $row['pickup_date']; ?></td>
        <td><?php echo $row['return_date']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td>
          <a href="?approve=<?php echo $row['booking_id']; ?>" class="btn btn-success btn-sm">Approve</a>
          <a href="?cancel=<?php echo $row['booking_id']; ?>" class="btn btn-danger btn-sm">Cancel</a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</div>
</body>
</html>
