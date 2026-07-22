<?php
$host = 'localhost';
$dbname = 'db_project_system';
$username = 'root';
$password = '12345678';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    $_SESSION['db_error'] = $e->getMessage();
    exit('ไม่สามารถเชื่อมต่อฐานข้อมูลได้');
}
?>