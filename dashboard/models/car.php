<?php
require_once 'Database.php';

class Car {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getAllCars() {
        $sql = "SELECT * FROM cars ORDER BY created_at DESC";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getCarById($id) {
        $sql = "SELECT * FROM cars WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function addCar($data) {
        $sql = "INSERT INTO cars (make, model, year, price, rental_price, description, image_url, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssiddsss", 
            $data['make'], 
            $data['model'], 
            $data['year'], 
            $data['price'], 
            $data['rental_price'], 
            $data['description'], 
            $data['image_url'], 
            $data['status']
        );
        
        return $stmt->execute();
    }
    
    public function updateCar($id, $data) {
        $sql = "UPDATE cars SET 
                make = ?, model = ?, year = ?, price = ?, rental_price = ?, 
                description = ?, image_url = ?, status = ? 
                WHERE id = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssiddsssi", 
            $data['make'], 
            $data['model'], 
            $data['year'], 
            $data['price'], 
            $data['rental_price'], 
            $data['description'], 
            $data['image_url'], 
            $data['status'],
            $id
        );
        
        return $stmt->execute();
    }
    
    public function deleteCar($id) {
        $sql = "DELETE FROM cars WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    // FIXED: Added public access modifier
    public function searchCars($keyword) {
        $sql = "SELECT * FROM cars 
                WHERE make LIKE ? OR model LIKE ? OR description LIKE ?";
        
        $stmt = $this->db->prepare($sql);
        $searchTerm = "%$keyword%";
        $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>