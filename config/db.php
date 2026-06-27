<?php
$host = 'localhost';
$dbname = 'project_system';
$username = 'root';
$password = '12345678';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "เชื่อมต่อฐานข้อมูลสำเร็จแล้ว";

} catch(PDOException $e) {
    die("เชื่อมต่อไม่สำเร็จ: " . $e->getMessage());
}
?>