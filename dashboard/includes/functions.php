<?php
// Function to format currency
function formatCurrency($amount) {
    return '$' . number_format($amount, 2);
}

// Function to display messages
function displayMessage($message, $type = 'info') {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
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
    if (file_exists(__DIR__ . '/../' . $imagePath)) {
        unlink(__DIR__ . '/../' . $imagePath);
    }
}
?>