<?php
$host = "localhost";
$dbname = "2ndsem";
$user = "root";
$pass = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=UTF8",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} 
catch (PDOException $e) {
    die("DB Connection Failed");
}

