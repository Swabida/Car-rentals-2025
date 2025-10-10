<?php
// Website configuration
define('SITE_NAME', 'Car Rental & Sales Dashboard');
define('SITE_URL', 'http://localhost/car_rental_dashboard');
define('UPLOAD_PATH', __DIR__ . '/../assets/images/');

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

// Timezone
date_default_timezone_set('UTC');

// Error reporting (turn off in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>