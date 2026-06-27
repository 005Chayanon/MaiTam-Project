<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
    <style>
        .max {
            margin-top: 100px;
            margin-left: 100px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid: 12px;
        }

        .box {
            margin-bottom: 10px;
            padding: 10px;
            text-align: center;
            border: 1px solid #000000;
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .max {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="max">
        <div class="box" type="button" onclick="window.location.href='admin/home.php'">
            <img src="img/gg.png" alt="Admin Image" style="width: 50%; height: auto;">
            <p>Admin</p>
        </div>

        <div class="box" type="button" onclick="window.location.href='admin/home.php'">
            <img src="img/gg.png" alt="Admin Image" style="width: 50%; height: auto;">
            <p>Teacher</p>
        </div>

        <div class="box" type="button" onclick="window.location.href='admin/home.php'">
            <img src="img/gg.png" alt="Admin Image" style="width: 50%; height: auto;">
            <p>Student</p>
        </div>

        <div class="box" type="button" onclick="window.location.href='admin/home.php'">
            <img src="img/gg.png" alt="Admin Image" style="width: 50%; height: auto;">
            <p>Parent</p>
        </div>
    </div>
</body>
</html>