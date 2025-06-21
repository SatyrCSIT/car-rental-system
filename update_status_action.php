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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'admin_menu.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">จัดการสถานะรถ</h2>
        <br>
        <?php
        include 'connect.php';

        if (isset($_GET['car_id']) && isset($_GET['action'])) {
            $car_id = $_GET['car_id'];
            $action = $_GET['action'];

            $new_status = '';
            if ($action === 'rent') {
                $new_status = 'รถไม่ว่างให้เช่า';
            } elseif ($action === 'return') {
                $new_status = 'รถว่างให้เช่า';
            }

            if (!empty($new_status)) {
                $sql = "UPDATE car SET car_availability = '$new_status' WHERE car_id = $car_id";
                $result = mysqli_query($connection, $sql);

                if ($result) {
                    header("Location: update_status.php");
                    exit();
                } else {
                    echo "เกิดข้อผิดพลาดในการอัพเดตสถานะ: " . mysqli_error($connection);
                }
            } else {
                echo "ค่า 'action' ไม่ถูกต้อง";
            }
        } else {
            echo "รหัสรถหรือค่า 'action' ไม่ถูกต้อง";
        }

        mysqli_close($connection);
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>