<?php
require_once __DIR__ . "/../../config/db.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$employeeId = (int)($_POST['employee_id'] ?? 0);
if ($employeeId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid User ID.']);
    exit;
}

// Optional: Prevent deleting the main admin or the current logged in user
// For now, simple delete

try {
    $sql = "DELETE FROM employee WHERE employee_id = :id";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute(['id' => $employeeId]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'User deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete user.']);
    }

} catch (PDOException $e) {
    // Handle foreign key constraint errors
    if ($e->getCode() == '23000') {
         echo json_encode(['success' => false, 'message' => 'Cannot delete user as they have associated records (e.g., job requests).']);
    } else {
         echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}
