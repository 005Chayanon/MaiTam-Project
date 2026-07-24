<?php
session_start();
include "../../config/db.php";

// admin login
if (isset($_POST['login-admin'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (isset($pdo)) {
        $stmt = $pdo->prepare("SELECT admin_id, full_name, username, password, status FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $rs = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($rs && $password === $rs['password']) {
            session_regenerate_id(true);

            $_SESSION['admin_id']  = $rs['admin_id'];
            $_SESSION['full_name'] = $rs['full_name'];
            $_SESSION['username']  = $rs['username'];
            $_SESSION['status']    = $rs['status'];

            header("Location: ../index.php");
            exit();
        }
    }

    $_SESSION['error'] = "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง";
    header("Location: ../../home.php");
    exit();
}
