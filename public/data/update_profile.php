<?php
require_once __DIR__ . "/../../config/bootstrap.php";

header('Content-Type: application/json');

// 1. Basic Security
Security::requireAuth(); // Any logged-in user can update their own profile
Security::requirePost();
Security::requireCsrf();

// 2. Identification - Use the Session ID to prevent users from updating others
$employeeId = $_SESSION['employee_id'] ?? 0;
if (!$employeeId) {
    Security::jsonError('Unauthorized session.');
}

// 3. Inputs (Removed dept_id, role_id, and status_id for security)
$firstName  = trim($_POST['first_name'] ?? '');
$middleName = trim($_POST['middle_name'] ?? '');
$lastName   = trim($_POST['last_name'] ?? '');
$email      = trim($_POST['email'] ?? '');
$mobileNum  = trim($_POST['mobile_num'] ?? '');
$address    = trim($_POST['address'] ?? '');
$password   = $_POST['password'] ?? '';

// 4. Validation
if (empty($firstName) || empty($lastName) || empty($email)) {
    Security::jsonError('Required fields (Name and Email) are missing.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    Security::jsonError('Invalid email format.');
}

try {
    // Check if email is taken by someone else
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM employee WHERE email = :email AND employee_id != :id");
    $checkStmt->execute(['email' => $email, 'id' => $employeeId]);
    if ($checkStmt->fetchColumn() > 0) {
        Security::jsonError('This email is already taken by another account.');
    }

    // 5. Build the Dynamic SQL
    $sql = "UPDATE employee SET 
                first_name = :first_name, 
                middle_name = :middle_name, 
                last_name = :last_name, 
                email = :email, 
                mobile_num = :mobile_num, 
                address = :address";

    $params = [
        'first_name'  => $firstName,
        'middle_name' => $middleName ?: null,
        'last_name'   => $lastName,
        'email'       => $email,
        'mobile_num'  => $mobileNum,
        'address'     => $address,
        'id'          => $employeeId
    ];

    // 6. Profile Picture Logic (from your update_user.php)
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $uploadConfig = $envConfig['upload'];
        $validTmp = Security::validateUpload($_FILES['profile_pic'], $uploadConfig);
        if ($validTmp) {
            $uploadDir = __DIR__ . '/../../public/img/profile_pic/'; // Adjust path as needed
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($validTmp);
            $ext = ($mime === 'image/png') ? '.png' : (($mime === 'image/webp') ? '.webp' : '.jpg');

            $fileName = uniqid('profile_', true) . $ext;
            if (move_uploaded_file($validTmp, $uploadDir . $fileName)) {
                $profilePicPath = '/img/profile_pic/' . $fileName;
                $sql .= ", profile_pic = :profile_pic";
                $params['profile_pic'] = $profilePicPath;
                
                // Update session immediately
                $_SESSION['profile_pic'] = $profilePicPath;
            }
        }
    }

    // 7. Password Logic
    if (!empty($password)) {
        if (strlen($password) < 8) {
            Security::jsonError('New password must be at least 8 characters.');
        }
        // Append to the SQL string and the params array
        $sql .= ", password_hash = :password_hash";
        $params['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $sql .= " WHERE employee_id = :id";

    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        
        // 8. UPDATE SESSION DATA
        // Crucial: Update the session so the UI reflects changes without logging out
        $_SESSION['first_name'] = $firstName;
        $_SESSION['last_name']  = $lastName;
        $_SESSION['email']      = $email;
        $_SESSION['mobile_num'] = $mobileNum;
        $_SESSION['address']    = $address;
        
        // Also update the helper array if you're using it
        $_SESSION['user_data'] = array_merge($_SESSION['user_data'] ?? [], [
            'first_name' => $firstName,
            'last_name'  => $lastName,
            'email'      => $email,
            'mobile_num' => $mobileNum,
            'address'    => $address
        ]);

        echo json_encode(['success' => true, 'message' => 'Profile updated successfully!']);
    } else {
        Security::jsonError('Unable to save changes.');
    }

} catch (PDOException $e) {
    Security::jsonError('Database error.', 'Update Profile Error: ' . $e->getMessage());
}