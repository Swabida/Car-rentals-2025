<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $car_id = $_POST['car_id'];
    $customer_name = $_POST['user_name'];
    $pick_up_date = $_POST['pick_up_date'];
    $drop_off_date = $_POST['drop_off_date'];
    $pick_up_location = $_POST['pick_up_location'];
    $drop_off_location = $_POST['drop_off_location'];
    $total_price = $_POST['total_price'];


    $sql = "INSERT INTO bookings (car_id, user_name, pickup_date, return_date, status) 
            VALUES ('id','$car_id', '$customer_name', '$pick_up_date', '$drop_off_date', 'pending')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Booking successful!'); window.location.href='../frontend/index.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
requireAdmin();

$bookings = $pdo->query("SELECT * FROM bookings ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Bookings</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <h3>Bookings</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th><th>Customer</th><th>Email</th><th>Car ID</th><th>Status</th><th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($bookings as $b): ?>
      <tr>
        <td><?= $b['id'] ?></td>
        <td><?= htmlspecialchars($b['user_name']) ?></td>
        <td><?= htmlspecialchars($b['user_email']) ?></td>
        <td><?= $b['car_id'] ?></td>
        <td><?= htmlspecialchars($b['status']) ?></td>
        <td><a href="view_booking.php?id=<?= $b['id'] ?>" class="btn btn-info btn-sm">View</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>

