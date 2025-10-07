<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
requireAdmin();

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM cars WHERE id=?");
$stmt->execute([$id]);
$car = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $model = $_POST['model'];
  $year = $_POST['year'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $imageName = $_FILES['image'] ['name'];

  $update = $pdo->prepare("UPDATE cars SET id=?, model=?, year=?, price=?,description=?,imageName=?, WHERE id=?");
  $update->execute([$id, $model, $year, $price, $description,$imageName]);

  header("Location: cars.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Car | SwiftDrive</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <h2>Edit Car Details</h2>
  <form method="POST" class="bg-white p-4 shadow-sm rounded w-50">
    <div class="mb-3">
      <label>Make</label>
      <input type="text" name="make" value="<?= $car['make'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Model</label>
      <input type="text" name="model" value="<?= $car['model'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Year</label>
      <input type="number" name="year" value="<?= $car['year'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Price per Day</label>
      <input type="number" name="price" value="<?= $car['price'] ?>" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Update Car</button>
  </form>
</body>
</html>
