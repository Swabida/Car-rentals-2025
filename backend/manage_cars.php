<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

$host = 'localhost';
$dbname = 'car_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// ✅ Fetch all cars from database
try {
    $stmt = $pdo->query("SELECT * FROM cars");
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching cars: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Cars | S & I CAR RENTALS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <style>
    body { background-color: #f5f6fa; }
    .card { border-radius: 15px; }
    .sidebar {
      width: 230px;
      background-color: #28569bff;
      color: white;
      min-height: 100vh;
    }
    .sidebar a {
      text-decoration: none;
      color: white;
      display: block;
      padding: 10px;
      border-radius: 8px;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: #1e3c72ff;
    }
  </style>
</head>
<body>
  <div class="d-flex">
    <div class="sidebar bg-dark text-white p-3 vh-100">
      <h3 class="text-center mb-4"><i class="fa-solid fa-car"></i> S & I CAR RENTALS</h3>
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
            <th>Model</th>
            <th>Year</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($cars): ?>
            <?php foreach ($cars as $row): ?>
              <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['model']) ?></td>
                <td><?= htmlspecialchars($row['year']) ?></td>
                <td>$<?= htmlspecialchars($row['price']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td>
                  <?php if (!empty($row['imageName'])): ?>
                    <img src="uploads/<?= htmlspecialchars($row['imageName']) ?>" alt="Car Image" width="80">
                  <?php else: ?>
                    No Image
                  <?php endif; ?>
                </td>
                <td>
                  <a href="view_car.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info text-white"><i class="fa fa-eye"></i></a>
                  <a href="edit_car.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                  <a href="delete_car.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="7" class="text-center">No cars found.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
