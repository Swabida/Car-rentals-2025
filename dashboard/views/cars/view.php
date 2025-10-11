<?php
require_once __DIR__ . '/../includes/header.php';
$activePage = 'cars';
?>

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

<?php
// Check if car ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    displayMessage("Car ID is required.", 'error');
    redirect('/views/cars/index.php');
}

$carId = (int)$_GET['id'];

// Get car data
$car = [
    'id' => 1,
    'make' => 'Toyota',
    'model' => 'Camry',
    'year' => 2023,
    'price' => 25000,
    'rental_price' => 75,
    'description' => 'Reliable and fuel-efficient sedan with modern features and comfortable interior. This vehicle comes with advanced safety features, infotainment system, and excellent fuel economy.',
    'image_url' => '/assets/images/cars/toyota-camry.jpg',
    'status' => 'available'
];
?>

<div class="content-wrapper">
    <div class="car-details">
        <div class="car-image-container">
            <img src="<?php echo SITE_URL . $car['image_url']; ?>" alt="<?php echo $car['make'] . ' ' . $car['model']; ?>">
            <span class="car-status <?php echo $car['status']; ?>"><?php echo ucfirst($car['status']); ?></span>
        </div>
        
        <div class="car-info">
            <h2><?php echo $car['make'] . ' ' . $car['model']; ?></h2>
            <p class="car-year">Year: <?php echo $car['year']; ?></p>
            
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
            
            <div class="description">
                <h3>Description</h3>
                <p><?php echo nl2br(htmlspecialchars($car['description'])); ?></p>
            </div>
            
            <div class="actions">
                <a href="controllers/BookingController.php?action=add&car_id=<?php echo $car['id']; ?>" class="btn btn-primary">
                    <i class="fas fa-calendar"></i> Rent This Car
                </a>
                <a href="#" class="btn btn-secondary">
                    <i class="fas fa-share-alt"></i> Share
                </a>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>