<?php
require_once __DIR__ . "/../../config/bootstrap.php";

header('Content-Type: application/json');

Security::requireAuth();
Security::requireRole([3]); // Employee only
Security::requirePost();
Security::requireCsrf();

try {
    $form_type = $_POST['form_type'] ?? '';
    $employee_id = $_SESSION['employee_id'];

    $status_pending = 1;
    $status_completed = 5;

    // --- CASE 1: JOB REQUEST ---
    if ($form_type === 'job_request') {
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM job_request WHERE requested_by_employee = ? AND status_id IN (1, 2, 3)");
        $checkStmt->execute([$employee_id]);

        if ($checkStmt->fetchColumn() > 0) {
            Security::jsonError('You have an ongoing request or pending feedback that needs attention.');
        }

        $job_type = trim($_POST['jobType'] ?? '');
        $description = trim($_POST['jobDescription'] ?? '');

        if (empty($description)) {
            Security::jsonError('Please provide a description.');
        }

        $sql = "INSERT INTO job_request (requested_by_employee, request_type, description, status_id)
                VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$employee_id, $job_type, $description, $status_pending]);

        echo json_encode(['success' => true, 'status' => 'success', 'message' => 'Job request submitted successfully!']);

    // --- CASE 2: INVENTORY REQUEST ---
    } elseif ($form_type === 'inventory_request') {
        $item_id = (int)($_POST['item_id'] ?? 0);
        $purpose = trim($_POST['invDescription'] ?? '');

        if (!$item_id || empty($purpose)) {
            Security::jsonError('Please fill in all required fields.');
        }

        $sql = "INSERT INTO inventory_request (requested_by_employee, item_id, `description`, status_id, date_borrowed)
                VALUES (?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$employee_id, $item_id, $purpose, $status_pending]);

        echo json_encode(['success' => true, 'status' => 'success', 'message' => 'Inventory request submitted successfully!']);

    // --- CASE 3: FEEDBACK SUBMISSION ---
    } elseif ($form_type === 'feedback_submission') {
        $j_ticket_id = (int)($_POST['j_ticket_id'] ?? 0);
        $rating = (int)($_POST['rating'] ?? 0);
        $comments = trim($_POST['user_feedback'] ?? '');

        if (!$j_ticket_id || !$rating || $rating < 1 || $rating > 5) {
            Security::jsonError('Please select a valid rating before submitting.');
        }

        $pdo->beginTransaction();

        $sqlFeed = "INSERT INTO feedback (j_ticket_id, employee_id, rating, comments) VALUES (?, ?, ?, ?)";
        $stmtFeed = $pdo->prepare($sqlFeed);
        $stmtFeed->execute([$j_ticket_id, $employee_id, $rating, $comments]);

        $sqlUpdate = "UPDATE job_request SET status_id = ?, updated_at = NOW()
                      WHERE j_ticket_id = ? AND requested_by_employee = ?";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->execute([$status_completed, $j_ticket_id, $employee_id]);

        $pdo->commit();

        echo json_encode(['success' => true, 'status' => 'success', 'message' => 'Thank you! Your feedback has been recorded and the request is now closed.']);

    } else {
        Security::jsonError('Invalid form submission type.');
    }

} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    Security::jsonError('An error occurred. Please try again.', 'ServReq Error: ' . $e->getMessage());
}
