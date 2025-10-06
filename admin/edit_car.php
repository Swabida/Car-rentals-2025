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
<html>
<head><title>Edit Car</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <h3>Edit Car</h3>
  <form method="POST">
    <div class="mb-3"><label>Make</label><input type="text" name="make" class="form-control" value="<?= htmlspecialchars($car['make']) ?>" required></div>
    <div class="mb-3"><label>Model</label><input type="text" name="model" class="form-control" value="<?= htmlspecialchars($car['model']) ?>" required></div>
    <div class="mb-3"><label>Year</label><input type="number" name="year" class="form-control" value="<?= htmlspecialchars($car['year']) ?>" required></div>
    <div class="mb-3"><label>Price</label><input type="text" name="price" class="form-control" value="<?= htmlspecialchars($car['price']) ?>" required></div>
    <button class="btn btn-primary">Update</button>
  </form>
</body>
</html>
