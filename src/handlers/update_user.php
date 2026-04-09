<?php
require_once __DIR__ . "/../../db.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$employeeId = (int)($_POST['employee_id'] ?? 0);
if ($employeeId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid User ID.']);
    exit;
}

$firstName  = trim($_POST['first_name'] ?? '');
$middleName = trim($_POST['middle_name'] ?? '');
$lastName   = trim($_POST['last_name'] ?? '');
$email      = trim($_POST['email'] ?? '');
$mobileNum  = trim($_POST['mobile_num'] ?? '');
$address    = trim($_POST['address'] ?? '');
$deptId     = (int)($_POST['dept_id'] ?? 0);
$roleId     = (int)($_POST['role_id'] ?? 0);
$statusId   = (int)($_POST['status_id'] ?? 0);
$password   = $_POST['password'] ?? '';

if (empty($firstName) || empty($lastName) || empty($email) || empty($deptId) || empty($roleId) || empty($statusId)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
    exit;
}

try {
    // Check if email already exists for another user
    $checkSql = "SELECT COUNT(*) FROM employee WHERE email = :email AND employee_id != :id";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute(['email' => $email, 'id' => $employeeId]);
    if ($checkStmt->fetchColumn() > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already registered.']);
        exit;
    }

    $sql = "UPDATE employee SET 
                first_name = :first_name, 
                middle_name = :middle_name, 
                last_name = :last_name, 
                email = :email, 
                mobile_num = :mobile_num, 
                address = :address, 
                dept_id = :dept_id, 
                role_id = :role_id, 
                status_id = :status_id";
    
    $params = [
        'first_name'    => $firstName,
        'middle_name'   => $middleName ?: null,
        'last_name'     => $lastName,
        'email'         => $email,
        'mobile_num'    => $mobileNum,
        'address'       => $address,
        'dept_id'       => $deptId,
        'role_id'       => $roleId,
        'status_id'     => $statusId,
        'id'            => $employeeId
    ];

    if (!empty($password)) {
        $sql .= ", password_hash = :password_hash";
        $params['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $sql .= " WHERE employee_id = :id";
    
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute($params);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'User updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update user.']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
