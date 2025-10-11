<?php
require_once __DIR__ . '/../includes/header.php';
$activePage = 'users';
?>

<div class="page-header">
    <h1>User Management</h1>
    <div class="header-actions">
        <a href="add.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New User
        </a>
    </div>
</div>

<div class="content-wrapper">
    <div class="users-table-container">
        <table class="users-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Get users
                $users = [
                    [
                        'id' => 1,
                        'username' => 'admin',
                        'full_name' => 'System Administrator',
                        'email' => 'admin@carrental.com',
                        'role' => 'admin',
                        'created' => '2023-01-01'
                    ],
                    [
                        'id' => 2,
                        'username' => 'manager',
                        'full_name' => 'John Manager',
                        'email' => 'manager@carrental.com',
                        'role' => 'manager',
                        'created' => '2023-02-01'
                    ],
                    [
                        'id' => 3,
                        'username' => 'customer1',
                        'full_name' => 'John Doe',
                        'email' => 'customer1@example.com',
                        'role' => 'user',
                        'created' => '2023-03-01'
                    ]
                ];

                foreach ($users as $user) {
                    echo '
                        <tr>
                            <td>' . $user['id'] . '</td>
                            <td>' . $user['username'] . '</td>
                            <td>' . $user['full_name'] . '</td>
                            <td>' . $user['email'] . '</td>
                            <td><span class="role-badge ' . $user['role'] . '">' . ucfirst($user['role']) . '</span></td>
                            <td>' . $user['created'] . '</td>
                            <td>
                                <a href="edit.php?id=' . $user['id'] . '" class="btn btn-view">Edit</a>
                                <a href="profile.php?id=' . $user['id'] . '" class="btn btn-secondary">Profile</a>
                                <a href="#" class="btn btn-delete" data-id="' . $user['id'] . '" data-action="delete">Delete</a>
                            </td>
                        </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Confirm Deletion</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this user? This action cannot be undone.</p>
            <div class="modal-actions">
                <button id="cancelDelete" class="btn btn-secondary">Cancel</button>
                <button id="confirmDelete" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete button click handler
    const deleteButtons = document.querySelectorAll('.btn-delete');
    const deleteModal = document.getElementById('deleteModal');
    const confirmDeleteBtn = document.getElementById('confirmDelete');
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    const closeBtn = document.querySelector('.close');
    
    let userIdToDelete = null;
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            userIdToDelete = this.getAttribute('data-id');
            deleteModal.style.display = 'block';
        });
    });
    
    // Close modal
    closeBtn.addEventListener('click', function() {
        deleteModal.style.display = 'none';
    });
    
    cancelDeleteBtn.addEventListener('click', function() {
        deleteModal.style.display = 'none';
    });
    
    // Confirm delete
    confirmDeleteBtn.addEventListener('click', function() {
        if (userIdToDelete) {
            window.location.href = `controllers/UserController.php?action=delete&id=${userIdToDelete}`;
        }
    });
    
    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target == deleteModal) {
            deleteModal.style.display = 'none';
        }
    });
});
</script>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>