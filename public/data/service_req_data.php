<?php

require_once __DIR__ . "/../../config/db.php";


// Assuming $pdo and $loggedInEmployeeId are already defined in your session/handler
$loggedInEmployeeId = $_SESSION['employee_id'];

/**
 * 1. CHECK JOB REQUEST STATUS (Gatekeeper Logic)
 * We fetch the status of the most recent active/pending job.
 */
$stmtCheckJob = $pdo->prepare("
    SELECT j_ticket_id, status_id, remarks 
    FROM job_request 
    WHERE requested_by_employee = ? 
    AND status_id IN (1, 2, 3) 
    ORDER BY created_at DESC LIMIT 1
");
$stmtCheckJob->execute([$loggedInEmployeeId]);
$activeJob = $stmtCheckJob->fetch();

$hasActiveJob  = ($activeJob && in_array((int)$activeJob['status_id'], [1, 2, 3], true));
$needsFeedback = ($activeJob && (int)$activeJob['status_id'] === 3);

// 2. Check inventory request status
$stmtCheckInv = $pdo->prepare("SELECT COUNT(*) FROM inventory_request WHERE requested_by_employee = ? AND status_id IN (1, 2)");
$stmtCheckInv->execute([$loggedInEmployeeId]);
$hasActiveInv = $stmtCheckInv->fetchColumn() > 0;

// 3. Fetch devices and articles
$stmt = $pdo->query("SELECT device_id, device_name FROM device");
$devices = $stmt->fetchAll();

$itemStmt = $pdo->query("
    SELECT i.item_id, i.device_id, i.article, s.status_name
    FROM item i
    INNER JOIN item_status s ON i.status_id = s.status_id
    WHERE i.status_id = 1
    ORDER BY i.article ASC
");
$availableItems = $itemStmt->fetchAll();

// Group items by device_id
$articleMap = [];
foreach ($availableItems as $item) {
    $articleMap[$item['device_id']][$item['item_id']] = $item['article'];
}

// When called directly (not from view), return JSON
if (empty($noDisplay)) {
    header('Content-Type: application/json');
    echo json_encode($articleMap ?: (object)[]);
    exit;
}
