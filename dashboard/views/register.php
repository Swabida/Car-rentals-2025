<?php
$activePage = 'register';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
    }

    body {
    background: radial-gradient(circle at top left, #1e293b, #0f172a);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    }

    /* =========================
    HEADER STYLES
    ========================= */
    .page-header {
    position: absolute;
    top: 40px;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    }

    .page-header h1 {
    font-size: 2.4rem;
    color: #e2e8f0;
    font-weight: 600;
    margin-bottom: 10px;
    letter-spacing: 1px;
    }

    .page-header .btn-secondary {
    background-color: rgba(148, 163, 184, 0.2);
    color: #e2e8f0;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.95rem;
    border: 1px solid rgba(148, 163, 184, 0.3);
    transition: all 0.3s ease;
    }

    .page-header .btn-secondary:hover {
    background-color: rgba(255, 255, 255, 0.1);
    transform: scale(1.05);
    }

    /* =========================
    CONTENT WRAPPER
    ========================= */
    .content-wrapper {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(18px);
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    padding: 45px;
    width: 500px;
    margin-top: 100px;
    transition: transform 0.3s ease;
    }

    .content-wrapper:hover {
    transform: translateY(-3px);
    }

    /* =========================
    FORM STYLES
    ========================= */
    .form-container {
    width: 100%;
    }

    form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    }

    .form-row {
    display: flex;
    gap: 20px;
    }

    .form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
    }

    label {
    font-size: 0.9rem;
    color: #cbd5e1;
    margin-bottom: 6px;
    }

    input {
    padding: 12px 14px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    background-color: rgba(255, 255, 255, 0.08);
    color: #fff;
    font-size: 1rem;
    outline: none;
    transition: all 0.3s ease;
    }

    input:focus {
    border-color: #60a5fa;
    background-color: rgba(255, 255, 255, 0.12);
    }

    /* =========================
    BUTTON STYLES
    ========================= */
    .form-actions {
    margin-top: 15px;
    }

    .btn-primary {
    width: 100%;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
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
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
    }

    /* =========================
    ICON STYLES
    ========================= */
    button i,
    a i {
    margin-right: 6px;
    }

    /* =========================
    RESPONSIVE DESIGN
    ========================= */
    @media (max-width: 600px) {
    .content-wrapper {
        width: 90%;
        padding: 30px;
    }

    .form-row {
        flex-direction: column;
    }

    .page-header h1 {
        font-size: 1.9rem;
    }
    }

    </style>
</head>

<body>
    <!-- Page Header -->
    <div class="page-header">
        <h1>Register</h1>
        <a href="login.php" class="btn btn-secondary">
            <i class="fas fa-sign-in-alt"></i> Login
        </a>
    </div>

    <!-- Registration Form -->
    <div class="content-wrapper">
        <div class="form-container">
            <form action="../../controllers/AuthController.php?action=register" method="POST">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="full_name">Full Name *</label>
                        <input type="text" id="full_name" name="full_name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone_number">Phone Number *</label>
                        <input type="phone_number" id="phone_number" name="phone_number" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password *</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Register
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>


