<?php
require_once __DIR__ . '/../../includes/header.php';
$activePage = 'cars';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Management</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <div class="page-header">
        <h1>Car Management</h1>
        <div class="header-actions">
            <form method="get" action="" class="search-form">
                <input type="text" name="search" placeholder="Search cars..." 
                       value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
            <a href="add.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Car
            </a>
        </div>
    </div>

    <div class="content-wrapper">
        <?php
        // Include the controller
        require_once __DIR__ . '/../../controllers/CarController.php';
        $carController = new CarController();
        
        // Handle search
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $cars = $carController->search($_GET['search']);
        } else {
            $cars = $carController->index();
        }
        ?>

        <div class="cars-grid">
            <?php if (count($cars) > 0): ?>
                <?php foreach ($cars as $car): ?>
                    <div class="car-card">
                        <div class="car-image">
                            <?php if (!empty($car['image_url'])): ?>
                                <img src="<?php echo SITE_URL . $car['image_url']; ?>" 
                                     alt="<?php echo $car['make'] . ' ' . $car['model']; ?>">
                            <?php else: ?>
                                <img src="<?php echo SITE_URL; ?>/assets/images/default-car.jpg" alt="Default car image">
                            <?php endif; ?>
                            <span class="car-status <?php echo $car['status']; ?>">
                                <?php echo ucfirst($car['status']); ?>
                            </span>
                        </div>

                        <div class="car-info">
                            <h3><?php echo $car['make'] . ' ' . $car['model']; ?></h3>
                            <p>Year: <?php echo $car['year']; ?></p>
                            <p class="price">Price: <?php echo formatCurrency($car['price']); ?></p>
                            <p class="rental-price">Rental: <?php echo formatCurrency($car['rental_price']); ?>/day</p>
                            <p class="description"><?php echo substr($car['description'], 0, 100); ?>...</p>
                        </div>

                        <div class="car-actions">
                            <a href="view.php?id=<?php echo $car['id']; ?>" class="btn btn-view">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="edit.php?id=<?php echo $car['id']; ?>" class="btn btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="#" class="btn btn-delete" data-id="<?php echo $car['id']; ?>" data-action="delete">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-results">
                    <i class="fas fa-car"></i>
                    <p>No cars found.</p>
                    <a href="add.php" class="btn btn-primary">Add your first car</a>
                </div>
            <?php endif; ?>
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
                <p>Are you sure you want to delete this car? This action cannot be undone.</p>
                <div class="modal-actions">
                    <button id="cancelDelete" class="btn btn-secondary">Cancel</button>
                    <button id="confirmDelete" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        const deleteModal = document.getElementById('deleteModal');
        const confirmDeleteBtn = document.getElementById('confirmDelete');
        const cancelDeleteBtn = document.getElementById('cancelDelete');
        const closeBtn = document.querySelector('.close');

        let carIdToDelete = null;

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                carIdToDelete = this.getAttribute('data-id');
                deleteModal.style.display = 'block';
            });
        });

        closeBtn.addEventListener('click', () => deleteModal.style.display = 'none');
        cancelDeleteBtn.addEventListener('click', () => deleteModal.style.display = 'none');

        confirmDeleteBtn.addEventListener('click', function() {
            if (carIdToDelete) {
                window.location.href = `../../controllers/CarController.php?action=delete&id=${carIdToDelete}`;
            }
        });

        window.addEventListener('click', function(e) {
            if (e.target == deleteModal) {
                deleteModal.style.display = 'none';
            }
        });
    });
    </script>
   <?php require_once __DIR__ . '/../../includes/footer.php'; ?>
</body>
</html>

