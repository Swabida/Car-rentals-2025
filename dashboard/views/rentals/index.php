<?php
require_once __DIR__ . '/../includes/header.php';
 $activePage = 'rentals';
?>

<div class="page-header">
    <h1>Rentals Management</h1>
    <div class="header-actions">
        <a href="add.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Rental
        </a>
    </div>
</div>

<div class="content-wrapper">
    <div class="rentals-table-container">
        <table class="rentals-table">
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
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>Toyota Camry</td>
                    <td>2023-06-15</td>
                    <td>2023-06-20</td>
                    <td>$750</td>
                    <td><span class="status-badge active">Active</span></td>
                    <td>
                        <a href="view.php?id=1" class="btn btn-view">View</a>
                        <a href="edit.php?id=1" class="btn btn-edit">Edit</a>
                        <a href="#" class="btn btn-delete" data-id="1">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jane Smith</td>
                    <td>Honda Accord</td>
                    <td>2023-06-18</td>
                    <td>2023-06-25</td>
                    <td>$1,050</td>
                    <td><span class="status-badge active">Active</span></td>
                    <td>
                        <a href="view.php?id=2" class="btn btn-view">View</a>
                        <a href="edit.php?id=2" class="btn btn-edit">Edit</a>
                        <a href="#" class="btn btn-delete" data-id="2">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Robert Johnson</td>
                    <td>Ford Mustang</td>
                    <td>2023-06-20</td>
                    <td>2023-06-22</td>
                    <td>$600</td>
                    <td><span class="status-badge completed">Completed</span></td>
                    <td>
                        <a href="view.php?id=3" class="btn btn-view">View</a>
                        <a href="edit.php?id=3" class="btn btn-edit">Edit</a>
                        <a href="#" class="btn btn-delete" data-id="3">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>