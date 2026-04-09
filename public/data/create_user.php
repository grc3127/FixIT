<?php
require_once __DIR__ . "/../../config/db.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// Basic input validation
$firstName  = trim($_POST['first_name'] ?? '');
$middleName = trim($_POST['middle_name'] ?? '');
$lastName   = trim($_POST['last_name'] ?? '');
$email      = trim($_POST['email'] ?? '');
$mobileNum  = trim($_POST['mobile_num'] ?? '');
$address    = trim($_POST['address'] ?? '');
$deptId     = (int)($_POST['dept_id'] ?? 0);
$roleId     = (int)($_POST['role_id'] ?? 0);
$statusId   = (int)($_POST['status_id'] ?? 1);
$password   = $_POST['password'] ?? '';

if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($deptId) || empty($roleId)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
    exit;
}

try {
    // Check if email already exists
    $checkSql = "SELECT COUNT(*) FROM employee WHERE email = :email";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute(['email' => $email]);
    if ($checkStmt->fetchColumn() > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already registered.']);
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    // Handle profile picture upload
    $profilePic = '/img/profile_pic/default.png';
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../public/img/profile_pic/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = uniqid('profile_') . '.jpg';
        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadDir . $fileName)) {
            $profilePic = '/img/profile_pic/' . $fileName;
        }
    }

    $sql = "INSERT INTO employee (
                first_name, middle_name, last_name, email, mobile_num, 
                address, dept_id, role_id, status_id, password_hash, profile_pic
            ) VALUES (
                :first_name, :middle_name, :last_name, :email, :mobile_num, 
                :address, :dept_id, :role_id, :status_id, :password_hash, :profile_pic
            )";
    
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([
        'first_name'    => $firstName,
        'middle_name'   => $middleName ?: null,
        'last_name'     => $lastName,
        'email'         => $email,
        'mobile_num'    => $mobileNum,
        'address'       => $address,
        'dept_id'       => $deptId,
        'role_id'       => $roleId,
        'status_id'     => $statusId,
        'password_hash' => $passwordHash,
        'profile_pic'   => $profilePic
    ]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'User created successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create user.']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
