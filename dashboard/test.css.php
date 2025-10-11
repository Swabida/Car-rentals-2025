<?php
echo "<h1>Path Testing</h1>";
echo "Current directory: " . __DIR__ . "<br>";

// Test header path
 $headerPath = __DIR__ . '/../includes/header.php';
echo "Header file path: " . $headerPath . "<br>";
echo "Header file exists: " . (file_exists($headerPath) ? 'Yes' : 'No') . "<br>";

// Test footer path
 $footerPath = __DIR__ . '/../includes/footer.php';
echo "Footer file path: " . $footerPath . "<br>";
echo "Footer file exists: " . (file_exists($footerPath) ? 'Yes' : 'No') . "<br>";

// Test config files
 $configPath = __DIR__ . '/../config/config.php';
echo "Config file path: " . $configPath . "<br>";
echo "Config file exists: " . (file_exists($configPath) ? 'Yes' : 'No') . "<br>";

// Test CSS files
 $cssPath1 = __DIR__ . '/../css/style.css';
echo "CSS file 1 path: " . $cssPath1 . "<br>";
echo "CSS file 1 exists: " . (file_exists($cssPath1) ? 'Yes' : 'No') . "<br>";

 $cssPath2 = __DIR__ . '/../css/dashboard.css';
echo "CSS file 2 path: " . $cssPath2 . "<br>";
echo "CSS file 2 exists: " . (file_exists($cssPath2) ? 'Yes' : 'No') . "<br>";

if (file_exists($headerPath) && file_exists($footerPath) && file_exists($configPath)) {
    echo "<h2>Testing Include</h2>";
    try {
        require_once $headerPath;
        echo "Header included successfully!<br>";
    } catch (Exception $e) {
        echo "Error including header: " . $e->getMessage() . "<br>";
    }
}
?>