<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

$host = 'localhost';
$dbname = 'car_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// === Fetch summary stats ===
try {
    // Total cars
    $stmt = $pdo->query("SELECT COUNT(*) AS count FROM cars");
    $totalCars = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    // Total bookings
    $stmt = $pdo->query("SELECT COUNT(*) AS count FROM bookings");
    $totalBookings = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    // Total unique customers
    $stmt = $pdo->query("SELECT COUNT(DISTINCT customer_name) AS count FROM bookings");
    $totalCustomers = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
} catch (PDOException $e) {
    die("Error fetching summary stats: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard | S & I CAR RENTALS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <style>
    body { background-color: #f5f6fa; }
    .card { border-radius: 15px; }
    .sidebar {
      width: 230px;
      background-color: #28569bff;
      color: white;
      min-height: 100vh;
    }
    .sidebar a {
      \text-decoration: none;
      color: white;
      display: block;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 5px;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: #00adb5;
    }
  </style>
</head>
<body>

  <div class="d-flex">
   <!-- Sidebar -->
   <div class="sidebar p-3">
     <h3 class="text-center mb-4"><i class="fa-solid fa-car-side"></i> S & I CAR RENTALS</h3>
     <a href="index.php" class="active"><i class="fa fa-gauge me-2"></i> Dashboard</a>
     <a href="manage_cars.php"><i class="fa fa-car me-2"></i> Manage Cars</a>
     <a href="bookings.php"><i class="fa fa-calendar-check me-2"></i> Bookings</a>
     <a href="logout.php" class="text-danger"><i class="fa fa-sign-out-alt me-2"></i> Logout</a>
   </div>

   <!-- Main content -->
   <div class="flex-grow-1 p-4">
     <h2 class="mb-4">Welcome, Admin 👋</h2>

     <!-- Summar
      y Cards -->
     <div class="row mb-4">
       <div class="col-md-4">
         <div class="card text-center shadow p-3">
           <h4><i class="fa fa-car text-primary"></i></h4>
           <h5>Total Cars</h5>
           <h2><?= htmlspecialchars($totalCars) ?></h2>
         </div>
       </div>
       <div class="col-md-4">
         <div class="card text-center shadow p-3">
           <h4><i class="fa fa-calendar-check text-success"></i></h4>
           <h5>Total Bookings</h5>
           <h2><?= htmlspecialchars($totalBookings) ?></h2>
         </div>
       </div>
       <div class="col-md-4">
         <div class="card text-center shadow p-3">
           <h4><i class="fa fa-users text-warning"></i></h4>
           <h5>Total Customers</h5>
           <h2><?= htmlspecialchars($totalCustomers) ?></h2>
         </div>
       </div>
     </div>

     <!-- Chart -->
     <div class="card p-4 shadow">
       <h4 class="mb-3"><i class="fa fa-chart-bar me-2"></i>Bookings per Month</h4>
       <canvas id="bookingsChart" height="100"></canvas>
     </div>
   </div>
 </div>

 <!-- Chart Script -->
 <script>
   const ctx = document.getElementById('bookingsChart');
   const bookingsChart = new Chart(ctx, {
     type: 'bar',
     data: {
       labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
       datasets: [{
         label: 'Bookings',
         data: <?= json_encode($chartData) ?>,
         backgroundColor: 'rgba(0, 173, 181, 0.7)',
         borderColor: '#00adb5',
         borderWidth: 1,
         borderRadius: 6
        }]
      },
     options: {
       responsive: true,
       scales: {
         y: { beginAtZero: true, title: { display: true, text: 'Number of Bookings' } },
         x: { title: { display: true, text: 'Month' } }
        }
      }
    });
  </script>
</body>
</html>
