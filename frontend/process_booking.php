<?php
$host = 'localhost';
$dbname = 'car_db'; // change to your database name
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Connection successful, don't run any queries here
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $car_id = $_POST['car_id'];
    $customer_name = $_POST['user_name'];
    $pick_up_date = $_POST['pick_up_date'];
    $drop_off_date = $_POST['drop_off_date'];
    $pick_up_location = $_POST['pick_up_location'];
    $drop_off_location = $_POST['drop_off_location'];
    $total_price = $_POST['total_price'];
  

  $sql = "INSERT INTO bookings (id, car_id, customer_name, pickup_date, drop_off_date, pickup_location, drop_off_location, total_price)
          VALUES ('$id', '$car_id', '$user_name', '$pick_up_date', '$drop_off_date', '$pick_up_location', '$drop_off_location', '$total_price')";

  if ($conn->query($sql) === TRUE) {
    echo "<h2>✅ Booking Successful!</h2><p>Thank you, $name. We'll contact you soon.</p>";
  } else {
    echo "Error: " . $conn->error;
  }

  $conn->close();
}
?>