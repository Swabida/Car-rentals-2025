<?php
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../includes/function.php';

class AuthController {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = sanitizeInput($_POST['username']);
            $password = $_POST['password'];
            
            // Check if user exists
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                
                // Verify password
                if (password_verify($password, $user['password'])) {
                    // Set session variables
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['full_name'] = $user['full_name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];
                    
                    displayMessage('Login successful!', 'success');
                    redirect('../views/dashboard.php');
                } else {
                    displayMessage('Invalid username or password.', 'error');
                    redirect('/views/login.php');
                }
            } else {
                displayMessage('Invalid username or password.', 'error');
                redirect('/views/login.php');
            }
        }
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $full_name = sanitizeInput($_POST['full_name']);
            $email = sanitizeInput($_POST['email']);
            $username = sanitizeInput($_POST['username']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            // Check if username or email already exists
            $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                displayMessage('Username or email already exists.', 'error');
                redirect('/views/register.php');
            }
            
            // Insert new user
            $sql = "INSERT INTO users (username, password, email, full_name) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssss", $username, $password, $email, $full_name);
            
            if ($stmt->execute()) {
                displayMessage('Registration successful! Please login.', 'success');
                redirect('/views/login.php');
            } else {
                displayMessage('Registration failed. Please try again.', 'error');
                redirect('/views/register.php');
            }
        }
    }
    
    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user_id'];
            $full_name = sanitizeInput($_POST['full_name']);
            $email = sanitizeInput($_POST['email']);
            
            // Handle avatar upload
            $avatar_path = '';
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
                $avatar_path = uploadImage($_FILES['avatar'], 'avatars');
                if (!$avatar_path) {
                    displayMessage('Failed to upload avatar.', 'error');
                    redirect('/views/profile.php');
                }
                
                // Delete old avatar if exists
                $sql = "SELECT avatar FROM users WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $old_avatar = $result->fetch_assoc()['avatar'];
                
                if (!empty($old_avatar)) {
                    deleteImage($old_avatar);
                }
            }
            
            // Update profile
            $sql = "UPDATE users SET full_name = ?, email = ?";
            $params = [$full_name, $email];
            $types = "ss";
            
            if (!empty($avatar_path)) {
                $sql .= ", avatar = ?";
                $params[] = $avatar_path;
                $types .= "s";
            }
            
            $sql .= " WHERE id = ?";
            $params[] = $user_id;
            $types .= "i";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param($types, ...$params);
            
            if ($stmt->execute()) {
                // Update session variables
                $_SESSION['full_name'] = $full_name;
                $_SESSION['email'] = $email;
                if (!empty($avatar_path)) {
                    $_SESSION['avatar'] = $avatar_path;
                }
                
                displayMessage('Profile updated successfully!', 'success');
                redirect('/views/profile.php');
            } else {
                displayMessage('Failed to update profile.', 'error');
                redirect('/views/profile.php');
            }
        }
    }
    
    public function changePassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user_id'];
            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            
            // Check if new passwords match
            if ($new_password !== $confirm_password) {
                displayMessage('New passwords do not match.', 'error');
                redirect('/views/profile.php');
            }
            
            // Get current password hash
            $sql = "SELECT password FROM users WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            
            // Verify current password
            if (!password_verify($current_password, $user['password'])) {
                displayMessage('Current password is incorrect.', 'error');
                redirect('/views/profile.php');
            }
            
            // Update password
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("si", $new_password_hash, $user_id);
            
            if ($stmt->execute()) {
                displayMessage('Password changed successfully!', 'success');
                redirect('/views/profile.php');
            } else {
                displayMessage('Failed to change password.', 'error');
                redirect('/views/profile.php');
            }
        }
    }
}