<?php
session_start();
if (!isset($_SESSION['Username']) || $_SESSION['UserRole'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'connect.php';

if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];

    $checkRentSql = "SELECT * FROM rentedcars WHERE car_id = $car_id";
    $rentResult = mysqli_query($connection, $checkRentSql);

    if (mysqli_num_rows($rentResult) > 0) {
        echo "ไม่สามารถลบรถที่มีการเช่าอยู่";
    } else {
        $deleteCarSql = "DELETE FROM car WHERE car_id = $car_id";
        if (mysqli_query($connection, $deleteCarSql)) {
            header("Location: select_car.php");
            exit();
        } else {
            echo "เกิดข้อผิดพลาดในการลบรถ: " . mysqli_error($connection);
        }
    }
} else {
    echo "ไม่พบรหัสรถที่ต้องการลบ";
}
?>