<?php
session_start();
require_once __DIR__ . "/../../config/db.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ticket_id'])) {
    $ticketId = $_POST['ticket_id'];
    $employeeId = $_SESSION['employee_id']; // Your Admin ID (1)

    try {
        // Update the job request
        $sql = "UPDATE job_request 
                SET status_id = 2, 
                    taken_by_employee = :eid,
                    updated_at = NOW() 
                WHERE j_ticket_id = :tid 
                AND status_id = 1"; // Only accept if it's still 'New'

        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            'eid' => $employeeId,
            'tid' => $ticketId
        ]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Job already taken or not found.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}