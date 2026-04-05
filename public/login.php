<?php
session_start();
require "../db.php";

$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = "Email or password cannot be empty";
    } else {
        $sql = "SELECT employee_id, first_name, last_name, middle_name, role_id, password_hash, status_id, profile_pic
                FROM employee WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            if ($user['status_id'] != 1) {
                $error = "Account is inactive";
            } else {
                session_regenerate_id(true);
                $_SESSION['logged_in']   = true;
                $_SESSION['employee_id'] = $user['employee_id'];
                $_SESSION['first_name']  = $user['first_name'];
                $_SESSION['middle_name'] = $user['middle_name'] ?? '';
                $_SESSION['last_name']   = $user['last_name'];
                $_SESSION['role_id']     = (int)$user['role_id'];
                $_SESSION['email']       = $email;
                $_SESSION['profile_pic'] = $user['profile_pic'];

                // Redirect before sending any output
                header("Location: index.php");
                exit;
            }
        } else {
            $error = "Invalid email or password";
           
        }
        echo $error;
    }
}

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
      href="../public/css/index.css"
      media="print"
      onload="this.media='all'"
    />
    
    <link
      rel="stylesheet"
      href="../public/css/overlayscrollbars.min.css"
    />
    
    <link
      rel="stylesheet"
      href="../public/css/bootstrap-icons.min.css"
    />
    
    <link rel="stylesheet" href="css/adminlte.css" />
  </head>
  
  <body class="login-page bg-body-secondary">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <p class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
            <h1 class="mb-0"><b>I</b>-SeRVE</h1>
          </p>
          
        </div>
        <div class="card-body login-card-body">
          
          <form action="login.php" method="post">
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="email" type="email" name="email" class="form-control" value="" placeholder="" />
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
                <!-- <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  <label class="form-check-label" for="flexCheckDefault"> Remember Me </label>
                </div> -->
              </div>
              
              <div class="col-4">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
              </div>
              
            </div>
            
          </form>
          
          <!-- <p class="mb-1"><a href="forgot-password.html">I forgot my password</a></p> -->
         
        </div>
      </div>
    </div>
    
  </body>
</html>