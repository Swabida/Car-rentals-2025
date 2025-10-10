<?php
// Set active page for navigation highlighting
$activePage = 'cars';

// Include the site header
require_once __DIR__ . '/../../includes/header.php';

// Validate and retrieve the car ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    displayMessage("Car ID is required.", 'error');
    redirect('/views/cars/index.php');
}

$carId = (int)$_GET['id'];

// Include CarController
require_once __DIR__ . '/../../controllers/CarController.php';
$carController = new CarController();

// Fetch car details
$car = $carController->show($carId);

if (!$car) {
    displayMessage("Car not found.", 'error');
    redirect('/views/cars/index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
</head>
<body>

    <!-- Page Header -->
    <div class="page-header">
        <h1>Edit Car</h1>
        <a href="index.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Cars
        </a>
    </div>

    <!-- Edit Form -->
    <div class="content-wrapper">
        <div class="form-container">
            <form 
                action="../../controllers/CarController.php?action=edit&id=<?php echo $carId; ?>" 
                method="post" 
                enctype="multipart/form-data" 
                id="carForm"
            >
                <!-- Row 1 -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="make">Make *</label>
                        <input 
                            type="text" 
                            id="make" 
                            name="make" 
                            value="<?php echo htmlspecialchars($car['make']); ?>" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="model">Model *</label>
                        <input 
                            type="text" 
                            id="model" 
                            name="model" 
                            value="<?php echo htmlspecialchars($car['model']); ?>" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="year">Year *</label>
                        <input 
                            type="number" 
                            id="year" 
                            name="year" 
                            value="<?php echo $car['year']; ?>" 
                            min="1900" 
                            max="2100" 
                            required
                        >
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Price ($) *</label>
                        <input 
                            type="number" 
                            id="price" 
                            name="price" 
                            value="<?php echo $car['price']; ?>" 
                            min="0" 
                            step="0.01" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="rental_price">Rental Price ($/day) *</label>
                        <input 
                            type="number" 
                            id="rental_price" 
                            name="rental_price" 
                            value="<?php echo $car['rental_price']; ?>" 
                            min="0" 
                            step="0.01" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="status">Status *</label>
                        <select id="status" name="status" required>
                            <option value="available" <?php echo $car['status'] == 'available' ? 'selected' : ''; ?>>Available</option>
                            <option value="rented" <?php echo $car['status'] == 'rented' ? 'selected' : ''; ?>>Rented</option>
                            <option value="sold" <?php echo $car['status'] == 'sold' ? 'selected' : ''; ?>>Sold</option>
                            <option value="maintenance" <?php echo $car['status'] == 'maintenance' ? 'selected' : ''; ?>>Maintenance</option>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4"
                    ><?php echo htmlspecialchars($car['description']); ?></textarea>
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <label for="image">Car Image</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <div class="image-preview" id="imagePreview">
                        <?php if (!empty($car['image_url'])): ?>
                            <img src="<?php echo SITE_URL . $car['image_url']; ?>" alt="Current image">
                        <?php else: ?>
                            <img src="<?php echo SITE_URL; ?>/assets/images/default-car.jpg" alt="Preview">
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Car
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-undo"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Image Preview Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            
            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>

    <?php require_once __DIR__ . '/../../includes/footer.php'; ?>
</body>
</html>
