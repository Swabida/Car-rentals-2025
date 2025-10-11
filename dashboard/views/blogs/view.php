<?php
require_once __DIR__ . '/../includes/header.php';
$activePage = 'blogs';
?>

<div class="page-header">
    <h1>Blog Post</h1>
    <div class="header-actions">
        <a href="edit.php?id=<?php echo $blog['id']; ?>" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="index.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Blogs
        </a>
    </div>
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
    'content' => 'Discover the most luxurious cars released in 2023. These vehicles offer unparalleled comfort, performance, and style. From the latest supercars to elegant sedans, we showcase the best of the best.

    1. **Mercedes-Benz S-Class**: The epitome of luxury and technology.
    2. **BMW 7 Series**: Combines performance with opulent comfort.
    3. **Audi A8**: Offers a perfect blend of innovation and elegance.
    4. **Rolls-Royce Ghost**: The pinnacle of bespoke luxury.
    5. **Bentley Continental GT**: Unmatched grand touring experience.

    Each of these vehicles represents the pinnacle of automotive excellence, offering features that redefine luxury and performance.',
    'author' => 'John Manager',
    'created_at' => '2023-05-15',
    'updated_at' => '2023-05-15'
];
?>

<div class="content-wrapper">
    <div class="blog-post">
        <div class="blog-header">
            <h1><?php echo htmlspecialchars($blog['title']); ?></h1>
            <div class="blog-meta">
                <span class="author">By <?php echo $blog['author']; ?></span>
                <span class="date"><?php echo date('F j, Y', strtotime($blog['created_at'])); ?></span>
            </div>
        </div>
        
        <div class="blog-content">
            <?php echo nl2br(htmlspecialchars($blog['content'])); ?>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>