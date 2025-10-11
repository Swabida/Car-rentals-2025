<?php
require_once __DIR__ . '/../includes/header.php';
$activePage = 'blogs';
?>

<div class="page-header">
    <h1>Blog Management</h1>
    <div class="header-actions">
        <a href="add.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Blog
        </a>
    </div>
</div>

<div class="content-wrapper">
    <div class="blogs-grid">
        <?php
        // Get blogs
        $blogs = [
            [
                'id' => 1,
                'title' => 'Top 5 Luxury Cars of 2023',
                'content' => 'Discover the most luxurious cars released in 2023...',
                'author' => 'John Manager',
                'created_at' => '2023-05-15',
                'updated_at' => '2023-05-15'
            ],
            [
                'id' => 2,
                'title' => 'Tips for Renting a Car',
                'content' => 'Learn how to get the best deals when renting a car...',
                'author' => 'Jane Smith',
                'created_at' => '2023-05-10',
                'updated_at' => '2023-05-10'
            ],
            [
                'id' => 3,
                'title' => 'Electric Cars: The Future',
                'content' => 'Explore the rise of electric vehicles and their impact...',
                'author' => 'Robert Johnson',
                'created_at' => '2023-05-05',
                'updated_at' => '2023-05-05'
            ]
        ];

        foreach ($blogs as $blog) {
            echo '
                <div class="blog-card">
                    <div class="blog-header">
                        <h3>' . $blog['title'] . '</h3>
                        <div class="blog-meta">
                            <span class="author">By ' . $blog['author'] . '</span>
                            <span class="date">' . date('F j, Y', strtotime($blog['created_at'])) . '</span>
                        </div>
                    </div>
                    <div class="blog-content">
                        <p>' . substr($blog['content'], 0, 150) . '...</p>
                    </div>
                    <div class="blog-actions">
                        <a href="view.php?id=' . $blog['id'] . '" class="btn btn-view">View</a>
                        <a href="edit.php?id=' . $blog['id'] . '" class="btn btn-edit">Edit</a>
                        <a href="#" class="btn btn-delete" data-id="' . $blog['id'] . '" data-action="delete">Delete</a>
                    </div>
                </div>
            ';
        }
        ?>
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
            <p>Are you sure you want to delete this blog post? This action cannot be undone.</p>
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
    
    let blogIdToDelete = null;
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            blogIdToDelete = this.getAttribute('data-id');
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
        if (blogIdToDelete) {
            window.location.href = `controllers/BlogController.php?action=delete&id=${blogIdToDelete}`;
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