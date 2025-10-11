<?php
require_once __DIR__ . '/../includes/header.php';
$activePage = 'blogs';
?>

<div class="page-header">
    <h1>Add New Blog</h1>
    <a href="index.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Blogs
    </a>
</div>

<div class="content-wrapper">
    <div class="form-container">
        <form id="blogForm" action="controllers/BlogController.php?action=add" method="post">
            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" id="title" name="title" required>
            </div>
            
            <div class="form-group">
                <label for="content">Content *</label>
                <textarea id="content" name="content" rows="10" required></textarea>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Blog
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