<?php
require_once 'Database.php';

class Blog {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getAllBlogs() {
        $sql = "SELECT b.*, u.full_name as author FROM blogs b 
                JOIN users u ON b.author_id = u.id 
                ORDER BY b.created_at DESC";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getBlogById($id) {
        $sql = "SELECT b.*, u.full_name as author FROM blogs b 
                JOIN users u ON b.author_id = u.id 
                WHERE b.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function addBlog($data) {
        $sql = "INSERT INTO blogs (title, content, author_id) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssi", 
            $data['title'], 
            $data['content'], 
            $data['author_id']
        );
        return $stmt->execute();
    }
    
    public function updateBlog($id, $data) {
        $sql = "UPDATE blogs SET title = ?, content = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssi", 
            $data['title'], 
            $data['content'], 
            $id
        );
        return $stmt->execute();
    }
    
    public function deleteBlog($id) {
        $sql = "DELETE FROM blogs WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>