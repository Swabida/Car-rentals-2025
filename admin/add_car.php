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

  $stmt = $pdo->prepare("INSERT INTO cars (make,model,year,price,image) VALUES (?,?,?,?,?)");
  $stmt->execute([$id,$model,$year,$price,$description,$imageName]);
  header('Location: cars.php');
  exit;
}
?>
<!-- Simple form markup (use bootstrap) -->
