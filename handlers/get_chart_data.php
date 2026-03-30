  <?php
  require "../db.php";

  header('Content-Type: application/json');
    // Job Requests
    $job_query = "SELECT 
      COUNT(CASE WHEN status_id = 3 AND MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW()) THEN 1 END) AS m,
      COUNT(CASE WHEN status_id = 3 AND YEARWEEK(created_at, 1) = YEARWEEK(NOW(), 1) THEN 1 END) AS w,
      COUNT(CASE WHEN status_id = 3 AND DATE(created_at) = CURDATE() THEN 1 END) AS d
    FROM job_request";

    $job_stmt = $pdo->query($job_query);
    $job_data = $job_stmt ? $job_stmt->fetch(PDO::FETCH_ASSOC) : [];

    // Inventory Requests
    $inv_query = "SELECT
      COUNT(CASE WHEN status_id = 3 AND MONTH(updated_at) = MONTH(NOW()) AND YEAR(updated_at) = YEAR(NOW()) THEN 1 END) AS m,
      COUNT(CASE WHEN status_id = 3 AND YEARWEEK(updated_at, 1) = YEARWEEK(NOW(), 1) THEN 1 END) AS w,
      COUNT(CASE WHEN status_id = 3 AND DATE(updated_at) = CURDATE() THEN 1 END) AS d
    FROM inventory_request";

    $inv_stmt = $pdo->query($inv_query);
    $inv_data = $inv_stmt ? $inv_stmt->fetch(PDO::FETCH_ASSOC) : [];

    echo json_encode([
      'jobs' => [
      isset($job_data['m']) ? (int)$job_data['m'] : 0,
      isset($job_data['w']) ? (int)$job_data['w'] : 0,
      isset($job_data['d']) ? (int)$job_data['d'] : 0
    ],
    'inventory' => [
      isset($inv_data['m']) ? (int)$inv_data['m'] : 0,
      isset($inv_data['w']) ? (int)$inv_data['w'] : 0,
      isset($inv_data['d']) ? (int)$inv_data['d'] : 0
    ],
    ]);