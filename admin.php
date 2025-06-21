<?php
session_start();
if (!isset($_SESSION['Username']) || $_SESSION['UserRole'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - เช่ายานพาหนะ</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'admin_menu.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Admin System</h2>
        <br>
        <div class="list-group">
            <a href="entercar.php" class="list-group-item list-group-item-action">เพิ่มรถ</a>
            <a href="select_car.php" class="list-group-item list-group-item-action">แก้ไขข้อมูลรถ</a>
            <a href="view_bookings.php" class="list-group-item list-group-item-action">ดูการจองรถ</a>
            <a href="manage_users.php" class="list-group-item list-group-item-action">จัดการผู้ใช้</a>
            <a href="update_status.php" class="list-group-item list-group-item-action">จัดการสถานะรถ</a>
            <a href="show_feedback.php" class="list-group-item list-group-item-action">ดูข้อมูล Feed Back</a>
            <a href="car_admin.php" class="list-group-item list-group-item-action">ข้อมูลรถทั้งหมด</a>
            <a href="Logout.php"
                class="list-group-item list-group-item-action d-flex justify-content-center align-items-center">ออกจากระบบ</a>
        </div>
    </div>

    <!-- JavaScript - Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>