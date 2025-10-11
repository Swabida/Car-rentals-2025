<?php
require_once 'Database.php';

class Booking {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getAllBookings() {
        $sql = "SELECT b.*, c.make, c.model, u.full_name as user_name FROM bookings b 
                JOIN cars c ON b.car_id = c.id 
                JOIN users u ON b.user_id = u.id 
                ORDER BY b.created_at DESC";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getBookingById($id) {
        $sql = "SELECT b.*, c.make, c.model, u.full_name as user_name FROM bookings b 
                JOIN cars c ON b.car_id = c.id 
                JOIN users u ON b.user_id = u.id 
                WHERE b.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function addBooking($data) {
        $sql = "INSERT INTO bookings (car_id, user_id, customer_name, customer_email, customer_phone, start_date, end_date, total_price, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iissssdss", 
            $data['car_id'], 
            $data['user_id'], 
            $data['customer_name'], 
            $data['customer_email'],
            $data['customer_phone'],
            $data['start_date'], 
            $data['end_date'], 
            $data['total_price'],
            $data['status']
        );
        return $stmt->execute();
    }
    
    public function updateBooking($id, $data) {
        $sql = "UPDATE bookings SET 
                customer_name = ?, customer_email = ?, customer_phone = ?, 
                start_date = ?, end_date = ?, total_price = ?, status = ? 
                WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssdsii", 
            $data['customer_name'], 
            $data['customer_email'],
            $data['customer_phone'],
            $data['start_date'], 
            $data['end_date'], 
            $data['total_price'],
            $data['status'],
            $id
        );
        return $stmt->execute();
    }
    
    public function deleteBooking($id) {
        $sql = "DELETE FROM bookings WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>