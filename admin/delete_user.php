<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $conn->error]);
    }
    
    $stmt->close();
}
 $conn->close();
?>
<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
requireAdmin();

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM cars WHERE id=?");
$stmt->execute([$id]);

header("Location: cars.php");
exit;
?>
