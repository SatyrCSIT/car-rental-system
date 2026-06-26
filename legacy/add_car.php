<?php
session_start();
if (!isset($_SESSION['UserRole']) || $_SESSION['UserRole'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_name = $_POST['car_name'];
    $car_nameplate = $_POST['car_nameplate'];
    $ac_price = $_POST['ac_price'];
    $ac_price_per_day = $_POST['ac_price_per_day'];
    $non_ac_price_per_day = $_POST['non_ac_price_per_day'];
    $car_availability = 'รออัพเดทสถานะ';

    if (isset($_POST['car_type'])) {
        $car_type = $_POST['car_type'];

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["car_img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["car_img"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if ($_FILES["car_img"]["size"] > 500000) {
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["car_img"]["tmp_name"], $target_file)) {
                include 'Connect.php';

                $sql = "INSERT INTO car (car_name, car_nameplate, car_img, ac_price, ac_price_per_day, non_ac_price_per_day, car_availability, type_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($connection, $sql);
                mysqli_stmt_bind_param($stmt, 'sssssssi', $car_name, $car_nameplate, $target_file, $ac_price, $ac_price_per_day, $non_ac_price_per_day, $car_availability, $car_type);

                if (mysqli_stmt_execute($stmt)) {
                    header("Location: car_admin.php");
                    exit();
                } else {
                    echo 'Error: ' . mysqli_error($connection);
                }
                mysqli_close($connection);
            } else {
                echo 'Error: ไม่สามารถอัปโหลดไฟล์รูปภาพ';
            }
        } else {
            echo 'Error: อัปโหลดไฟล์รูปภาพไม่สำเร็จ';
        }
    } else {
        echo 'Error: ไม่ได้ระบุประเภทรถ (car_type)';
    }
}

?>