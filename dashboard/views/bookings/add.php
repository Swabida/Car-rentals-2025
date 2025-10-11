<?php
require_once __DIR__ . '/../includes/header.php';
$activePage = 'bookings';
?>

<div class="page-header">
    <h1>Add New Booking</h1>
    <a href="index.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Bookings
    </a>
</div>

<div class="content-wrapper">
    <div class="form-container">
        <form id="bookingForm" action="controllers/BookingController.php?action=add" method="post">
            <div class="form-row">
                <div class="form-group">
                    <label for="car_id">Car *</label>
                    <select id="car_id" name="car_id" required>
                        <option value="">Select a car</option>
                        <option value="1">Toyota Camry (2023)</option>
                        <option value="2">Honda Accord (2023)</option>
                        <option value="3">Ford Mustang (2022)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="customer_name">Customer Name *</label>
                    <input type="text" id="customer_name" name="customer_name" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="customer_email">Customer Email *</label>
                    <input type="email" id="customer_email" name="customer_email" required>
                </div>
                <div class="form-group">
                    <label for="customer_phone">Customer Phone</label>
                    <input type="text" id="customer_phone" name="customer_phone">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="start_date">Start Date *</label>
                    <input type="date" id="start_date" name="start_date" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date *</label>
                    <input type="date" id="end_date" name="end_date" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="active">Active</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Booking
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>