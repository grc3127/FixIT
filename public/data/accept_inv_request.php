<?php
session_start();
require_once __DIR__ . "/../../config/db.php";

header('Content-Type: application/json');

// Check if the user is logged in
if (!isset($_SESSION['employee_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inventory_id'])) {
    $inventoryId = $_POST['inventory_id'];
    $employeeId = $_SESSION['employee_id']; 

    try {
        // 1. Update the inventory request status
        // status_id = 1 (New/Pending), status_id = 2 (Approved/In Progress)
        $sql = "UPDATE inventory_request 
                SET status_id = 2, 
                    processed_by_employee = :eid,
                    updated_at = NOW() 
                WHERE i_ticket_id = :iid 
                AND status_id = 1"; 

        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            'eid' => $employeeId,
            'iid' => $inventoryId
        ]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Inventory request accepted.']);
        } else {
            // This occurs if the request was already handled or doesn't exist
            echo json_encode(['success' => false, 'message' => 'Request already processed or unavailable.']);
        }

    } catch (PDOException $e) {
        // Use a generic message in production for security, but $e->getMessage() is fine for debugging
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request parameters.']);
}