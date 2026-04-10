<?php
require_once __DIR__ . "/../../config/bootstrap.php";

header('Content-Type: application/json');

Security::requireAuth();
Security::requireRole([1, 2]); // Admin + Technical
Security::requirePost();
Security::requireCsrf();

$ticketId = (int)($_POST['ticket_id'] ?? 0);
if ($ticketId <= 0) {
    Security::jsonError('Invalid ticket ID.');
}

$employeeId = $_SESSION['employee_id'];

try {
    $sql = "UPDATE job_request
            SET status_id = 2,
                taken_by_employee = :eid,
                updated_at = NOW()
            WHERE j_ticket_id = :tid
            AND status_id = 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'eid' => $employeeId,
        'tid' => $ticketId
    ]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        Security::jsonError('Job already taken or not found.');
    }
} catch (PDOException $e) {
    Security::jsonError('A database error occurred.', 'Accept Job Error: ' . $e->getMessage());
}
