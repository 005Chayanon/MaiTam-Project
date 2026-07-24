<?php
session_start();
include "../../config/db.php";

// std login
if (isset($_POST['login-std'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (isset($pdo)) {
        $stmt = $pdo->prepare("SELECT student_id, full_name, username, group_id, password, status FROM students WHERE username = ?");
        $stmt->execute([$username]);
        $rs = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($rs && $password === $rs['password']) {
            session_regenerate_id(true);

            $_SESSION['student_id']  = $rs['student_id'];
            $_SESSION['full_name'] = $rs['full_name'];
            $_SESSION['username']  = $rs['username'];
            $_SESSION['group_id'] = $rs['group_id'];
            $_SESSION['status']    = $rs['status'];

            header("Location: ../index.php");
            exit();
        }
    }

    $_SESSION['error'] = "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง";
    header("Location: ../../home.php");
    exit();
}
?>