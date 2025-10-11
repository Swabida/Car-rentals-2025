<?php
require_once __DIR__ . '/../includes/header.php';
$activePage = 'bookings';
?>

<div class="page-header">
    <h1>Booking Management</h1>
    <div class="header-actions">
        <a href="add.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Booking
        </a>
    </div>
</div>

<div class="content-wrapper">
    <div class="bookings-table-container">
        <table class="bookings-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Car</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Get bookings
                $bookings = [
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

                foreach ($bookings as $booking) {
                    echo '
                        <tr>
                            <td>' . $booking['id'] . '</td>
                            <td>' . $booking['customer_name'] . '</td>
                            <td>' . $booking['car_make'] . ' ' . $booking['car_model'] . '</td>
                            <td>' . $booking['start_date'] . '</td>
                            <td>' . $booking['end_date'] . '</td>
                            <td>' . formatCurrency($booking['total_price']) . '</td>
                            <td><span class="status-badge ' . $booking['status'] . '">' . ucfirst($booking['status']) . '</span></td>
                            <td>
                                <a href="view.php?id=' . $booking['id'] . '" class="btn btn-view">View</a>
                                <a href="edit.php?id=' . $booking['id'] . '" class="btn btn-edit">Edit</a>
                                <a href="#" class="btn btn-delete" data-id="' . $booking['id'] . '" data-action="delete">Delete</a>
                            </td>
                        </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Confirm Deletion</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this booking? This action cannot be undone.</p>
            <div class="modal-actions">
                <button id="cancelDelete" class="btn btn-secondary">Cancel</button>
                <button id="confirmDelete" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete button click handler
    const deleteButtons = document.querySelectorAll('.btn-delete');
    const deleteModal = document.getElementById('deleteModal');
    const confirmDeleteBtn = document.getElementById('confirmDelete');
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    const closeBtn = document.querySelector('.close');
    
    let bookingIdToDelete = null;
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            bookingIdToDelete = this.getAttribute('data-id');
            deleteModal.style.display = 'block';
        });
    });
    
    // Close modal
    closeBtn.addEventListener('click', function() {
        deleteModal.style.display = 'none';
    });
    
    cancelDeleteBtn.addEventListener('click', function() {
        deleteModal.style.display = 'none';
    });
    
    // Confirm delete
    confirmDeleteBtn.addEventListener('click', function() {
        if (bookingIdToDelete) {
            window.location.href = `controllers/BookingController.php?action=delete&id=${bookingIdToDelete}`;
        }
    });
    
    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target == deleteModal) {
            deleteModal.style.display = 'none';
        }
    });
});
</script>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>