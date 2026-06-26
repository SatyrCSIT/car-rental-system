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

        $sql = "SELECT car_id, car_name, car_nameplate, car_availability FROM car";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered">';
            echo '<thead class="bg-success text-white">';
            echo '<tr>';
            echo '<th>รหัสรถ</th>';
            echo '<th>ยี่ห้อรถ</th>';
            echo '<th>ป้ายทะเบียนรถ</th>';
            echo '<th>สถานะ</th>';
            echo '<th>อัพเดตสถานะว่าง</th>';
            echo '<th>อัพเดตสถานะรถไม่ว่าง</th>';
            echo '</tr>';
            echo '</thead>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['car_id'] . '</td>';
                echo '<td>' . $row['car_name'] . '</td>';
                echo '<td>' . $row['car_nameplate'] . '</td>';
                echo '<td>' . $row['car_availability'] . '</td>';
                echo '<td><a href="update_status_action.php?car_id=' . $row['car_id'] . '&action=return" class="btn btn-primary btn-sm">รถว่างให้เช่า</a></td>';
                echo '<td><a href="update_status_action.php?car_id=' . $row['car_id'] . '&action=rent" class="btn btn-warning  btn-sm">รถไม่ว่างให้เช่า</a></td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
        } else {
            echo '<p class="text-center">ไม่พบข้อมูลรถ</p>';
        }

        mysqli_close($connection);
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>