<?php
$currentUserId = $_SESSION['employee_id'];
$today = date('Y-m-d');

// 1. New Inventory Requests (Status 1)
$sqlNew = "SELECT COUNT(*) FROM inventory_request WHERE status_id = 1";
$countNew = $pdo->query($sqlNew)->fetchColumn();

// 2. Pending Inventory  Requests (Status 2 - In Progress)
$sqlPending = "SELECT COUNT(*) FROM inventory_request WHERE status_id = 2";
$countPending = $pdo->query($sqlPending)->fetchColumn();

// 3. Finished Inventory  Requests TODAY (Status 3)
// We use DATE(updated_at) to match only today's completed tasks
$sqlFinished = "SELECT COUNT(*) FROM inventory_request 
                WHERE status_id = 3 
                AND DATE(updated_at) = :today";
$stmtFinished = $pdo->prepare($sqlFinished);
$stmtFinished->execute(['today' => $today]);
$countFinished = $stmtFinished->fetchColumn();

// Fetch NEW Inventory Requests
$sqlInv = "SELECT 
            ir.i_ticket_id, 
            ir.item_id,       -- Added item_id for the collapse trigger
            ir.description, 
            ir.updated_at,    -- Use the real column name here
            i.article,
            e.first_name, 
            e.last_name, 
            e.profile_pic,
            d.dept_name
        FROM inventory_request ir
        JOIN item i ON ir.item_id = i.item_id
        JOIN employee e ON ir.requested_by_employee = e.employee_id
        JOIN department d ON e.dept_id = d.dept_id
        WHERE ir.status_id = 1 
        ORDER BY ir.updated_at ASC";

$stmtInv = $pdo->query($sqlInv);
$inventoryRequests = $stmtInv->fetchAll();

$checkActive = $pdo->prepare("SELECT COUNT(*) FROM job_request WHERE taken_by_employee = ? AND status_id = 2");
$checkActive->execute([$currentUserId]);
$hasActiveTask = ($checkActive->fetchColumn() > 0);
// foreach ($inventoryRequests as $row) {
//     var_dump($row);
// }
?>