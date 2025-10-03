<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make  = $_POST['make'];
    $model = $_POST['model'];
    $year  = $_POST['year'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Handle image upload
    $targetDir = "uploads/";
    $imageName = basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . time() . "_" . $imageName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $sql = "INSERT INTO cars (make, model, year, price, description, image) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdss", $make, $model, $year, $price, $description, $targetFile);

        if ($stmt->execute()) {
            echo "Car added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}
?>
