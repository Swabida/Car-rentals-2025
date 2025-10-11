<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page
    header('Location: views/login.php');
    exit();
}

// Include necessary files
require_once '/includes/header.php';
require_once '/includes/functions.php';

// Set active page
$activePage = 'dashboard';
?>

<div class="page-header">
    <h1>Dashboard</h1>
</div>

<!-- Dashboard Stats -->
<div class="dashboard-stats">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-car"></i>
        </div>
        <div class="stat-content">
            <h3>Total Cars</h3>
            <p class="stat-value">42</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <h3>Available Cars</h3>
            <p class="stat-value">28</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-calendar-check"></i>
        </div>
        <div class="stat-content">
            <h3>Active Bookings</h3>
            <p class="stat-value">10</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="stat-content">
            <h3>Monthly Revenue</h3>
            <p class="stat-value">$12,450</p>
        </div>
    </div>
</div>

<!-- Dashboard Content -->
<div class="dashboard-content">
    <!-- Recent Cars -->
    <div class="dashboard-section">
        <h2>Recently Added Cars</h2>
        <div class="recent-cars">
            <?php
            // Get recently added cars
            $recentCars = [
                [
                    'id' => 1,
                    'make' => 'Toyota',
                    'model' => 'Camry',
                    'year' => 2023,
                    'price' => 25000,
                    'image_url' => '/assets/images/cars/toyota-camry.jpg'
                ],
                [
                    'id' => 2,
                    'make' => 'Honda',
                    'model' => 'Accord',
                    'year' => 2023,
                    'price' => 28000,
                    'image_url' => '/assets/images/cars/honda-accord.jpg'
                ],
                [
                    'id' => 3,
                    'make' => 'Ford',
                    'model' => 'Mustang',
                    'year' => 2022,
                    'price' => 35000,
                    'image_url' => '/assets/images/cars/ford-mustang.jpg'
                ]
            ];

            foreach ($recentCars as $car) {
                echo '
                    <div class="car-card">
                        <img src="' . SITE_URL . $car['image_url'] . '" alt="' . $car['make'] . ' ' . $car['model'] . '">
                        <div class="car-info">
                            <h3>' . $car['make'] . ' ' . $car['model'] . '</h3>
                            <p>Year: ' . $car['year'] . '</p>
                            <p class="price">' . formatCurrency($car['price']) . '</p>
                        </div>
                        <div class="car-actions">
                            <a href="views/cars/view.php?id=' . $car['id'] . '" class="btn btn-view">View</a>
                            <a href="views/cars/edit.php?id=' . $car['id'] . '" class="btn btn-edit">Edit</a>
                        </div>
                    </div>
                ';
            }
            ?>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="dashboard-section">
        <h2>Recent Bookings</h2>
        <div class="recent-bookings">
            <?php
            // Get recent bookings
            $recentBookings = [
                [
                    'id' => 1,
                    'customer_name' => 'John Doe',
                    'car_make' => 'Toyota',
                    'car_model' => 'Camry',
                    'start_date' => '2023-06-15',
                    'end_date' => '2023-06-20',
                    'total_price' => 375,
                    'status' => 'completed'
                ],
                [
                    'id' => 2,
                    'customer_name' => 'Jane Smith',
                    'car_make' => 'Honda',
                    'car_model' => 'Accord',
                    'start_date' => '2023-06-18',
                    'end_date' => '2023-06-25',
                    'total_price' => 595,
                    'status' => 'active'
                ],
                [
                    'id' => 3,
                    'customer_name' => 'Robert Johnson',
                    'car_make' => 'Ford',
                    'car_model' => 'Mustang',
                    'start_date' => '2023-06-20',
                    'end_date' => '2023-06-22',
                    'total_price' => 400,
                    'status' => 'active'
                ]
            ];

            foreach ($recentBookings as $booking) {
                echo '
                    <div class="booking-card">
                        <div class="booking-info">
                            <h3>' . $booking['customer_name'] . '</h3>
                            <p>' . $booking['car_make'] . ' ' . $booking['car_model'] . '</p>
                            <p>' . $booking['start_date'] . ' to ' . $booking['end_date'] . '</p>
                            <p class="price">' . formatCurrency($booking['total_price']) . '</p>
                        </div>
                        <div class="booking-status">
                            <span class="status-badge ' . $booking['status'] . '">' . ucfirst($booking['status']) . '</span>
                        </div>
                    </div>
                ';
            }
            ?>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>