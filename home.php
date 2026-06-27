<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบบันทึกและตรวจสอบโครงการ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Sarabun', 'myFirstFont', sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* ตกแต่งเส้นใต้ข้อความยินดีต้อนรับให้เหมือนต้นฉบับ */
        .welcome-title {
            display: inline-block;
            border-bottom: 2px solid #333333;
            padding-bottom: 6px;
            color: #000000;
        }

        /* สไตล์การ์ดเมนู */
        .menu-card {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            text-decoration: none;
            color: #333333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            height: 220px; /* เพิ่มความสูงเล็กน้อยเพื่อไม่ให้ภาพติดขอบ */
        }

        .menu-card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-5px);
            color: #000000;
        }

        .menu-card img {
            max-height: 110px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        /* ตกแต่งส่วนท้าย (Footer) */
        footer {
            background-color: #c2c2c2;
            color: #ffffff;
            padding: 12px 24px;
        }
    </style>
</head>

<body>

    <header class="bg-white border-bottom shadow-sm px-4 py-3">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold" style="width: 60px; height: 60px; font-size: 11px; background-color: #8a1c14 !important;">
                LOGO
            </div>
            <div>
                <h1 class="h4 mb-0 fw-bold text-dark">ระบบบันทึกและตรวจสอบโครงการ</h1>
                <p class="mb-0 text-muted small">แผนกธุรกิจดิจิทัลและเทคโนโลยีสารสนเทศ</p>
            </div>
        </div>
    </header>

    <main class="main-content container py-5">
        <div class="text-center mb-5">
            <h2 class="mb-2">
                <span class="welcome-title">ยินดีต้อนรับเข้าสู่</span>
            </h2>
            <h3 class="mt-3" style="color: #00a2e8 !important;">ระบบบันทึกและตรวจสอบโครงการ</h3>
        </div>

        <div class="row g-4 justify-content-center" style="max-width: 850px; width: 100%;">

            <div class="col-10 col-sm-6">
                <a href="admin/home.php" class="menu-card">
                    <img src="img/home/1.png" alt="ผู้ดูแล">
                    <span class="fs-5 fw-medium">ผู้ดูแล</span>
                </a>
            </div>

            <div class="col-10 col-sm-6">
                <a href="#" class="menu-card">
                    <img src="img/home/2.png" alt="คุณครู">
                    <span class="fs-5 fw-medium">คุณครู</span>
                </a>
            </div>

            <div class="col-10 col-sm-6">
                <a href="#" class="menu-card">
                    <img src="img/home/3.png" alt="นักเรียน/นักศึกษา">
                    <span class="fs-5 fw-medium">นักเรียน/นักศึกษา</span>
                </a>
            </div>

            <div class="col-10 col-sm-6">
                <a href="#" class="menu-card">
                    <img src="img/home/4.png" alt="ผู้เยี่ยมชม">
                    <span class="fs-5 fw-medium">ผู้เยี่ยมชม</span>
                </a>
            </div>

        </div>
    </main>

    <footer>
        <div class="container-fluid p-0">
            <span>about me</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>