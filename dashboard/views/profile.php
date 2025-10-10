<?php
require_once __DIR__ . '/../includes/header.php';
$activePage = 'profile';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Page Header -->
    <div class="page-header">
        <h1>My Profile</h1>
    </div>

    <!-- Profile Content -->
    <div class="content-wrapper">
        <div class="profile-container">

            <!-- Sidebar -->
            <div class="profile-sidebar">
                <div class="profile-avatar">
                    <?php if (!empty($_SESSION['avatar'])): ?>
                        <img src="<?= SITE_URL . htmlspecialchars($_SESSION['avatar']) ?>" alt="Profile Picture">
                    <?php else: ?>
                        <i class="fas fa-user-circle"></i>
                    <?php endif; ?>
                </div>

                <h3><?= htmlspecialchars($_SESSION['full_name'] ?? 'Unknown User') ?></h3>
                <p><?= ucfirst(htmlspecialchars($_SESSION['role'] ?? '')) ?></p>
            </div>

            <!-- Profile Details -->
            <div class="profile-content">

                <!-- Personal Information -->
                <div class="profile-section">
                    <h2>Personal Information</h2>
                    <form action="../../controllers/AuthController.php?action=updateProfile" 
                          method="POST" enctype="multipart/form-data">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input 
                                    type="text" 
                                    id="full_name" 
                                    name="full_name" 
                                    value="<?= htmlspecialchars($_SESSION['full_name'] ?? '') ?>"
                                >
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>"
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="avatar">Profile Picture</label>
                            <input 
                                type="file" 
                                id="avatar" 
                                name="avatar" 
                                accept="image/*"
                            >
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Change Password -->
                <div class="profile-section">
                    <h2>Change Password</h2>
                    <form action="../../controllers/AuthController.php?action=changePassword" method="POST">
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

            </div> <!-- End profile-content -->
        </div> <!-- End profile-container -->
    </div> <!-- End content-wrapper -->

    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
