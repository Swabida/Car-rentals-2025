<?php
include 'db.php';
session_start();
$conn = new mysqli("localhost", "root", "", "car");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['Car_Type'])) {
    die("Login required to book a car.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Pick_up_Location = $_POST['$Pick_up_Location'];
    $Drop_off_Location = $_POST['Drop_off_Location'];
    $Pick_up_Date = $_POST['Pick-up Date'];
    $Drop_off_Date = $_POST['Drop_off_Date'];
    $Car_Type = $_POST['Car_Type'];
    $Drivers_Age = $_POST['Drivers_Age '];

    $sql = "INSERT INTO booking (Pick_up_Location,Drop_off_Location,ick_up_Date, Drop_off_Date, Car_Type,Drivers_Age)
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("", $Pick_up_Location, $Drop_off_Location, $Pick_up_Date, $Drop_off_Date, $Car_Type,$Drivers_Age);

    if ($stmt->execute()) {
        echo "Booking placed successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
