<?php
require_once __DIR__ . "/../../config/bootstrap.php";

header('Content-Type: application/json');

Security::requireAuth();
Security::requireRole([1, 2]); // Admin + Technical
Security::requirePost();
Security::requireCsrf();

$ticket_id = (int)($_POST['ticket_id'] ?? 0);
if (!$ticket_id) {
    Security::jsonError('Missing required fields.');
}

$employeeId = $_SESSION['employee_id'];

try {
    $sql = "UPDATE inventory_request
            SET status_id = 5,
                received_by_employee = :eid,
                date_returned = NOW(),
                updated_at = NOW()
            WHERE i_ticket_id = :tid
            AND status_id = 2";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([
        'eid' => $employeeId,
        'tid' => $ticket_id
    ]);

    if ($success && $stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        Security::jsonError('Request not found or already completed.');
    }

} catch (PDOException $e) {
    Security::jsonError('A database error occurred.', 'Finish Inventory Error: ' . $e->getMessage());
}
