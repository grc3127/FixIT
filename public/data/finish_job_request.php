<?php
require_once __DIR__ . "/../../config/bootstrap.php";

header('Content-Type: application/json');

Security::requireAuth();
Security::requireRole([1, 2]); // Admin + Technical
Security::requirePost();
Security::requireCsrf();

$ticket_id = (int)($_POST['ticket_id'] ?? 0);
$remarks = trim($_POST['remarks'] ?? '');

if (!$ticket_id || !$remarks) {
    Security::jsonError('Missing required fields.');
}

try {
    // Only allow finishing jobs the current user is working on
    $sql = "UPDATE job_request
            SET status_id = 3,
                remarks = :remarks,
                updated_at = NOW()
            WHERE j_ticket_id = :tid
            AND taken_by_employee = :eid
            AND status_id = 2";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([
        'remarks' => $remarks,
        'tid' => $ticket_id,
        'eid' => $_SESSION['employee_id']
    ]);

    if ($success && $stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        Security::jsonError('Job not found or not assigned to you.');
    }

} catch (PDOException $e) {
    Security::jsonError('A database error occurred.', 'Finish Job Error: ' . $e->getMessage());
}
