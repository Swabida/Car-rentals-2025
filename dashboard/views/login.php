<?php
require_once __DIR__ . '/../config/config.php';
$activePage = 'login';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    /* RESET & GLOBALS */
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Times New Roman", Times, serif;
    }

    body {
    background: linear-gradient(135deg, #0f172a, #1e293b);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    }

    /* PAGE HEADER */
    .page-header {
    position: absolute;
    top: 40px;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    }

    .page-header h1 {
    font-size: 2.2rem;
    color: #f8fafc;
    margin-bottom: 10px;
    }

    .page-header .btn-secondary {
    background-color: #334155;
    color: #fff;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    }

    .page-header .btn-secondary:hover {
    background-color: #475569;
    }

    /* WRAPPER */
    .content-wrapper {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(14px);
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    padding: 40px 45px;
    width: 380px;
    text-align: center;
    }

    /* FORM CONTAINER */
    .form-container h2 {
    margin-bottom: 1.2rem;
    font-size: 1.5rem;
    font-weight: 600;
    color: #e2e8f0;
    }

    .form-group {
    margin-bottom: 20px;
    text-align: left;
    }

    .form-group label {
    font-size: 0.95rem;
    color: #cbd5e1;
    display: block;
    margin-bottom: 6px;
    }

    .form-group input {
    width: 100%;
    padding: 12px 14px;
    border: none;
    border-radius: 8px;
    outline: none;
    font-size: 1rem;
    background-color: rgba(255, 255, 255, 0.15);
    color: #fff;
    transition: background-color 0.3s ease;
    }

    .form-group input:focus {
    background-color: rgba(255, 255, 255, 0.25);
    }

    /* BUTTONS */
    .form-actions {
    margin-top: 20px;
    }

    .btn-primary {
    width: 100%;
    background-color: #2563eb;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    }

    .btn-primary:hover {
    background-color: #1d4ed8;
    transform: translateY(-2px);
    }

    /* ICON STYLES */
    button i,
    a i {
    margin-right: 6px;
    }

    /* RESPONSIVE */
    @media (max-width: 480px) {
    .content-wrapper {
        width: 90%;
        padding: 30px 25px;
    }

    .page-header h1 {
        font-size: 1.8rem;
    }
    }

    </style>
</head>

<body>
    
    <!-- Login Form -->
    <diV class="content-wrapper">
        <div class="form-container">
            <form action="../views/dashboard.php" method="POST">
                
                <div class="form-group">
                    <label for="username">Username *</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </div>

            </form>
        </div>
    </diV> 
</body>
</html>
