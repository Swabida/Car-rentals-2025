<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Management</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Admin Dashboard</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="users.php">Users</a></li>
                    <li><a href="bookings.php">Bookings</a></li>
                    <li><a href="sales.php" class="active">Sales</a></li>
                </ul>
            </nav>
        </header>
        
        <main>
            <div class="page-header">
                <h2>Sales Management</h2>
                <button id="add-sale-btn">Add New Sale</button>
            </div>
            
            <div class="table-container">
                <table id="sales-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sales = $conn->query("SELECT s.id, u.name, s.product, s.amount, s.sale_date, s.status 
                                              FROM sales s 
                                              JOIN users u ON s.user_id = u.id 
                                              ORDER BY s.created_at DESC");
                        while($row = $sales->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['product']; ?></td>
                            <td>$<?php echo number_format($row['amount'], 2); ?></td>
                            <td><?php echo $row['sale_date']; ?></td>
                            <td class="status <?php echo $row['status']; ?>"><?php echo $row['status']; ?></td>
                            <td class="actions">
                                <button class="edit-btn" data-id="<?php echo $row['id']; ?>">Edit</button>
                                <button class="delete-btn" data-id="<?php echo $row['id']; ?>">Delete</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
        
        <footer>
            <p>&copy; <?php echo date('Y'); ?> Admin Dashboard. All rights reserved.</p>
        </footer>
    </div>
    
    <!-- Sale Modal -->
    <div id="sale-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modal-title">Add New Sale</h2>
            <form id="sale-form">
                <input type="hidden" id="sale-id">
                <div class="form-group">
                    <label for="user">User:</label>
                    <select id="user" required>
                        <?php
                        $users = $conn->query("SELECT id, name FROM users WHERE status='active'");
                        while($row = $users->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="product">Product:</label>
                    <input type="text" id="product" required>
                </div>
                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" step="0.01" id="amount" required>
                </div>
                <div class="form-group">
                    <label for="sale-date">Date:</label>
                    <input type="date" id="sale-date" required>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status">
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="refunded">Refunded</option>
                    </select>
                </div>
                <button type="submit" class="btn">Save</button>
            </form>
        </div>
    </div>
    
    <script src="js/script.js"></script>
    <script>
        // Sales management JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            const saleModal = document.getElementById('sale-modal');
            const addSaleBtn = document.getElementById('add-sale-btn');
            const closeModal = document.querySelector('.close');
            const saleForm = document.getElementById('sale-form');
            const modalTitle = document.getElementById('modal-title');
            
            // Open modal for adding sale
            addSaleBtn.addEventListener('click', function() {
                modalTitle.textContent = 'Add New Sale';
                saleForm.reset();
                document.getElementById('sale-id').value = '';
                saleModal.style.display = 'block';
            });
            
            // Close modal
            closeModal.addEventListener('click', function() {
                saleModal.style.display = 'none';
            });
            
            // Edit sale
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const saleId = this.getAttribute('data-id');
                    
                    // Fetch sale data
                    fetch(`get_sale.php?id=${saleId}`)
                        .then(response => response.json())
                        .then(data => {
                            modalTitle.textContent = 'Edit Sale';
                            document.getElementById('sale-id').value = data.id;
                            document.getElementById('user').value = data.user_id;
                            document.getElementById('product').value = data.product;
                            document.getElementById('amount').value = data.amount;
                            document.getElementById('sale-date').value = data.sale_date;
                            document.getElementById('status').value = data.status;
                            saleModal.style.display = 'block';
                        });
                });
            });
            
            // Delete sale
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (confirm('Are you sure you want to delete this sale?')) {
                        const saleId = this.getAttribute('data-id');
                        
                        fetch(`delete_sale.php?id=${saleId}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    location.reload();
                                } else {
                                    alert('Error: ' + data.message);
                                }
                            });
                    }
                });
            });
            
            // Submit form
            saleForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const saleId = document.getElementById('sale-id').value;
                const url = saleId ? 'update_sale.php' : 'add_sale.php';
                const formData = new FormData(saleForm);
                
                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                });
            });
        });
    </script>
</body>
</html>