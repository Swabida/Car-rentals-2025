<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = $_POST['car_id'];
    $user_name = $_POST['user_name'];
    $pickup_date = $_POST['pickup_date'];
    $return_date = $_POST['return_date'];

    $sql = "INSERT INTO bookings (car_id, user_name, pickup_date, return_date, status) 
            VALUES ('$car_id', '$user_name', '$pickup_date', '$return_date', 'pending')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Booking successful!'); window.location.href='../frontend/index.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
