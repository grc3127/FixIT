<?php
require_once __DIR__ . "/../../config/bootstrap.php";

header('Content-Type: application/json');

Security::requireAuth();
Security::requireRole([1]); // Admin only

$finishedStatus = 5;

try {
    $job_query = "SELECT
        COUNT(CASE WHEN status_id = :s1 AND MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW()) THEN 1 END) AS m,
        COUNT(CASE WHEN status_id = :s2 AND YEARWEEK(created_at, 1) = YEARWEEK(NOW(), 1) THEN 1 END) AS w,
        COUNT(CASE WHEN status_id = :s3 AND DATE(created_at) = CURDATE() THEN 1 END) AS d
      FROM job_request";

    $job_stmt = $pdo->prepare($job_query);
    $job_stmt->execute(['s1' => $finishedStatus, 's2' => $finishedStatus, 's3' => $finishedStatus]);
    $job_data = $job_stmt->fetch();

    $inv_query = "SELECT
        COUNT(CASE WHEN status_id = :s1 AND MONTH(updated_at) = MONTH(NOW()) AND YEAR(updated_at) = YEAR(NOW()) THEN 1 END) AS m,
        COUNT(CASE WHEN status_id = :s2 AND YEARWEEK(updated_at, 1) = YEARWEEK(NOW(), 1) THEN 1 END) AS w,
        COUNT(CASE WHEN status_id = :s3 AND DATE(updated_at) = CURDATE() THEN 1 END) AS d
      FROM inventory_request";

    $inv_stmt = $pdo->prepare($inv_query);
    $inv_stmt->execute(['s1' => $finishedStatus, 's2' => $finishedStatus, 's3' => $finishedStatus]);
    $inv_data = $inv_stmt->fetch();

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
} catch (PDOException $e) {
    Security::jsonError('Failed to load chart data.', 'Chart Data Error: ' . $e->getMessage());
}
