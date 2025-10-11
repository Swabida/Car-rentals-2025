<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../includes/functions.php';

class UserController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function index() {
        $users = $this->userModel->getAllUsers();
        include __DIR__ . '/../views/users/index.php';
    }
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => sanitizeInput($_POST['username']),
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'email' => sanitizeInput($_POST['email']),
                'full_name' => sanitizeInput($_POST['full_name']),
                'role' => sanitizeInput($_POST['role'])
            ];
            
            if ($this->userModel->addUser($data)) {
                displayMessage("User added successfully.", 'success');
                redirect('/users/index.php');
            } else {
                displayMessage("Failed to add user.", 'error');
            }
        }
        include __DIR__ . '/../views/users/add.php';
    }
    
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'full_name' => sanitizeInput($_POST['full_name']),
                'email' => sanitizeInput($_POST['email']),
                'role' => sanitizeInput($_POST['role'])
            ];
            
            if ($this->userModel->updateUser($id, $data)) {
                displayMessage("User updated successfully.", 'success');
                redirect('/users/index.php');
            } else {
                displayMessage("Failed to update user.", 'error');
            }
        }
        
        $user = $this->userModel->getUserById($id);
        include __DIR__ . '/../views/users/edit.php';
    }
    
    public function delete($id) {
        if ($this->userModel->deleteUser($id)) {
            displayMessage("User deleted successfully.", 'success');
            redirect('/users/index.php');
        } else {
            displayMessage("Failed to delete user.", 'error');
        }
    }
    
    public function profile() {
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        include __DIR__ . '/../views/users/profile.php';
    }
    
    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'full_name' => sanitizeInput($_POST['full_name']),
                'email' => sanitizeInput($_POST['email'])
            ];
            
            if ($this->userModel->updateUser($_SESSION['user_id'], $data)) {
                displayMessage("Profile updated successfully.", 'success');
                redirect('/users/profile.php');
            } else {
                displayMessage("Failed to update profile.", 'error');
            }
        }
        include __DIR__ . '/../views/users/profile.php';
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = sanitizeInput($_POST['username']);
            $password = $_POST['password'];
            
            $user = $this->userModel->login($username, $password);
            
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                
                displayMessage("Login successful.", 'success');
                redirect('/index.php');
            } else {
                displayMessage("Invalid username or password.", 'error');
            }
        }
        include __DIR__ . '/../views/login.php';
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => sanitizeInput($_POST['username']),
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'email' => sanitizeInput($_POST['email']),
                'full_name' => sanitizeInput($_POST['full_name']),
                'role' => 'user'
            ];
            
            if ($this->userModel->addUser($data)) {
                displayMessage("Registration successful. Please login.", 'success');
                redirect('/login.php');
            } else {
                displayMessage("Registration failed. Please try again.", 'error');
            }
        }
        include __DIR__ . '/../views/register.php';
    }
    
    public function logout() {
        session_start();
        session_destroy();
        redirect('/login.php');
    }
}
?>