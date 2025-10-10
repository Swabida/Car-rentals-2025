<?php
// Fix include paths
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/function.php'; 
$activePage = 'dashboard';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S & I CAR RENTALl</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="sidebar">
       <div class="logo">
         <h2><i class="fas fa-car"></i> <?php echo SITE_NAME; ?></h2>
       </div>
    
       <ul class="nav-links">
          <li>
              <a href="<?php echo SITE_URL; ?>/index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                 <i class="fas fa-tachometer-alt"></i>
                 <span>Dashboard</span>
              </a>
          </li>
        
          <?php if ($isLoggedIn): ?>
            <li>
                <a href="<?php echo SITE_URL; ?>/views/cars/index.php" class="<?php echo isset($activePage) && $activePage == 'cars' ? 'active' : ''; ?>">
                    <i class="fas fa-car"></i>
                    <span>Cars</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo SITE_URL; ?>/views/rentals/index.php" class="<?php echo isset($activePage) && $activePage == 'rentals' ? 'active' : ''; ?>">
                    <i class="fas fa-calendar-check"></i>
                    <span>Rentals</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo SITE_URL; ?>/views/profile.php" class="<?php echo isset($activePage) && $activePage == 'profile' ? 'active' : ''; ?>">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo SITE_URL; ?>/includes/logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
           <?php else: ?>
            <li>
                <a href="<?php echo SITE_URL; ?>/views/login.php">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo SITE_URL; ?>/views/register.php">
                    <i class="fas fa-user-plus"></i>
                    <span>Register</span>
                </a>
            </li>
           <?php endif; ?>
       </ul>
    </nav>
    <div class="page-header">
      <h1>Dashboard</h1>
    </div>

    <!-- Dashboard Stats -->
    <div class="dashboard-stats">
        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-car"></i></div>
          <div class="stat-content">
              <h3>Total Cars</h3>
              <p class="stat-value">42</p>
          </div>
       </div>

       <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
          <div class="stat-content">
              <h3>Available Cars</h3>
              <p class="stat-value">28</p>
           </div>
       </div>

       <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-car-side"></i></div>
          <div class="stat-content">
              <h3>Rented Cars</h3>
              <p class="stat-value">10</p>
           </div>
       </div>

       <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
          <div class="stat-content">
             <h3>Monthly Revenue</h3>
             <p class="stat-value">$12,450</p>
           </div>
       </div>
   </div>

   <!-- Dashboard Content -->
   <div class="dashboard-content">
       <!-- Recently Added Cars -->
       <div class="dashboard-section">
            <h2>Recently Added Cars</h2>
            <div class="recent-cars">
                <?php
               // Example data (replace later with database results)
               $recentCars = [
                   [
                     'id' => 1,
                     'make' => 'Toyota',
                     'model' => 'Camry',
                     'year' => 2023,
                     'price' => 25000,
                     'image_url' => '/assets/images/cars/toyota-camry.jpg'
                  ],
                  [
                     'id' => 2,
                     'make' => 'Honda',
                     'model' => 'Accord',
                     'year' => 2023,
                     'price' => 28000,
                     'image_url' => '/assets/images/cars/honda-accord.jpg'
                   ],
                   [
                     'id' => 3,
                     'make' => 'Ford',
                     'model' => 'Mustang',
                     'year' => 2022,
                     'price' => 35000,
                     'image_url' => '/assets/images/cars/ford-mustang.jpg'
                   ]
                ];

                foreach ($recentCars as $car): ?>
                <div class="car-card">
                    <img src="<?php echo SITE_URL . $car['image_url']; ?>" alt="<?php echo $car['make'] . ' ' . $car['model']; ?>">
                    <div class="car-info">
                        <h3><?php echo $car['make'] . ' ' . $car['model']; ?></h3>
                        <p>Year: <?php echo $car['year']; ?></p>
                        <p class="price"><?php echo formatCurrency($car['price']); ?></p>
                    </div>
                    <div class="car-actions">
                        <a href="cars/view.php?id=<?php echo $car['id']; ?>" class="btn btn-view">View</a>
                        <a href="cars/edit.php?id=<?php echo $car['id']; ?>" class="btn btn-edit">Edit</a>
                    </div>
                </div>
                <?php endforeach; ?>
           </div>
       </div>
    </div>
    <!-- Upcoming Rentals -->
    <div class="dashboard-section">
        <h2>Upcoming Rentals</h2>
        <div class="rentals-table">
            <table>
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Car</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John Doe</td>
                        <td>Toyota Camry</td>
                        <td>2023-06-15</td>
                        <td>2023-06-20</td>
                        <td>$750</td>
                        <td><span class="status-badge active">Active</span></td>
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>Honda Accord</td>
                        <td>2023-06-18</td>
                        <td>2023-06-25</td>
                        <td>$1,050</td>
                        <td><span class="status-badge active">Active</span></td>
                    </tr>
                    <tr>
                        <td>Robert Johnson</td>
                        <td>Ford Mustang</td>
                        <td>2023-06-20</td>
                        <td>2023-06-22</td>
                        <td>$600</td>
                        <td><span class="status-badge active">Active</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    

 <?php require_once __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
