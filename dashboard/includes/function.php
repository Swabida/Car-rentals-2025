<?php
require_once __DIR__ . '/../config/database.php';

// Function to display a styled message
function displayMessage($message, $type = 'info') {
    echo "<div class='alert alert-{$type}'>" . htmlspecialchars($message) . "</div>";
}

// Function to redirect user
function redirect($url) {
    header("Location: $url");
    exit();
}

// Function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to sanitize input
function sanitizeInput($input) {
    global $conn;
    return $conn->real_escape_string(trim($input));
}

// Function to format currency nicely
function formatCurrency($amount, $currency = '$') {
    if (!is_numeric($amount)) {
        return $currency . "0.00";
    }
    return $currency . number_format($amount, 2);
}

// Function to upload image
function uploadImage($file, $folder = 'cars') {
    if (!isset($file) || $file['error'] !== 0) {
        return false;
    }
    
    $uploadDir = __DIR__ . '/../assets/images/' . $folder . '/';
    
    // Create directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = uniqid() . '.' . $fileExtension;
    $filePath = $uploadDir . $fileName;
    
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        return '/assets/images/' . $folder . '/' . $fileName;
    }
    
    return false;
}

// Function to delete image
function deleteImage($imagePath) {
    $filePath = __DIR__ . '/../' . ltrim($imagePath, '/');
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}
?>
