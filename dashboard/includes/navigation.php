<?php
require_once __DIR__ . '/../config/config.php';
?>

<nav class="sidebar">
    <div class="logo">
        <h2><i class="fas fa-car"></i> <?php echo SITE_NAME; ?></h2>
    </div>
    
    <ul class="nav-links">
        <li>
            <a href="<?php echo SITE_URL; ?>/index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <?php if ($isLoggedIn): ?>
            <li>
                <a href="<?php echo SITE_URL; ?>/views/cars/index.php" class="<?php echo isset($activePage) && $activePage == 'cars' ? 'active' : ''; ?>">
                    <i class="fas fa-car"></i>
                    <span>Cars</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo SITE_URL; ?>/views/bookings/index.php" class="<?php echo isset($activePage) && $activePage == 'bookings' ? 'active' : ''; ?>">
                    <i class="fas fa-calendar-check"></i>
                    <span>Bookings</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo SITE_URL; ?>/views/blogs/index.php" class="<?php echo isset($activePage) && $activePage == 'blogs' ? 'active' : ''; ?>">
                    <i class="fas fa-blog"></i>
                    <span>Blogs</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo SITE_URL; ?>/views/users/index.php" class="<?php echo isset($activePage) && $activePage == 'users' ? 'active' : ''; ?>">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
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
        <?php else: ?>
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
        <?php endif; ?>
    </ul>
</nav>