<?php
require_once __DIR__ . '/../includes/header.php';
$activePage = 'bookings';
?>

<div class="page-header">
    <h1>Booking Details</h1>
    <div class="header-actions">
        <a href="edit.php?id=<?php echo $booking['id']; ?>" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="index.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Bookings
        </a>
    </div>
</div>

<?php
// Check if booking ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    displayMessage("Booking ID is required.", 'error');
    redirect('/views/bookings/index.php');
}

$bookingId = (int)$_GET['id'];

// Get booking data
$booking = [
    'id' => 1,
    'customer_name' => 'John Doe',
    'customer_email' => 'john.doe@example.com',
    'customer_phone' => '123-456-7890',
    'car_make' => 'Toyota',
    'car_model' => 'Camry',
    'year' => 2023,
    'start_date' => '2023-06-15',
    'end_date' => '2023-06-20',
    'total_price' => 375,
    'status' => 'completed',
    'created_at' => '2023-06-10'
];
?>

<div class="content-wrapper">
    <div class="booking-details">
        <div class="booking-info">
            <h2>Booking #<?php echo $booking['id']; ?></h2>
            
            <div class="booking-section">
                <h3>Customer Information</h3>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($booking['customer_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($booking['customer_email']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($booking['customer_phone']); ?></p>
            </div>
            
            <div class="booking-section">
                <h3>Car Details</h3>
                <p><strong>Make:</strong> <?php echo htmlspecialchars($booking['car_make']); ?></p>
                <p><strong>Model:</strong> <?php echo htmlspecialchars($booking['car_model']); ?></p>
                <p><strong>Year:</strong> <?php echo htmlspecialchars($booking['year']); ?></p>
            </div>
            
            <div class="booking-section">
                <h3>Rental Period</h3>
                <p><strong>Start Date:</strong> <?php echo htmlspecialchars($booking['start_date']); ?></p>
                <p><strong>End Date:</strong> <?php echo htmlspecialchars($booking['end_date']); ?></p>
                <p><strong>Duration:</strong> <?php echo (new DateTime($booking['end_date']))->diff(new DateTime($booking['start_date']))->days; ?> days</p>
            </div>
            
            <div class="booking-section">
                <h3>Payment</h3>
                <p><strong>Total Price:</strong> <?php echo formatCurrency($booking['total_price']); ?></p>
                <p><strong>Status:</strong> <span class="status-badge <?php echo $booking['status']; ?>"><?php echo ucfirst($booking['status']); ?></span></p>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>