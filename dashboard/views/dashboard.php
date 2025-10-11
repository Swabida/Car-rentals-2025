<?php
require_once __DIR__ . '/../includes/header.php';
// Set page title and content
$pageTitle = 'Dashboard';
$content = '
<div class="page-header">
    <h1>Dashboard</h1>
</div>

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
            <i class="fas fa-car-side"></i>
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

<div class="dashboard-content">
    <div class="dashboard-section">
        <h2>Recently Added Cars</h2>
        <div class="cars-grid">
            <div class="car-card">
                <div class="car-image">
                    <img src="' . SITE_URL . '/assets/images/default-car.jpg" alt="Toyota Camry">
                    <span class="car-status available">Available</span>
                </div>
                <div class="car-info">
                    <h3>Toyota Camry</h3>
                    <p>Year: 2023</p>
                    <p class="price">$25,000.00</p>
                </div>
                <div class="car-actions">
                    <a href="#" class="btn btn-view">View</a>
                    <a href="#" class="btn btn-edit">Edit</a>
                </div>
            </div>
            
            <div class="car-card">
                <div class="car-image">
                    <img src="' . SITE_URL . '/assets/images/default-car.jpg" alt="Honda Accord">
                    <span class="car-status available">Available</span>
                </div>
                <div class="car-info">
                    <h3>Honda Accord</h3>
                    <p>Year: 2023</p>
                    <p class="price">$28,000.00</p>
                </div>
                <div class="car-actions">
                    <a href="#" class="btn btn-view">View</a>
                    <a href="#" class="btn btn-edit">Edit</a>
                </div>
            </div>
            
            <div class="car-card">
                <div class="car-image">
                    <img src="' . SITE_URL . '/assets/images/default-car.jpg" alt="Ford Mustang">
                    <span class="car-status available">Available</span>
                </div>
                <div class="car-info">
                    <h3>Ford Mustang</h3>
                    <p>Year: 2022</p>
                    <p class="price">$35,000.00</p>
                </div>
                <div class="car-actions">
                    <a href="#" class="btn btn-view">View</a>
                    <a href="#" class="btn btn-edit">Edit</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="dashboard-section">
        <h2>Recent Bookings</h2>
        <table class="bookings-table">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Car</th>
                    <th>Dates</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John Doe</td>
                    <td>Toyota Camry</td>
                    <td>2023-06-15 to 2023-06-20</td>
                    <td>$375.00</td>
                    <td><span class="status-badge completed">Completed</span></td>
                </tr>
                <tr>
                    <td>Jane Smith</td>
                    <td>Honda Accord</td>
                    <td>2023-06-18 to 2023-06-25</td>
                    <td>$595.00</td>
                    <td><span class="status-badge active">Active</span></td>
                </tr>
                <tr>
                    <td>Robert Johnson</td>
                    <td>Ford Mustang</td>
                    <td>2023-06-20 to 2023-06-22</td>
                    <td>$400.00</td>
                    <td><span class="status-badge active">Active</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>';

// Include footer
require_once __DIR__ . '/../includes/footer.php';
?>