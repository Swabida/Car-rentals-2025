<?php
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../includes/functions.php';

class BookingController {
    private $bookingModel;
    private $carModel;
    
    public function __construct() {
        $this->bookingModel = new Booking();
        $this->carModel = new Car();
    }
    
    public function index() {
        $bookings = $this->bookingModel->getAllBookings();
        include __DIR__ . '/../views/bookings/index.php';
    }
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Calculate total price
            $car = $this->carModel->getCarById($_POST['car_id']);
            $start_date = new DateTime($_POST['start_date']);
            $end_date = new DateTime($_POST['end_date']);
            $days = $end_date->diff($start_date)->days;
            $total_price = $days * $car['rental_price'];
            
            $data = [
                'car_id' => (int)$_POST['car_id'],
                'user_id' => $_SESSION['user_id'],
                'customer_name' => sanitizeInput($_POST['customer_name']),
                'customer_email' => sanitizeInput($_POST['customer_email']),
                'customer_phone' => sanitizeInput($_POST['customer_phone']),
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'total_price' => $total_price,
                'status' => sanitizeInput($_POST['status'])
            ];
            
            if ($this->bookingModel->addBooking($data)) {
                displayMessage("Booking added successfully.", 'success');
                redirect('/bookings/index.php');
            } else {
                displayMessage("Failed to add booking.", 'error');
            }
        }
        
        $cars = $this->carModel->getAllCars();
        include __DIR__ . '/../views/bookings/add.php';
    }
    
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'customer_name' => sanitizeInput($_POST['customer_name']),
                'customer_email' => sanitizeInput($_POST['customer_email']),
                'customer_phone' => sanitizeInput($_POST['customer_phone']),
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'total_price' => (float)$_POST['total_price'],
                'status' => sanitizeInput($_POST['status'])
            ];
            
            if ($this->bookingModel->updateBooking($id, $data)) {
                displayMessage("Booking updated successfully.", 'success');
                redirect('/bookings/index.php');
            } else {
                displayMessage("Failed to update booking.", 'error');
            }
        }
        
        $booking = $this->bookingModel->getBookingById($id);
        include __DIR__ . '/../views/bookings/edit.php');
    }
    
    public function delete($id) {
        if ($this->bookingModel->deleteBooking($id)) {
            displayMessage("Booking deleted successfully.", 'success');
            redirect('/bookings/index.php');
        } else {
            displayMessage("Failed to delete booking.", 'error');
        }
    }
    
    public function view($id) {
        $booking = $this->bookingModel->getBookingById($id);
        include __DIR__ . '/../views/bookings/view.php';
    }
}
?>