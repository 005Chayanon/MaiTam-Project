<?php
// รวมไฟล์เชื่อมต่อฐานข้อมูล (ปรับ path ให้ตรงกับโครงสร้างโฟลเดอร์ของคุณ)
require_once __DIR__ . "../config/db.php";

/**
 * ==============================================================================
 * GENERIC FUNCTIONS (ฟังก์ชันกลางสำหรับดึงข้อมูล)
 * ==============================================================================
 */

// ฟังก์ชันดึงข้อมูลแถวเดียว (Single Row)
function fetchRow($pdo, $sql, $params = [])
{
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}

// ฟังก์ชันดึงข้อมูลหลายแถว (Multiple Rows)
function fetchAllRows($pdo, $sql, $params = [])
{
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

/**
 * ==============================================================================
 * ADMINS (ผู้ดูแลระบบ)
 * ==============================================================================
 */

// ดึง Admin ทั้งหมด
function getAllAdmins($pdo)
{
    return fetchAllRows($pdo, "SELECT admin_id, username, full_name, status FROM admins ORDER BY admin_id DESC");
}

// ดึงข้อมูล Admin โดยอ้างอิงจาก admin_id
function getAdminById($pdo, $admin_id)
{
    return fetchRow($pdo, "SELECT admin_id, username, full_name, status FROM admins WHERE admin_id = ?", [$admin_id]);
}

/**
 * ==============================================================================
 * TEACHERS (ครู)
 * ==============================================================================
 */

// ดึงข้อมูลครูทั้งหมด
function getAllTeachers($pdo)
{
    return fetchAllRows($pdo, "SELECT teacher_id, username, full_name, image, role, status FROM teachers ORDER BY teacher_id DESC");
}

// ดึงข้อมูลครูตาม ID
function getTeacherById($pdo, $teacher_id)
{
    return fetchRow($pdo, "SELECT teacher_id, username, full_name, image, role, status FROM teachers WHERE teacher_id = ?", [$teacher_id]);
}

/**
 * ==============================================================================
 * STUDENTS (นักเรียน)
 * ==============================================================================
 */

// ดึงนักเรียนทั้งหมด พร้อมชื่อกลุ่มที่สังกัด
function getAllStudents($pdo)
{
    $sql = "SELECT s.student_id, s.username, s.full_name, s.group_id, s.status, g.group_name 
            FROM students s 
            LEFT JOIN groups g ON s.group_id = g.group_id 
            ORDER BY s.student_id DESC";
    return fetchAllRows($pdo, $sql);
}

// ดึงนักเรียนตาม student_id
function getStudentById($pdo, $student_id)
{
    $sql = "SELECT s.student_id, s.username, s.full_name, s.group_id, s.status, g.group_name 
            FROM students s 
            LEFT JOIN groups g ON s.group_id = g.group_id 
            WHERE s.student_id = ?";
    return fetchRow($pdo, $sql, [$student_id]);
}

/**
 * ==============================================================================
 * GROUPS (กลุ่มโครงงาน - ดึงข้อมูลแบบ JOIN ครบชุด)
 * ==============================================================================
 */

// ดึงข้อมูลกลุ่มทั้งหมด พร้อมชื่อครูที่ปรึกษา ห้องเรียน สาขา และปีการศึกษา
function getAllGroupsDetails($pdo)
{
    $sql = "SELECT g.group_id, g.group_name, g.project_name, g.status,
                   t.full_name AS teacher_name, 
                   c.class_name, 
                   b.branch_name, 
                   y.year_name
            FROM groups g
            LEFT JOIN teachers t ON g.teacher_id = t.teacher_id
            LEFT JOIN classrooms c ON g.class_id = c.class_id
            LEFT JOIN branches b ON c.branch_id = b.branch_id
            LEFT JOIN academic_years y ON c.year_id = y.year_id
            ORDER BY g.group_id DESC";
    return fetchAllRows($pdo, $sql);
}

// ดึงข้อมูลกลุ่ม 1 กลุ่ม ตาม group_id
function getGroupDetailsById($pdo, $group_id)
{
    $sql = "SELECT g.group_id, g.group_name, g.project_name, g.status, g.teacher_id, g.class_id,
                   t.full_name AS teacher_name, 
                   c.class_name, 
                   b.branch_name, 
                   y.year_name
            FROM groups g
            LEFT JOIN teachers t ON g.teacher_id = t.teacher_id
            LEFT JOIN classrooms c ON g.class_id = c.class_id
            LEFT JOIN branches b ON c.branch_id = b.branch_id
            LEFT JOIN academic_years y ON c.year_id = y.year_id
            WHERE g.group_id = ?";
    return fetchRow($pdo, $sql, [$group_id]);
}

// ดึงรายชื่อสมาชิกนักเรียนที่อยู่ในกลุ่มนั้นๆ
function getGroupMembersByGroupId($pdo, $group_id)
{
    $sql = "SELECT gm.member_id, s.student_id, s.full_name, s.username
            FROM group_members gm
            INNER JOIN students s ON gm.student_id = s.student_id
            WHERE gm.group_id = ?";
    return fetchAllRows($pdo, $sql, [$group_id]);
}

/**
 * ==============================================================================
 * ASSIGNMENTS & SUBMISSIONS (งานและการส่งงาน)
 * ==============================================================================
 */

// ดึงรายการสั่งงานทั้งหมด
function getAllAssignments($pdo)
{
    return fetchAllRows($pdo, "SELECT * FROM assignments ORDER BY assignment_id DESC");
}

// ดึงรายการการส่งงานของแต่ละกลุ่ม
function getSubmissionsByGroupId($pdo, $group_id)
{
    $sql = "SELECT sub.*, a.assignment_name, a.deadline_date, a.deadline_time
            FROM submissions sub
            INNER JOIN assignments a ON sub.assignment_id = a.assignment_id
            WHERE sub.group_id = ?
            ORDER BY sub.submission_id DESC";
    return fetchAllRows($pdo, $sql, [$group_id]);
}

/**
 * ==============================================================================
 * NOTIFICATIONS (การแจ้งเตือน)
 * ==============================================================================
 */

// ดึงการแจ้งเตือนของนักเรียนแต่ละคน
function getNotificationsByStudentId($pdo, $student_id, $unread_only = false)
{
    $sql = "SELECT * FROM notifications WHERE student_id = ?";
    if ($unread_only) {
        $sql .= " AND is_read = 0";
    }
    $sql .= " ORDER BY created_at DESC";
    return fetchAllRows($pdo, $sql, [$student_id]);
}

/**
 * ==============================================================================
 * MASTER DATA (ห้องเรียน, สาขา, ปีการศึกษา)
 * ==============================================================================
 */

// ดึงห้องเรียนทั้งหมด
function getAllClassrooms($pdo)
{
    $sql = "SELECT c.class_id, c.class_name, b.branch_name, y.year_name 
            FROM classrooms c
            LEFT JOIN branches b ON c.branch_id = b.branch_id
            LEFT JOIN academic_years y ON c.year_id = y.year_id";
    return fetchAllRows($pdo, $sql);
}

// ดึงสาขาวิชาที่เปิดใช้งาน (status = 0 คือเปิด ตาม comment ใน DB)
function getActiveBranches($pdo)
{
    return fetchAllRows($pdo, "SELECT * FROM branches WHERE status = 0 ORDER BY branch_name ASC");
}

// ดึงปีการศึกษาที่เปิดใช้งาน (status = 1 คือเปิด)
function getActiveAcademicYears($pdo)
{
    return fetchAllRows($pdo, "SELECT * FROM academic_years WHERE status = 1 ORDER BY year_name DESC");
}
