<?php
header('Content-Type: application/json');
require_once __DIR__ . "/../../config/db.php";
$ticket_id = isset($_POST['ticket_id']) ? $_POST['ticket_id'] : null;
$remarks = isset($_POST['remarks']) ? trim($_POST['remarks']) : null;

if (!$ticket_id || !$remarks) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
    exit;
}

try {
    $sql = "UPDATE job_request 
            SET status_id = 3, 
                remarks = :remarks, 
                updated_at = NOW() 
            WHERE j_ticket_id = :tid";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([
        'remarks' => $remarks,
        'tid' => $ticket_id
    ]);

    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update database.']);
    }

} catch (PDOException $e) {
    // Return the actual SQL error for debugging
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

?>