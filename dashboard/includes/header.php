<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
 $isLoggedIn = isset($_SESSION['user_id']);
 $userRole = $isLoggedIn ? $_SESSION['role'] : 'guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - <?php echo isset($pageTitle) ? $pageTitle : 'Dashboard'; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/dashboard.css">
    <?php if (isset($extraCss)): ?>
        <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/<?php echo $extraCss; ?>">
    <?php endif; ?>
</head>
<body>
    <div class="dashboard-container">
        <?php require_once __DIR__ . '/navigation.php'; ?>
        
        <div class="main-content">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">
                    <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                    ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($content)): ?>
                <?php echo $content; ?>
            <?php endif; ?>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo SITE_URL; ?>/js/script.js"></script>
    <?php if (isset($extraJs)): ?>
        <script src="<?php echo SITE_URL; ?>/js/<?php echo $extraJs; ?>"></script>
    <?php endif; ?>
</body>
</html>