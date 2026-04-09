<?php
ob_clean();
require_once __DIR__ . "/../../db.php"; 

header('Content-Type: application/json');

$finishedStatus = 5;//based on request_status table

  // Job Requests
  $job_query = "SELECT 
    COUNT(CASE WHEN status_id = $finishedStatus AND MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW()) THEN 1 END) AS m,
    COUNT(CASE WHEN status_id = $finishedStatus AND YEARWEEK(created_at, 1) = YEARWEEK(NOW(), 1) THEN 1 END) AS w,
    COUNT(CASE WHEN status_id = $finishedStatus AND DATE(created_at) = CURDATE() THEN 1 END) AS d
  FROM job_request";

  $job_stmt = $pdo->query($job_query);
  $job_data = $job_stmt ? $job_stmt->fetch(PDO::FETCH_ASSOC) : [];

  // Inventory Requests
  $inv_query = "SELECT
    COUNT(CASE WHEN status_id = $finishedStatus AND MONTH(updated_at) = MONTH(NOW()) AND YEAR(updated_at) = YEAR(NOW()) THEN 1 END) AS m,
    COUNT(CASE WHEN status_id = $finishedStatus AND YEARWEEK(updated_at, 1) = YEARWEEK(NOW(), 1) THEN 1 END) AS w,
    COUNT(CASE WHEN status_id = $finishedStatus AND DATE(updated_at) = CURDATE() THEN 1 END) AS d
  FROM inventory_request";

  $inv_stmt = $pdo->query($inv_query);
  $inv_data = $inv_stmt ? $inv_stmt->fetch(PDO::FETCH_ASSOC) : [];

  echo json_encode([
      'jobs' => [
          (int)($job_data['m'] ?? 0),
          (int)($job_data['w'] ?? 0),
          (int)($job_data['d'] ?? 0)
      ],
      'inventory' => [
          (int)($inv_data['m'] ?? 0),
          (int)($inv_data['w'] ?? 0),
          (int)($inv_data['d'] ?? 0)
      ],
  ]);
  exit;