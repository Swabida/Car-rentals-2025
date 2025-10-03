<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include "db.php";

// Add Car
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $conn->query("INSERT INTO cars (name, model, price) VALUES ('$name','$model','$price')");
}

// Delete Car
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM cars WHERE car_id=$id");
}

$result = $conn->query("SELECT * FROM cars");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Cars</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2>Manage Cars</h2>
  <form method="POST" class="mb-3 row g-2">
    <div class="col"><input type="text" name="name" class="form-control" placeholder="Car Name" required></div>
    <div class="col"><input type="text" name="model" class="form-control" placeholder="Model" required></div>
    <div class="col"><input type="number" step="0.01" name="price" class="form-control" placeholder="Price" required></div>
    <div class="col"><button type="submit" name="add" class="btn btn-primary">Add Car</button></div>
  </form>
  <table class="table table-bordered">
    <tr><th>ID</th><th>Name</th><th>Model</th><th>Price</th><th>Action</th></tr>
    <?php while($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $row['car_id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['model']; ?></td>
        <td>$<?php echo $row['price']; ?></td>
        <td><a href="?delete=<?php echo $row['car_id']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
      </tr>
    <?php } ?>
  </table>
  <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</div>
</body>
</html>
