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
$activeJob = $stmtCheckJob->fetch(PDO::FETCH_ASSOC);

// Initialize variables to prevent "Undefined Variable" warnings in the view
$hasActiveJob  = ($activeJob && in_array($activeJob['status_id'], [1, 2, 3]));
$needsFeedback = ($activeJob && $activeJob['status_id'] == 5);

/**
 * 2. CHECK INVENTORY REQUEST STATUS
 */
$stmtCheckInv = $pdo->prepare("SELECT COUNT(*) FROM inventory_request WHERE requested_by_employee = ? AND status_id IN (1, 2)");
$stmtCheckInv->execute([$loggedInEmployeeId]);
$hasActiveInv = $stmtCheckInv->fetchColumn() > 0;

/**
 * 3. FETCH DEVICES AND ARTICLES
 */
// Fetch all devices for the first dropdown
$stmt = $pdo->query("SELECT device_id, device_name FROM device");
$devices = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch only 'Available' items (status_id = 1)
$itemStmt = $pdo->query("
    SELECT i.item_id, i.device_id, i.article, s.status_name 
    FROM item i
    INNER JOIN item_status s ON i.status_id = s.status_id
    WHERE i.status_id = 1 
    ORDER BY i.article ASC
");
$availableItems = $itemStmt->fetchAll(PDO::FETCH_ASSOC);

// Group items by device_id for the JavaScript map
$articleMap = [];
foreach ($availableItems as $item) {
    // Use item_id as the key for the associative array
    $articleMap[$item['device_id']][$item['item_id']] = $item['article'];
}

// Ensure $jsonArticleMap is always defined for the script tag
if(!$noDisplay) {

    header('Content-Type: application/json');
    echo json_encode($articleMap ?? (object)[]);
}

