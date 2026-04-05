<?php
$currentUserId = $_SESSION['employee_id'];
$today = date('Y-m-d');

// 1. New Job Requests (Status 1)
$sqlNew = "SELECT COUNT(*) FROM job_request WHERE status_id = 1";
$countNew = $pdo->query($sqlNew)->fetchColumn();

// 2. Pending Job Requests (Status 2 - In Progress)
$sqlPending = "SELECT COUNT(*) FROM job_request WHERE status_id = 2";
$countPending = $pdo->query($sqlPending)->fetchColumn();

// 3. Finished Job Requests TODAY (Status 3)
// We use DATE(updated_at) to match only today's completed tasks
$sqlFinished = "SELECT COUNT(*) FROM job_request 
                WHERE status_id = 3 
                AND DATE(updated_at) = :today";
$stmtFinished = $pdo->prepare($sqlFinished);
$stmtFinished->execute(['today' => $today]);
$countFinished = $stmtFinished->fetchColumn();

$activeJobSql = "SELECT 
            jr.j_ticket_id, 
            jr.description, 
            jr.created_at,
            e.first_name, 
            e.last_name, 
            e.profile_pic,
            d.dept_name
        FROM job_request jr
        JOIN employee e ON jr.requested_by_employee = e.employee_id
        JOIN department d ON e.dept_id = d.dept_id
        WHERE jr.taken_by_employee = :eid 
        AND jr.status_id = 2 -- Status 2 = In Progress
        LIMIT 1";

$activeStmt = $pdo->prepare($activeJobSql);
$activeStmt->execute(['eid' => $currentUserId]);
$activeJob = $activeStmt->fetch();




$sql = "SELECT 
            jr.j_ticket_id, 
            jr.description, 
            jr.created_at,
            e.first_name, 
            e.last_name, 
            e.profile_pic,
            d.dept_name,
            rs.status_name as request_type -- Using status or a static 'Digital' as per your UI
        FROM job_request jr
        JOIN employee e ON jr.requested_by_employee = e.employee_id
        JOIN department d ON e.dept_id = d.dept_id
        JOIN request_status rs ON jr.status_id = rs.status_id
        WHERE jr.status_id = 1 -- 1 represents 'Pending' or 'New'
        ORDER BY jr.created_at ASC";

$stmt = $pdo->query($sql);
$jobRequests = $stmt->fetchAll();

// Check if this technician already has a job "In Progress" (Status 2 in most systems)
$checkSql = "SELECT COUNT(*) FROM job_request 
             WHERE taken_by_employee = :eid 
             AND status_id = 2"; // Adjust '2' to your 'In Progress' ID
$checkStmt = $pdo->prepare($checkSql);
$checkStmt->execute(['eid' => $currentUserId]);
$hasActiveTask = ($checkStmt->fetchColumn() > 0);

echo "Debug: Logged in ID is: " . $currentUserId . " | Has Active Task: " . ($hasActiveTask ? 'YES' : 'NO');
?>