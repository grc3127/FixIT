<?php
$currentUserId = $_SESSION['employee_id'];
$today = date('Y-m-d');

// 1. New Job Requests (Status 1 - No one has taken it yet)
$sqlNew = "SELECT COUNT(*) FROM job_request WHERE status_id = 1";
$countNew = $pdo->query($sqlNew)->fetchColumn();

// 2. Your Ongoing Task (Status 2 - You are currently working on it)
$sqlPending = "SELECT COUNT(*) FROM job_request WHERE status_id = 2 AND taken_by_employee = :eid";
$stmtPending = $pdo->prepare($sqlPending);
$stmtPending->execute(['eid' => $currentUserId]);
$countPending = $stmtPending->fetchColumn();

// 3. Tasks you finished TODAY (Status 3 - Waiting for user feedback)
// Technicians consider a task "Finished" once they move it to status 5
$sqlFinished = "SELECT COUNT(*) FROM job_request 
                WHERE status_id = 3 
                AND taken_by_employee = :eid
                AND DATE(updated_at) = :today";
$stmtFinished = $pdo->prepare($sqlFinished);
$stmtFinished->execute(['today' => $today, 'eid' => $currentUserId]);
$countFinished = $stmtFinished->fetchColumn();

/**
 * FETCH CURRENT ACTIVE TASK
 * This is the specific job the technician is currently handling.
 */
$activeJobSql = "SELECT 
            jr.j_ticket_id, 
            jr.description,
            jr.request_type, 
            jr.created_at,
            e.first_name, 
            e.last_name, 
            e.profile_pic,
            d.dept_name
        FROM job_request jr
        JOIN employee e ON jr.requested_by_employee = e.employee_id
        JOIN department d ON e.dept_id = d.dept_id
        WHERE jr.taken_by_employee = :eid 
        AND jr.status_id = 2 
        LIMIT 1";

$activeStmt = $pdo->prepare($activeJobSql);
$activeStmt->execute(['eid' => $currentUserId]);
$activeJob = $activeStmt->fetch();

/**
 * FETCH ALL NEW TICKETS (QUEUE)
 * Tickets that haven't been picked up by anyone yet.
 */
$sqlQueue = "SELECT 
            jr.j_ticket_id, 
            jr.description, 
            jr.request_type, 
            jr.created_at,
            e.first_name, 
            e.last_name, 
            e.profile_pic,
            d.dept_name,
            rs.status_name
        FROM job_request jr
        JOIN employee e ON jr.requested_by_employee = e.employee_id
        JOIN department d ON e.dept_id = d.dept_id
        JOIN request_status rs ON jr.status_id = rs.status_id
        WHERE jr.status_id = 1
        ORDER BY jr.created_at ASC";
        
$jobRequests = $pdo->query($sqlQueue)->fetchAll();

// Flag to prevent technician from taking more than one job at a time
$hasActiveTask = ($countPending > 0);