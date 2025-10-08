<?php
session_start();
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
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}