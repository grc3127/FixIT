<?php
require_once __DIR__ . "/../../config/bootstrap.php";

header('Content-Type: application/json');

Security::requireAuth();
Security::requireRole([1]); // Admin only
Security::requirePost();
Security::requireCsrf();

$employeeId = (int)($_POST['employee_id'] ?? 0);
if ($employeeId <= 0) {
    Security::jsonError('Invalid User ID.');
}

// Prevent self-deletion
if ($employeeId === (int)$_SESSION['employee_id']) {
    Security::jsonError('You cannot delete your own account.');
}

try {
    $sql = "DELETE FROM employee WHERE employee_id = :id";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute(['id' => $employeeId]);

    if ($success && $stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'User deleted successfully.']);
    } else {
        Security::jsonError('User not found or already deleted.');
    }

} catch (PDOException $e) {
    if ($e->getCode() == '23000') {
        Security::jsonError('Cannot delete user as they have associated records (e.g., job requests).');
    }
    Security::jsonError('A database error occurred.', 'Delete User Error: ' . $e->getMessage());
}
