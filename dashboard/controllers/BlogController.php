<?php
require_once __DIR__ . '/../models/Blog.php';
require_once __DIR__ . '/../includes/functions.php';

class BlogController {
    private $blogModel;
    
    public function __construct() {
        $this->blogModel = new Blog();
    }
    
    public function index() {
        $blogs = $this->blogModel->getAllBlogs();
        include __DIR__ . '/../views/blogs/index.php';
    }
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => sanitizeInput($_POST['title']),
                'content' => $_POST['content'],
                'author_id' => $_SESSION['user_id']
            ];
            
            if ($this->blogModel->addBlog($data)) {
                displayMessage("Blog post added successfully.", 'success');
                redirect('/blogs/index.php');
            } else {
                displayMessage("Failed to add blog post.", 'error');
            }
        }
        include __DIR__ . '/../views/blogs/add.php';
    }
    
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => sanitizeInput($_POST['title']),
                'content' => $_POST['content']
            ];
            
            if ($this->blogModel->updateBlog($id, $data)) {
                displayMessage("Blog post updated successfully.", 'success');
                redirect('/blogs/index.php');
            } else {
                displayMessage("Failed to update blog post.", 'error');
            }
        }
        
        $blog = $this->blogModel->getBlogById($id);
        include __DIR__ . '/../views/blogs/edit.php';
    }
    
    public function delete($id) {
        if ($this->blogModel->deleteBlog($id)) {
            displayMessage("Blog post deleted successfully.", 'success');
            redirect('/blogs/index.php');
        } else {
            displayMessage("Failed to delete blog post.", 'error');
        }
    }
    
    public function view($id) {
        $blog = $this->blogModel->getBlogById($id);
        include __DIR__ . '/../views/blogs/view.php';
    }
}
?>