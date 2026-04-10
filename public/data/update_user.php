<?php
require_once __DIR__ . "/../../config/bootstrap.php";

header('Content-Type: application/json');

Security::requireAuth();
Security::requireRole([1]); // Admin only
Security::requirePost();
Security::requireCsrf();

$employeeId = (int)($_POST['employee_id'] ?? 0);
if ($employeeId <= 0) {
    Security::jsonError('Invalid User ID.');
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
    Security::jsonError('Please fill in all required fields.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    Security::jsonError('Invalid email format.');
}

try {
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM employee WHERE email = :email AND employee_id != :id");
    $checkStmt->execute(['email' => $email, 'id' => $employeeId]);
    if ($checkStmt->fetchColumn() > 0) {
        Security::jsonError('Email already registered.');
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

    // Handle profile picture upload
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $uploadConfig = $envConfig['upload'];
        $validTmp = Security::validateUpload($_FILES['profile_pic'], $uploadConfig);
        if ($validTmp) {
            $uploadDir = __DIR__ . '/../img/profile_pic/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $ext = '.jpg';
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($validTmp);
            if ($mime === 'image/png') $ext = '.png';
            elseif ($mime === 'image/gif') $ext = '.gif';
            elseif ($mime === 'image/webp') $ext = '.webp';

            $fileName = uniqid('profile_', true) . $ext;
            if (move_uploaded_file($validTmp, $uploadDir . $fileName)) {
                $sql .= ", profile_pic = :profile_pic";
                $params['profile_pic'] = '/img/profile_pic/' . $fileName;
            }
        }
    }

    if (!empty($password)) {
        if (strlen($password) < 8) {
            Security::jsonError('Password must be at least 8 characters.');
        }
        $sql .= ", password_hash = :password_hash";
        $params['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $sql .= " WHERE employee_id = :id";

    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute($params);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'User updated successfully.']);
    } else {
        Security::jsonError('Failed to update user.');
    }

} catch (PDOException $e) {
    Security::jsonError('A database error occurred.', 'Update User Error: ' . $e->getMessage());
}
