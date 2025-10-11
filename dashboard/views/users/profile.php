<?php
require_once __DIR__ . '/../includes/header.php';
$activePage = 'profile';
?>

<div class="page-header">
    <h1>My Profile</h1>
</div>

<div class="content-wrapper">
    <div class="profile-container">
        <div class="profile-sidebar">
            <div class="profile-avatar">
                <?php if (!empty($_SESSION['avatar'])): ?>
                    <img src="<?php echo SITE_URL . $_SESSION['avatar']; ?>" alt="Profile Picture">
                <?php else: ?>
                    <i class="fas fa-user-circle"></i>
                <?php endif; ?>
            </div>
            <h3><?php echo htmlspecialchars($_SESSION['full_name']); ?></h3>
            <p><?php echo ucfirst($_SESSION['role']); ?></p>
        </div>
        
        <div class="profile-content">
            <div class="profile-section">
                <h2>Personal Information</h2>
                <form id="profileForm" action="controllers/UserController.php?action=updateProfile" method="post">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($_SESSION['full_name']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="avatar">Profile Picture</label>
                        <input type="file" id="avatar" name="avatar" accept="image/*">
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="profile-section">
                <h2>Change Password</h2>
                <form id="passwordForm" action="controllers/UserController.php?action=changePassword" method="post">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" id="new_password" name="new_password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key"></i> Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>