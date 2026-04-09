<?php
$host = "localhost";
$dbname = "try";
$user = "root";
$pass = "";
$port = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=UTF8",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("DB Connection Failed");
}

require(__DIR__ . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "helper.php");

$APP = new AppHelper($pdo);