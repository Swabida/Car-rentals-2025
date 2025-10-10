<?php
require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../includes/functions.php';

class CarController {
    private $carModel;
    
    public function __construct() {
        $this->carModel = new Car();
    }
    
    public function index() {
        $cars = $this->carModel->getAllCars();
        return $cars;
    }
    
    public function show($id) {
        $car = $this->carModel->getCarById($id);
        return $car;
    }
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle image upload
            $imagePath = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $imagePath = uploadImage($_FILES['image']);
                if (!$imagePath) {
                    displayMessage("Failed to upload image.", 'error');
                    return false;
                }
            }
            
            // Prepare data
            $data = [
                'make' => sanitizeInput($_POST['make']),
                'model' => sanitizeInput($_POST['model']),
                'year' => (int)$_POST['year'],
                'price' => (float)$_POST['price'],
                'rental_price' => (float)$_POST['rental_price'],
                'description' => sanitizeInput($_POST['description']),
                'image_url' => $imagePath,
                'status' => sanitizeInput($_POST['status'])
            ];
            
            // Add car
            if ($this->carModel->addCar($data)) {
                displayMessage("Car added successfully.", 'success');
                return true;
            } else {
                displayMessage("Failed to add car.", 'error');
                return false;
            }
        }
        return true;
    }
    
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get existing car data
            $existingCar = $this->carModel->getCarById($id);
            
            // Handle image upload
            $imagePath = $existingCar['image_url'];
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                // Delete old image if exists
                if (!empty($existingCar['image_url'])) {
                    deleteImage($existingCar['image_url']);
                }
                
                $imagePath = uploadImage($_FILES['image']);
                if (!$imagePath) {
                    displayMessage("Failed to upload image.", 'error');
                    return false;
                }
            }
            
            // Prepare data
            $data = [
                'make' => sanitizeInput($_POST['make']),
                'model' => sanitizeInput($_POST['model']),
                'year' => (int)$_POST['year'],
                'price' => (float)$_POST['price'],
                'rental_price' => (float)$_POST['rental_price'],
                'description' => sanitizeInput($_POST['description']),
                'image_url' => $imagePath,
                'status' => sanitizeInput($_POST['status'])
            ];
            
            // Update car
            if ($this->carModel->updateCar($id, $data)) {
                displayMessage("Car updated successfully.", 'success');
                return true;
            } else {
                displayMessage("Failed to update car.", 'error');
                return false;
            }
        }
        
        $car = $this->carModel->getCarById($id);
        return $car;
    }
    
    public function delete($id) {
        // Get existing car data
        $existingCar = $this->carModel->getCarById($id);
        
        // Delete image if exists
        if (!empty($existingCar['image_url'])) {
            deleteImage($existingCar['image_url']);
        }
        
        // Delete car
        if ($this->carModel->deleteCar($id)) {
            displayMessage("Car deleted successfully.", 'success');
            return true;
        } else {
            displayMessage("Failed to delete car.", 'error');
            return false;
        }
    }
    
    public function search($keyword) {
        $cars = $this->carModel->searchCars($keyword);
        return $cars;
    }
}
?>