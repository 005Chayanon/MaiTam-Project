<?php
session_start();
include "../../config/db.php";

// ----------------------------------------------------------------------
// ADD NEW ADMIN
// ----------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-admin'])) {

    $full_name = trim($_POST['full_name'] ?? '');
    $username  = trim($_POST['username'] ?? '');
    $password  = $_POST['password'] ?? '';
    $status    = $_POST['status'] ?? '1';

    if (empty($full_name) || empty($username) || empty($password)) {
        $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบทุกช่อง";
        header("Location: ../index.php");
        exit();
    }

    if (isset($pdo)) {
        try {
            // ตรวจสอบ Username ซ้ำ (ปรับ admin_id ให้ตรงกับ DB ของคุณ)
            $stmt_check = $pdo->prepare("SELECT admin_id FROM admins WHERE username = ?");
            $stmt_check->execute([$username]);

            if ($stmt_check->fetch()) {
                $_SESSION['error'] = "Username นี้มีผู้ใช้งานในระบบแล้ว";
                header("Location: ../index.php");
                exit();
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO admins (full_name, username, password, status) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$full_name, $username, $hashed_password, $status]);

            $_SESSION['success'] = "เพิ่มผู้ดูแลระบบเรียบร้อยแล้ว";
            header("Location: ../index.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = "เกิดข้อผิดพลาดของระบบฐานข้อมูล";
            header("Location: ../index.php");
            exit();
        }
    }
}

// ----------------------------------------------------------------------
// ADD NEW TEACHER 
// ----------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-teacher'])) {

    $full_name = trim($_POST['full_name'] ?? '');
    $username  = trim($_POST['username'] ?? '');
    $password  = $_POST['password'] ?? '';
    $role      = $_POST['role'] ?? '';
    $status    = $_POST['status'] ?? '1';

    if (empty($full_name) || empty($username) || empty($password)) {
        $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบทุกช่อง";
        header("Location: ../index.php");
        exit();
    }

    if (isset($pdo)) {
        try {
            // ตรวจสอบ Username ซ้ำก่อน
            $stmt_check = $pdo->prepare("SELECT teacher_id FROM teachers WHERE username = ?");
            $stmt_check->execute([$username]);

            if ($stmt_check->fetch()) {
                $_SESSION['error'] = "Username นี้มีผู้ใช้งานในระบบแล้ว";
                header("Location: ../index.php");
                exit();
            }

            // เริ่มต้น Transaction เพื่อความปลอดภัย
            $pdo->beginTransaction();

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $image_name = 'default.png'; // ค่าเริ่มต้นกรณีไม่มีการส่งรูปภาพมา

            // 1. INSERT ข้อมูลขั้นแรกเพื่อเอา ID ของครูมาก่อน
            $sql = "INSERT INTO teachers (full_name, username, password, role, image, status) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$full_name, $username, $hashed_password, $role, $image_name, $status]);

            // ดึง ID ที่เพิ่มล่าสุดจาก Auto Increment
            $teacher_id = $pdo->lastInsertId();

            // 2. จัดการเรื่องรูปภาพ (ถ้ามีการส่งไฟล์มา)
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $file_tmp  = $_FILES['image']['tmp_name'];
                $file_name = $_FILES['image']['name'];
                $ext       = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                $allowed   = ['jpg', 'jpeg', 'png', 'webp'];

                if (in_array($ext, $allowed)) {
                    // ตั้งชื่อไฟล์เป็น teacher_ตามด้วยID เช่น teacher_15.jpg
                    $image_name  = 'teacher_' . $teacher_id . '.' . $ext;
                    $upload_path = "../../uploads/teachers/" . $image_name;

                    // ย้ายไฟล์ขึ้นเซิร์ฟเวอร์
                    if (move_uploaded_file($file_tmp, $upload_path)) {
                        // 3. อัปเดตชื่อรูปภาพจริงกลับลงฐานข้อมูล
                        $update_sql = "UPDATE teachers SET image = ? WHERE teacher_id = ?";
                        $update_stmt = $pdo->prepare($update_sql);
                        $update_stmt->execute([$image_name, $teacher_id]);
                    } else {
                        // ถ้าย้ายไฟล์ไม่สำเร็จ ให้ Rollback การเพิ่มข้อมูลใน DB ทั้งหมด
                        $pdo->rollBack();
                        $_SESSION['error'] = "ไม่สามารถย้ายไฟล์รูปภาพได้";
                        header("Location: ../index.php");
                        exit();
                    }
                } else {
                    $pdo->rollBack();
                    $_SESSION['error'] = "อนุญาตเฉพาะไฟล์รูปภาพ (JPG, PNG, WEBP) เท่านั้น";
                    header("Location: ../index.php");
                    exit();
                }
            }

            // ยืนยันการทำงานทั้งหมดลง Database
            $pdo->commit();

            $_SESSION['success'] = "เพิ่มครูเรียบร้อยแล้ว (ID: teacher_{$teacher_id})";
            header("Location: ../index.php");
            exit();
        } catch (PDOException $e) {
            // หากเกิด Error ใดๆ ในขั้นตอน ให้ยกเลิกข้อมูลที่เขียนไปก่อนหน้าทั้งหมด
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            $_SESSION['error'] = "เกิดข้อผิดพลาดของระบบฐานข้อมูล";
            header("Location: ../index.php");
            exit();
        }
    }
}

// ----------------------------------------------------------------------
// ADD NEW STUDENT
// ----------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-std'])) {

    $full_name = trim($_POST['full_name'] ?? '');
    $username  = trim($_POST['username'] ?? '');
    $password  = $_POST['password'] ?? '';
    $group_id  = $_POST['group_id'] ?? '';
    $status    = $_POST['status'] ?? '1';

    if (empty($full_name) || empty($username) || empty($password)) {
        $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบทุกช่อง";
        header("Location: ../index.php");
        exit();
    }

    if (isset($pdo)) {
        try {
            $stmt_check = $pdo->prepare("SELECT student_id FROM students WHERE username = ?");
            $stmt_check->execute([$username]);

            if ($stmt_check->fetch()) {
                $_SESSION['error'] = "Username นี้มีผู้ใช้งานในระบบแล้ว";
                header("Location: ../index.php");
                exit();
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO students (full_name, username, password, group_id, status) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$full_name, $username, $hashed_password, $group_id, $status]);

            $_SESSION['success'] = "เพิ่มนักเรียนเรียบร้อยแล้ว";
            header("Location: ../index.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = "เกิดข้อผิดพลาดของระบบฐานข้อมูล";
            header("Location: ../index.php");
            exit();
        }
    }
}
