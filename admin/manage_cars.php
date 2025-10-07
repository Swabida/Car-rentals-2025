<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}
include 'db.php';
$result = $conn->query("SELECT * FROM cars");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Cars | SwiftDrive</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="d-flex">
    <div class="sidebar bg-dark text-white p-3 vh-100">
      <h3 class="text-center mb-4"><i class="fa-solid fa-car"></i> SwiftDrive</h3>
      <ul class="nav flex-column">
        <li><a href="index.php" class="nav-link text-white"><i class="fa fa-gauge me-2"></i> Dashboard</a></li>
        <li><a href="bookings.php" class="nav-link text-white"><i class="fa fa-calendar-check me-2"></i> Bookings</a></li>
        <li><a href="manage_cars.php" class="nav-link text-white active"><i class="fa fa-car-side me-2"></i> Manage Cars</a></li>
        <li class="mt-auto"><a href="logout.php" class="nav-link text-danger"><i class="fa fa-sign-out-alt me-2"></i> Logout</a></li>
      </ul>
    </div>

    <div class="flex-grow-1 p-4">
      <h2 class="mb-4">Manage Cars</h2>
      <a href="add_car.php" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Add New Car</a>
      <table class="table table-striped table-hover bg-white shadow-sm">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['make'] ?></td>
              <td><?= $row['model'] ?></td>
              <td><?= $row['year'] ?></td>
              <td>$<?= $row['price'] ?></td>
              <td>
                <a href="view_car.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info text-white"><i class="fa fa-eye"></i></a>
                <a href="edit_car.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                <a href="delete_car.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
