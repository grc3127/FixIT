<?php
require_once __DIR__ . "/../../db.php"; 

try {
    // Select employee details based on your schema
    $sql = "SELECT 
                employee_id, 
                first_name, 
                last_name, 
                email, 
                role_id, 
                profile_pic 
            FROM employee 
            ORDER BY last_name ASC";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $allEmployees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Initialize the grouped array based on your role_id logic
    $groupedUsers = [
        1 => [], // Administration
        2 => [], // Technical
        3 => []  // Employee
    ];

    foreach ($allEmployees as $user) {
        $roleId = $user['role_id'];
        if (isset($groupedUsers[$roleId])) {
            $groupedUsers[$roleId][] = $user;
        }
    }

    // Fetch Departments
    $deptStmt = $pdo->query("SELECT dept_id, dept_name FROM department ORDER BY dept_name ASC");
    $departments = $deptStmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch Statuses
    $statusStmt = $pdo->query("SELECT status_id, status_name FROM account_status ORDER BY status_name ASC");
    $statuses = $statusStmt->fetchAll(PDO::FETCH_ASSOC);

    // Roles (Hardcoded for now as they are not in a separate table in schema.sql but used in user_mgmt.php)
    $roles = [
        1 => 'Administration',
        2 => 'Technical',
        3 => 'Employee'
    ];

} catch (PDOException $e) {
    error_log("User Management Data Error: " . $e->getMessage());
    $groupedUsers = [1 => [], 2 => [], 3 => []];
    $departments = [];
    $statuses = [];
    $roles = [1 => 'Administration', 2 => 'Technical', 3 => 'Employee'];
}

?>