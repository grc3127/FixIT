<?php
// Start session to get the logged-in employee ID
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Clear any accidental output and set header
if (ob_get_length()) ob_clean();
header('Content-Type: application/json');

// Include your database connection
require_once __DIR__ . "/../../db.php"; 

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method.");
    }

    $form_type = $_POST['form_type'] ?? '';
    $employee_id = $_SESSION['employee_id'] ?? null;

    if (!$employee_id) {
        throw new Exception("User session expired. Please log in again.");
    }

    /**
     * STATUS MAPPING FROM 5PM.SQL:
     * 1 = Pending
     * 2 = In Progress
     * 3 = Pending Feedback (The Gate)
     * 5 = Completed (The Unlocker)
     */
    $status_pending = 1; 
    $status_completed = 5; 

    // --- CASE 1: JOB REQUEST ---
    if ($form_type === 'job_request') {
        // Validation: Block if user has an active job (1, 2) OR needs to provide feedback (3)
        $checkSql = "SELECT COUNT(*) FROM job_request WHERE requested_by_employee = ? AND status_id IN (1, 2, 3)";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$employee_id]);
        
        if ($checkStmt->fetchColumn() > 0) {
            throw new Exception("You have an ongoing request or pending feedback that needs attention.");
        }

        $job_type = $_POST['jobType'] ?? ''; 
        $description = $_POST['jobDescription'] ?? '';

        if (empty($description)) throw new Exception("Please provide a description.");

        $sql = "INSERT INTO job_request (requested_by_employee, request_type, description, status_id) 
                VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$employee_id, $job_type, $description, $status_pending]);

        echo json_encode(['status' => 'success', 'message' => 'Job request submitted successfully!']);

    // --- CASE 2: INVENTORY REQUEST ---
    } elseif ($form_type === 'inventory_request') {
        $device_id = $_POST['device_id'] ?? '';
        $article_name = $_POST['article_name'] ?? '';
        $purpose = $_POST['invDescription'] ?? '';

        $sql = "INSERT INTO inventory_request (requested_by_employee, device_id, article_name, purpose, status_id) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$employee_id, $device_id, $article_name, $purpose, $status_pending]);

        echo json_encode(['status' => 'success', 'message' => 'Inventory request submitted successfully!']);

    // --- CASE 3: FEEDBACK SUBMISSION (The Gate Unlocker) ---
    } elseif ($form_type === 'feedback_submission') {
        $j_ticket_id = $_POST['j_ticket_id'] ?? '';
        $rating = $_POST['rating'] ?? '';
        $comments = $_POST['user_feedback'] ?? '';

        if (empty($j_ticket_id) || empty($rating)) {
            throw new Exception("Please select a rating before submitting.");
        }

        $pdo->beginTransaction();

        // 1. Insert into feedback table
        // Note: rating is stored as a decimal/tinyint in your schema
        $sqlFeed = "INSERT INTO feedback (j_ticket_id, employee_id, rating, comments) VALUES (?, ?, ?, ?)";
        $stmtFeed = $pdo->prepare($sqlFeed);
        $stmtFeed->execute([$j_ticket_id, $employee_id, $rating, $comments]);

        // 2. Update job_request to Status 5 (Completed) 
        // This makes the 'needsFeedback' check in service_req_data.php return false.
        $sqlUpdate = "UPDATE job_request SET status_id = ?, updated_at = NOW() 
                      WHERE j_ticket_id = ? AND requested_by_employee = ?";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->execute([$status_completed, $j_ticket_id, $employee_id]);

        $pdo->commit();

        echo json_encode(['status' => 'success', 'message' => 'Thank you! Your feedback has been recorded and the request is now closed.']);

    } else {
        throw new Exception("Invalid form submission type.");
    }

} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
