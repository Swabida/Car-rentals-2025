<?php
$host = 'localhost';
$dbname = 'car_db'; // change to your database name
$username = 'root';
$password = '';

try {
    // Use PDO for database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Admins only!");
}

$sql = "SELECT b.id, u.name, c.model, b.start_date, b.end_date, b.status
        FROM bookings b
        JOIN users u ON b.user_id = u.id
        JOIN cars c ON b.car_id = c.id";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "User: {$row['name']} | Car: {$row['make']} {$row['model']} | {$row['start_date']} → {$row['end_date']} | Status: {$row['status']}<br>";
}
?>
