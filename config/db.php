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

    // ส่งข้อความไปแจ้งใน Console ของเบราว์เซอร์ (สีปกติ)
    echo "<script>console.log('เชื่อมต่อฐานข้อมูลสำเร็จแล้ว');</script>";

} catch(PDOException $e) {
    // ดึงข้อความ Error มาเก็บไว้ในตัวแปร
    $errorMessage = $e->getMessage();
    
    // ใช้ addslashes() เพื่อป้องกันปัญหาเครื่องหมาย ' หรือ " ในข้อความ Error ทำให้ JavaScript พัง
    // และใช้ console.error() เพื่อให้แสดงเป็นข้อความสีแดงใน Console
    echo "<script>console.error('เชื่อมต่อไม่สำเร็จ: " . addslashes($errorMessage) . "');</script>";
    
    // หยุดการทำงานของสคริปต์
    exit();
}
?>