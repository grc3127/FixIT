<?php
  // 1. Database Connection
  $total_query = "SELECT 
    (SELECT COUNT(*) FROM job_request WHERE status_id = :sid) AS job_count,
    (SELECT COUNT(*) FROM inventory_request WHERE status_id = :sid) AS inv_count";

  $stmt = $pdo->prepare($total_query);
  $stmt->execute(['sid' => 3]);
  $total_query_data = $stmt->fetch();
  $request_overtime = $total_query_data['job_count'] + $total_query_data['inv_count'];
  $APP->set('request_overtime', $request_overtime);