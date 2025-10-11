<?php
require_once __DIR__ . '/../includes/header.php';

// Set page title and content
 $pageTitle = 'Login';
 $content = '
<div class="page-header">
    <h1>Login</h1>
    <a href="register.php" class="btn btn-secondary">
        <i class="fas fa-user-plus"></i> Register
    </a>
</div>

<div class="content-wrapper">
    <div class="form-container">
        <form id="loginForm" action="../../controllers/AuthController.php?action=login" method="post">
            <div class="form-group">
                <label for="username">Username *</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password *</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </div>
        </form>
    </div>
</div>';

// Include footer
require_once __DIR__ . '/../includes/footer.php';
?>