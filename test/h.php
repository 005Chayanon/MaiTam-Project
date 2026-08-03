<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบบันทึกและตรวจสอบโครงการ</title>

    <!-- ฟอนต์ภาษาไทย Kanit จาก Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome สำหรับไอคอนเมนูด้านข้าง -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Kanit', sans-serif;
        }

        body {
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ---------------- Top Header ---------------- */
        .header {
            background: linear-gradient(180deg, #6ec6f8 0%, #4db8f3 100%);
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-logo {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background-color: #ffffff;
            margin-right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .header-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .header-text h1 {
            font-size: 24px;
            font-weight: 500;
            line-height: 1.2;
        }

        .header-text p {
            font-size: 16px;
            font-weight: 300;
            opacity: 0.95;
        }

        /* ---------------- Main Layout ---------------- */
        .main-wrapper {
            display: flex;
            flex: 1;
        }

        /* ---------------- Sidebar ---------------- */
        .sidebar {
            width: 70px;
            background-color: #e4e4e4;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 25px 0;
            border-right: 1px solid #d1d1d1;
        }

        .sidebar-top {
            display: flex;
            flex-direction: column;
            gap: 25px;
            align-items: center;
        }

        .sidebar-icon {
            font-size: 24px;
            color: #888888;
            cursor: pointer;
            transition: color 0.2s;
        }

        .sidebar-icon:hover {
            color: #4db8f3;
        }

        /* ---------------- Content Area ---------------- */
        .content {
            flex: 1;
            padding: 40px 30px;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            width: 100%;
            max-width: 960px;
        }

        /* กรอบการ์ดชั้นนอก */
        .card-outer {
            background-color: #ffffff;
            border: 2px solid #d4d4d4;
            border-radius: 12px;
            padding: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
        }

        /* การ์ดด้านในสีฟ้า */
        .card-inner {
            background-color: #55b7ed;
            border-radius: 8px;
            padding: 18px 20px;
            color: white;
            height: 110px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .card-title {
            font-size: 20px;
            font-weight: 500;
        }

        .card-number {
            font-size: 38px;
            font-weight: 400;
            line-height: 0.9;
        }

        .card-subtext {
            font-size: 12px;
            font-weight: 300;
            opacity: 0.9;
        }

        /* ---------------- Footer ---------------- */
        .footer {
            background-color: #cccccc;
            padding: 10px 25px;
            color: #ffffff;
            font-size: 16px;
            font-weight: 400;
        }

        /* Responsive (รองรับหน้าจอขนาดเล็ก) */
        @media (max-width: 850px) {
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 550px) {
            .cards-grid {
                grid-template-columns: 1fr;
            }

            .main-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                flex-direction: row;
                padding: 10px 25px;
            }

            .sidebar-top {
                flex-direction: row;
            }
        }
    </style>
</head>

<body>

    <!-- แถบด้านบน (Header) -->
    <header class="header">
        <div class="header-logo">
            <!-- ใส่ URL โลโก้จริงตรง src ได้เลยครับ -->
            <i class="fa-solid fa-graduation-cap" style="font-size: 30px; color: #4db8f3;"></i>
        </div>
        <div class="header-text">
            <h1>ระบบบันทึกและตรวจสอบโครงการ</h1>
            <p>แผนกธุรกิจดิจิทัลและเทคโนโลยีสารสนเทศ</p>
        </div>
    </header>

    <!-- ส่วนเนื้อหาหลัก -->
    <div class="main-wrapper">
        <!-- เมนูด้านข้าง (Sidebar) -->
        <aside class="sidebar">
            <div class="sidebar-top">
                <i class="fa-solid fa-house sidebar-icon" title="หน้าแรก"></i>
                <i class="fa-solid fa-user sidebar-icon" title="ผู้ใช้งาน"></i>
            </div>
            <div class="sidebar-bottom">
                <i class="fa-solid fa-right-from-bracket sidebar-icon" title="ออกจากระบบ"></i>
            </div>
        </aside>

        <!-- พื้นที่แสดงการ์ด (Dashboard Grid) -->
        <main class="content">
            <div class="cards-grid">

                <!-- การ์ดที่ 1: คุณครู -->
                <div class="card-outer">
                    <div class="card-inner">
                        <div class="card-header">
                            <span class="card-title">คุณครู</span>
                            <span class="card-number">5</span>
                        </div>
                        <div class="card-subtext">คุณครูทั้งหมดในแผนก</div>
                    </div>
                </div>

                <!-- การ์ดที่ 2: กลุ่มนักเรียน -->
                <div class="card-outer">
                    <div class="card-inner">
                        <div class="card-header">
                            <span class="card-title">กลุ่มนักเรียน</span>
                            <span class="card-number">3</span>
                        </div>
                        <div class="card-subtext">กลุ่มนักเรียนทั้งหมดในแผนก</div>
                    </div>
                </div>

                <!-- การ์ดที่ 3: แอดมิน -->
                <div class="card-outer">
                    <div class="card-inner">
                        <div class="card-header">
                            <span class="card-title">แอดมิน</span>
                            <span class="card-number">1</span>
                        </div>
                        <div class="card-subtext">แอดมินทั้งหมด</div>
                    </div>
                </div>

                <!-- การ์ดที่ 4: สาขาวิชา -->
                <div class="card-outer">
                    <div class="card-inner">
                        <div class="card-header">
                            <span class="card-title">สาขาวิชา</span>
                            <span class="card-number">2</span>
                        </div>
                        <div class="card-subtext">สาขาวิชาทั้งหมดในแผนก</div>
                    </div>
                </div>

                <!-- การ์ดที่ 5: ห้องเรียน -->
                <div class="card-outer">
                    <div class="card-inner">
                        <div class="card-header">
                            <span class="card-title">ห้องเรียน</span>
                            <span class="card-number">4</span>
                        </div>
                        <div class="card-subtext">ห้องเรียนทั้งหมดในแผนก</div>
                    </div>
                </div>

                <!-- การ์ดที่ 6: หัวข้องาน -->
                <div class="card-outer">
                    <div class="card-inner">
                        <div class="card-header">
                            <span class="card-title">หัวข้องาน</span>
                            <span class="card-number">6</span>
                        </div>
                        <div class="card-subtext">หัวข้องานทั้งหมด</div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- ส่วนท้าย (Footer) -->
    <footer class="footer">
        about me
    </footer>

</body>

</html>