<?php
require_once __DIR__ . '/../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S & I CAR RENTALS</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <nav class="sidebar">
        <div class="logo">
            <h2><i class="fas fa-car">S & I CAR RENTALS</h2>
        </div>
        
        <ul class="nav-links">
            <li>
                <a href="<?php echo SITE_URL; ?>/index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
        
                <li>
                    <a href="<?php echo SITE_URL; ?>/views/cars/index.php" class="<?php echo isset($activePage) && $activePage == 'cars' ? 'active' : ''; ?>">
                        <i class="fas fa-car"></i>
                        <span>Cars</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo SITE_URL; ?>/views/rentals/index.php" class="<?php echo isset($activePage) && $activePage == 'rentals' ? 'active' : ''; ?>">
                        <i class="fas fa-calendar-check"></i>
                        <span>Rentals</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo SITE_URL; ?>/views/profile.php" class="<?php echo isset($activePage) && $activePage == 'profile' ? 'active' : ''; ?>">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo SITE_URL; ?>/includes/logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo SITE_URL; ?>/views/login.php">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo SITE_URL; ?>/views/register.php">
                        <i class="fas fa-user-plus"></i>
                        <span>Register</span>
                    </a>
                </li>
        </ul>
    </nav>
</body>
</html>
