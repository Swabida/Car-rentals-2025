<?php
// Set active page for navigation highlighting
$activePage = 'cars';

// Include the header
require_once __DIR__ . '/../../includes/header.php';

// Check if car ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    displayMessage("Car ID is required.", 'error');
    redirect('/views/cars/index.php');
}

$carId = (int)$_GET['id'];

// Include the CarController
require_once __DIR__ . '/../../controllers/CarController.php';
$carController = new CarController();

// Fetch the car details
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
    <title>Car Details</title>
</head>
<body>

    <!-- Page Header -->
    <div class="page-header">
        <h1>Car Details</h1>
        <div class="header-actions">
            <a href="edit.php?id=<?php echo $car['id']; ?>" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="index.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Cars
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="content-wrapper">
        <div class="car-details">

            <!-- Car Image -->
            <div class="car-image-container">
                <?php if (!empty($car['image_url'])): ?>
                    <img src="<?php echo SITE_URL . $car['image_url']; ?>" 
                         alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>">
                <?php else: ?>
                    <img src="<?php echo SITE_URL; ?>/assets/images/default-car.jpg" 
                         alt="Default car image">
                <?php endif; ?>

                <span class="car-status <?php echo $car['status']; ?>">
                    <?php echo ucfirst($car['status']); ?>
                </span>
            </div>

            <!-- Car Info -->
            <div class="car-info">
                <h2><?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?></h2>
                <p class="car-year">Year: <?php echo htmlspecialchars($car['year']); ?></p>

                <!-- Pricing -->
                <div class="pricing">
                    <div class="price-item">
                        <h3>Sale Price</h3>
                        <p class="price-value"><?php echo formatCurrency($car['price']); ?></p>
                    </div>

                    <div class="price-item">
                        <h3>Rental Price</h3>
                        <p class="price-value"><?php echo formatCurrency($car['rental_price']); ?>/day</p>
                    </div>
                </div>

                <!-- Description -->
                <div class="description">
                    <h3>Description</h3>
                    <p><?php echo nl2br(htmlspecialchars($car['description'])); ?></p>
                </div>

                <!-- Actions -->
                <div class="actions">
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-calendar"></i> Rent This Car
                    </a>
                    <a href="#" class="btn btn-secondary">
                        <i class="fas fa-share-alt"></i> Share
                    </a>
                </div>
            </div>

        </div>
    </div>

    <?php require_once __DIR__ . '/../../includes/footer.php'; ?>

</body>
</html>
