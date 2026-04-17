<?php
require_once __DIR__ . "/../src/security.php";

$envConfig = require __DIR__ . "/../config/env.php";
Security::configureSession($envConfig['session']);
session_start();

// Already logged in - redirect
if (!empty($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit;
}

// Load DB (needed for login query)
require_once __DIR__ . "/../config/db.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF check
    $token = $_POST['csrf_token'] ?? '';
    if (!Security::validateCsrfToken($token)) {
        $error = "Invalid form submission. Please try again.";
    } elseif (Security::isLoginRateLimited()) {
        $error = "Too many login attempts. Please wait a few minutes.";
    } else {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            $error = "Email or password cannot be empty.";
        } else {
            $sql = "SELECT employee_id, first_name, last_name, middle_name, role_id, password_hash, mobile_num, `address`, status_id, profile_pic
                    FROM employee WHERE email = :email LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                if ((int)$user['status_id'] !== 1) {
                    $error = "Account is inactive.";
                    Security::recordLoginAttempt();
                } else {
                    // Successful login
                    Security::clearLoginAttempts();
                    session_regenerate_id(true);

                    $_SESSION['logged_in']   = bin2hex(random_bytes(32));
                    $_SESSION['employee_id'] = $user['employee_id'];
                    $_SESSION['first_name']  = $user['first_name'];
                    $_SESSION['middle_name'] = $user['middle_name'] ?? '';
                    $_SESSION['last_name']   = $user['last_name'];
                    $_SESSION['role_id']     = (int)$user['role_id'];
                    $_SESSION['email']       = $email;
                    $_SESSION['mobile_num']  = $user['mobile_num'];
                    $_SESSION['address']     = $user['address'];
                    $_SESSION['profile_pic'] = $user['profile_pic'];

                    $_SESSION['user_data'] = [
                        'employee_id' => $user['employee_id'],
                        'first_name'  => $user['first_name'],
                        'middle_name' => $user['middle_name'] ?? '',
                        'last_name'   => $user['last_name'],
                        'email'       => $email,
                        'mobile_num'  => $user['mobile_num'],
                        'address'     => $user['address']
                    ];

                    header("Location: index.php");
                    exit;
                }
            } else {
                Security::recordLoginAttempt();
                $error = "Invalid email or password.";
            }
        }
    }
}

// Generate CSRF token for the form
$csrfToken = Security::generateCsrfToken();
?>

<!doctype html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>I-SeRVE</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="css/adminlte.css" as="style" />
    <link
      rel="stylesheet"
      href="/css/index.css"
      media="print"
      onload="this.media='all'"
    />

    <link
      rel="stylesheet"
      href="/css/overlayscrollbars.min.css"
    />

    <link
      rel="stylesheet"
      href="/css/bootstrap-icons.min.css"
    />

    <link rel="stylesheet" href="css/adminlte.css" />
  </head>

  <body class="login-page bg-body-secondary "
  style=" background-image: url('/img/AdminLTELogo.png');
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-position: center;
          background-size: 40% 80%;">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <p class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
            <h1 class="mb-0"><b>I</b>-SeRVE</h1>
          </p>

        </div>
        <div class="card-body login-card-body">
          <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
              <?php echo  htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
              <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <form action="login.php" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo  htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="email" type="email" name="email" class="form-control" value="<?php echo  htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="" />
                <label for="email">Email</label>
              </div>
              <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            </div>
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="password" type="password" name="password" class="form-control" placeholder="" />
                <label for="password">Password</label>
              </div>
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>

            <div class="row">
              <div class="col-8 d-inline-flex align-items-center">
              </div>

              <div class="col-4">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
              </div>

            </div>

          </form>


        </div>
      </div>
    </div>
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>
