<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}
include 'db.php';
$result = $conn->query("SELECT * FROM bookings");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bookings | SwiftDrive</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="d-flex">
    <div class="sidebar bg-dark text-white p-3 vh-100">
      <h3 class="text-center mb-4"><i class="fa-solid fa-car"></i> S & I CAR RENTALS</h3>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="index.php" class="nav-link text-white"><i class="fa fa-gauge me-2"></i> Dashboard</a></li>
        <li class="nav-item"><a href="bookings.php" class="nav-link text-white active"><i class="fa fa-calendar-check me-2"></i> Bookings</a></li>
        <li class="nav-item"><a href="add_car.php" class="nav-link text-white"><i class="fa fa-car-side me-2"></i> Cars</a></li>
        <li class="nav-item mt-auto"><a href="logout.php" class="nav-link text-danger"><i class="fa fa-sign-out-alt me-2"></i> Logout</a></li>
      </ul>
    </div>

    <div class="flex-grow-1 p-4">
      <h2 class="mb-4">All Bookings</h2>
      <table class="table table-striped table-hover bg-white shadow-sm">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>car_id</th>
            <th>customer_name</th>
            <th>Pick_up_date</th>
            <th>drop-off_date</th>
            <th>Pick_up_location</th>
            <th>drop-off_location</th>
            <th>total_price</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['car_id'] ?></td>
              <td><?= $row['customer_name'] ?></td>
              <td><?= $row['Pick_up_date'] ?></td>
              <td><?= $row['drop-off_date'] ?></td>
              <td><?= $row['Pick_up_location'] ?></td>
              <td><?= $row['drop_off_location'] ?></td>
              <td><?= $row['total_price'] ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>

