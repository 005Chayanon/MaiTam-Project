-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 17, 2026 at 02:57 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `year_id` int(11) NOT NULL COMMENT 'รหัสปีการศึกษา',
  `year_name` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ปีการศึกษา เช่น 2568',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'เปิด/ปิดการใช้งานปีการศึกษา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL COMMENT 'รหัสประจำตัวผู้ดูแลระบบ',
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อผู้ใช้สำหรับเข้าสู่ระบบ',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสผ่าน',
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อ-นามสกุลผู้ดูแล',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะการใช้งาน (1=เปิด,0=ปิด)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `full_name`, `status`) VALUES
(0, 'admin', 'admin', 'MaxMKK', 1);

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `assignment_id` int(11) NOT NULL COMMENT 'รหัสงาน',
  `assignment_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่องาน เช่น บทที่ 1',
  `deadline_date` date NOT NULL COMMENT 'วันที่กำหนดส่ง',
  `deadline_time` time NOT NULL COMMENT 'เวลากำหนดส่ง',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'เปิด/ปิดการส่งงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL COMMENT 'รหัสสาขา',
  `branch_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อสาขาวิชา',
  `status` tinyint(1) NOT NULL COMMENT '0=เปิด 1=ปิด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `class_id` int(11) NOT NULL COMMENT 'รหัสห้อง',
  `class_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อห้อง เช่น ปวช.3/1',
  `branch_id` int(11) NOT NULL COMMENT 'อ้างอิงสาขา',
  `year_id` int(11) NOT NULL COMMENT 'อ้างอิงปีการศึกษา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL COMMENT 'รหัสกลุ่ม',
  `group_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อกลุ่ม',
  `project_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อโครงงาน',
  `teacher_id` int(11) NOT NULL COMMENT 'ครูที่ปรึกษา',
  `class_id` int(11) NOT NULL COMMENT 'ห้องเรียนของกลุ่ม',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะกลุ่ม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `member_id` int(11) NOT NULL COMMENT 'รหัสสมาชิก',
  `group_id` int(11) NOT NULL COMMENT 'กลุ่มที่สังกัด',
  `student_id` int(11) NOT NULL COMMENT 'นักเรียนในกลุ่ม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL COMMENT 'รหัสการแจ้งเตือน',
  `student_id` int(11) NOT NULL COMMENT 'นักเรียนผู้รับการแจ้งเตือน',
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'หัวข้อการแจ้งเตือน',
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รายละเอียดการแจ้งเตือน',
  `is_read` tinyint(1) NOT NULL COMMENT 'สถานะการอ่าน (0=ยังไม่อ่าน,1=อ่านแล้ว)',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่และเวลาที่สร้างการแจ้งเตือน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL COMMENT 'รหัสนักเรียน',
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อผู้ใช้',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสผ่าน',
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อ-นามสกุล',
  `group_id` int(11) NOT NULL COMMENT 'กลุ่มที่นักเรียนสังกัด',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะการใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `username`, `password`, `full_name`, `group_id`, `status`) VALUES
(0, 'std', '$2y$10$LgHBq/k8qXKOYWO6wt7lOOndTSUgk00slyqhwG1ofKx8OFBDn2V32', 'std', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `submission_id` int(11) NOT NULL COMMENT 'รหัสการส่งงาน',
  `group_id` int(11) NOT NULL COMMENT 'กลุ่มผู้ส่ง',
  `assignment_id` int(11) NOT NULL COMMENT 'งานที่ส่ง',
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อไฟล์ที่อัปโหลด',
  `submit_date` datetime NOT NULL COMMENT 'วันและเวลาที่ส่ง',
  `status` tinyint(4) NOT NULL COMMENT 'สถานะการตรวจงาน',
  `teacher_comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ความคิดเห็นจากครู'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL COMMENT 'รหัสครู',
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อผู้ใช้',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสผ่าน',
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อ-นามสกุลครู',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รูปโปรไฟล์',
  `role` tinyint(1) NOT NULL COMMENT 'ตำแหน่งของครู 0=หน้าแผนก 1=ครูผู้สอน',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะการใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `username`, `password`, `full_name`, `image`, `role`, `status`) VALUES
(0, 'teachr', '$2y$10$y6AXawrAC9lEUb9GL1qsCOaA7i04x81K8KTuuPTPMwOAyuYiftUj6', 'teachr', '', 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
