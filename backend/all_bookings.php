<?php
include 'db.php';
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
