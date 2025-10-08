<?php
require_once __DIR__.'/../includes/db.php';
require_once __DIR__.'/../includes/auth.php';
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $make = $_POST['make'] ?? '';
  $year = (int)($_POST['year'] ?? 0);
  $price = (float)($_POST['price'] ?? 0);
  $description = $_POST['description'];
  $imageName = $_FILES['image'] ['name'];

  $imageName = null;
  if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $_FILES['image']['tmp_name']);
    finfo_close($finfo);
    $allowed = ['image/jpeg','image/png','image/gif'];
    if (!in_array($mime, $allowed)) die('Invalid image type.');
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $imageName = uniqid('car_', true) . '.' . $ext;
    $target = __DIR__ . '/../uploads/' . $imageName;
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      die('Upload failed.');
    }
  }

  $stmt = $pdo->prepare("INSERT INTO cars (id,model,year,price,description,image) VALUES (?,?,?,?,?)");
  $stmt->execute([$id,$model,$year,$price,$description,$imageName]);
  header('Location: cars.php');
  exit;
}
?>
<!-- Simple form markup (use bootstrap) -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Car</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <aside class="sidebar">
    <h2>S & I CAR RENTALS</h2>
    <ul>
      <li><a href="index.php">Dashboard</a></li>
      <li><a href="bookings.php">Bookings</a></li>
      <li><a href="add_car.php" class="active">Add Car</a></li>
      <li><a href="logout.php" class="logout">Logout</a></li>
    </ul>
  </aside>

  <main class="content">
    <h1>Add New Car</h1>
    <form method="POST" class="form-box">
      <input type="text" name="id" placeholder="Car id" required>
      <input type="text" name="model" placeholder="Model" required>
      <input type="number" name="year" placeholder="Year" required>
      <input type="number" name="price" placeholder="Price per day" required>
      <input type="text" name="description" placeholder="description" required>
      <input type="image" name="imageName" placeholder="Car image" required>
      <button type="submit">Add Car</button>
    </form>
    <?php if(isset($msg)) echo "<p class='success'>$msg</p>"; ?>
  </main>
</body>
</html>
