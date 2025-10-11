<?php
require_once __DIR__ . '/../includes/header.php';
$activePage = 'blogs';
?>

<div class="page-header">
    <h1>Edit Blog</h1>
    <a href="index.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Blogs
    </a>
</div>

<?php
// Check if blog ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    displayMessage("Blog ID is required.", 'error');
    redirect('/views/blogs/index.php');
}

$blogId = (int)$_GET['id'];

// Get blog data
$blog = [
    'id' => 1,
    'title' => 'Top 5 Luxury Cars of 2023',
    'content' => 'Discover the most luxurious cars released in 2023. These vehicles offer unparalleled comfort, performance, and style. From the latest supercars to elegant sedans, we showcase the best of the best.',
    'author' => 'John Manager',
    'created_at' => '2023-05-15',
    'updated_at' => '2023-05-15'
];
?>

<div class="content-wrapper">
    <div class="form-container">
        <form id="blogForm" action="controllers/BlogController.php?action=edit&id=<?php echo $blogId; ?>" method="post">
            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="content">Content *</label>
                <textarea id="content" name="content" rows="10" required><?php echo htmlspecialchars($blog['content']); ?></textarea>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Blog
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