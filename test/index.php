<?php
include_once '../config/db.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="nav.css" />
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>
    <header class="custom-header">
        <div class="d-flex align-items-center gap-3">
            <img src="../img/new_logo_svc_temp.png" alt="โลโก้" class="header-logo" onerror="this.src='https://placehold.co/70x70/8a1c14/white?text=LOGO'">
            <div>
                <h1 class="h4 mb-0 fw-bold">ระบบบันทึกและตรวจสอบโครงการ</h1>
                <p class="mb-0">แผนกธุรกิจดิจิทัลและเทคโนโลยีสารสนเทศ</p>
            </div>
        </div>
    </header>

    <div class="app-layout">
        <nav>
            <aside class="sidebar collapsed" id="sidebar">
                <div class="sidebar-inner">
                    <header class="sidebar-header">
                        <button type="button" class="collapse-btn" id="collapseBtn">
                            <i data-lucide="panel-left"></i>
                        </button>
                    </header>

                    <div class="search">
                        <i data-lucide="search"></i>
                        <input type="text" placeholder="Search" />
                        <span class="kbd"></span>
                    </div>

                    <ul class="nav">
                        <li>
                            <button type="button" class="active">
                                <i data-lucide="house"></i>
                                <span>Dashboard</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" id="projectsBtn">
                                <i data-lucide="file-text"></i>
                                <span>Projects</span>
                            </button>
                        </li>
                        <!-- more items -->
                    </ul>

                    <hr class="divider" />

                    <div class="logout-box">
                        <button type="button" class="logout-btn" id="logoutBtn">
                            <i data-lucide="log-out"></i>
                            <span>ออกจากระบบ</span>
                        </button>
                    </div>
                </div>
            </aside>
        </nav>

        <main class="main-content">
            <div class="content">
                <div class="row">
                    <div class="card">
                        <div class="top-line">
                            <span class="label">คุณครู</span>
                            <span class="count">5</span>
                        </div>
                        <div class="sub">คุณครูทั้งหมดในแผนก</div>
                    </div>
                    <div class="card">
                        <div class="top-line">
                            <span class="label">กลุ่มนักเรียน</span>
                            <span class="count">3</span>
                        </div>
                        <div class="sub">กลุ่มนักเรียนทั้งหมดในแผนก</div>
                    </div>
                    <div class="card">
                        <div class="top-line">
                            <span class="label">แอดมิน</span>
                            <span class="count">1</span>
                        </div>
                        <div class="sub">แอดมินทั้งหมด</div>
                    </div>
                </div>

                <div class="row">
                    <div class="card">
                        <div class="top-line">
                            <span class="label">สาขาวิชา</span>
                            <span class="count">2</span>
                        </div>
                        <div class="sub">สาขาวิชาทั้งหมดในแผนก</div>
                    </div>
                    <div class="card">
                        <div class="top-line">
                            <span class="label">ห้องเรียน</span>
                            <span class="count">4</span>
                        </div>
                        <div class="sub">ห้องเรียนทั้งหมดในแผนก</div>
                    </div>
                    <div class="card">
                        <div class="top-line">
                            <span class="label">หัวข้องาน</span>
                            <span class="count">6</span>
                        </div>
                        <div class="sub">หัวข้องานทั้งหมด</div>
                    </div>
                </div>

                <div class="full-row">
                    <div class="full-card">
                        <span>ปีการศึกษา</span>
                        <span class="count">2</span>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="nav.js"></script>
</body>

</html>