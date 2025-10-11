<?php
require_once __DIR__ . '/../includes/header.php';
$activePage = 'users';
?>

<div class="page-header">
    <h1>Edit User</h1>
    <a href="index.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Users
    </a>
</div>

<?php
// Check if user ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    displayMessage("User ID is required.", 'error');
    redirect('/views/users/index.php');
}

$userId = (int)$_GET['id'];

// Get user data
$user = [
    'id' => 1,
    'username' => 'admin',
    'full_name' => 'System Administrator',
    'email' => 'admin@carrental.com',
    'role' => 'admin'
];
?>

<div class="content-wrapper">
    <div class="form-container">
        <form id="userForm" action="controllers/UserController.php?action=edit&id=<?php echo $userId; ?>" method="post">
            <div class="form-row">
                <div class="form-group">
                    <label for="full_name">Full Name *</label>
                    <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
                <small class="form-text text-muted">Username cannot be changed</small>
            </div>
            
            <div class="form-group">
                <label for="role">Role *</label>
                <select id="role" name="role" required>
                    <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                    <option value="manager" <?php echo $user['role'] == 'manager' ? 'selected' : ''; ?>>Manager</option>
                    <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update User
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>