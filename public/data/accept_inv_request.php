<?php
require_once __DIR__ . "/../../config/bootstrap.php";

header('Content-Type: application/json');

Security::requireAuth();
Security::requireRole([1, 2]); // Admin + Technical
Security::requirePost();
Security::requireCsrf();

$inventoryId = (int)($_POST['ticket_id'] ?? 0);
if ($inventoryId <= 0) {
    Security::jsonError('Invalid request ID.');
}

$employeeId = $_SESSION['employee_id'];

try {
    $sql = "UPDATE inventory_request
            SET status_id = 2,
                given_by_employee = :eid,
                updated_at = NOW()
            WHERE i_ticket_id = :iid
            AND status_id = 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'eid' => $employeeId,
        'iid' => $inventoryId
    ]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Inventory request accepted.']);
    } else {
        Security::jsonError('Request already processed or unavailable.');
    }

} catch (PDOException $e) {
    Security::jsonError('A database error occurred.', 'Accept Inventory Error: ' . $e->getMessage());
}
