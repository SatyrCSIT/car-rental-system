<?php
include 'connect.php';

$calculated_price = null;

if (isset($_GET['car_id'])) {
    $car_id = intval($_GET['car_id']);

    $sql = "SELECT car_name, car_nameplate, ac_price_per_day FROM car WHERE car_id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $car_id);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if (isset($_POST['calculate_button'])) {
                if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                    $start_date = new DateTime($_POST['start_date']);
                    $end_date = new DateTime($_POST['end_date']);
                    $interval = $end_date->diff($start_date);
                    $days = $interval->days;

                    if ($days > 0) {
                        $daily_price = $row['ac_price_per_day'];
                        $total_price = $daily_price * $days;

                        $calculated_price = $total_price;
                    } else {
                        echo 'กรุณาเลือกวันที่ถูกต้อง';
                    }
                }
            }

            if (isset($_POST['confirm_booking_button'])) {
                if (isset($_SESSION['Username'])) {
                    $customer_username = $_SESSION['Username'];

                    $sql = "INSERT INTO clientcars (car_id, client_username) VALUES (?, ?)";
                    $stmt = mysqli_prepare($connection, $sql);
                    mysqli_stmt_bind_param($stmt, 'is', $car_id, $customer_username);

                    if (mysqli_stmt_execute($stmt)) {
                        echo 'เพิ่มข้อมูลการจองรถเรียบร้อย';
                    } else {
                        echo 'เกิดข้อผิดพลาดในการเพิ่มข้อมูลการจองรถ: ' . mysqli_error($connection);
                    }
                } else {
                    echo 'กรุณาเข้าสู่ระบบก่อนทำการจองรถ';
                }
            }
        }
    }
}
mysqli_close($connection);
?>
<!DOCTYPE html>
<html>

<head>
    <title>ข้อมูลการจองรถ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5 bg-light p-4">
        <h2>รายละเอียดรถ</h2>
        <p>ชื่อ-ยี่ห้อรถ: <?php echo $row['car_name']; ?></p>
        <p>ป้ายทะเบียนรถ: <?php echo $row['car_nameplate']; ?></p>
        <p>ราคาเช่าตามรายวัน: <?php echo $row['ac_price_per_day']; ?> บาท</p>

        <h2>คำนวณราคาเช่า</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="start_date">วันที่เช่ารถ:</label>
                <input type="datetime-local" class="form-control" name="start_date" required>
            </div>

            <div class="form-group">
                <label for="end_date">วันที่คืนรถ:</label>
                <input type="datetime-local" class="form-control" name="end_date" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="calculate_button">คำนวณราคา</button>
        </form>

        <?php
        if (isset($_POST['calculate_button'])) {
            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                $start_date = new DateTime($_POST['start_date']);
                $end_date = new DateTime($_POST['end_date']);

                if ($start_date > new DateTime()) {
                    $interval = $end_date->diff($start_date);
                    $days = $interval->days;

                    if ($days > 0) {
                        $daily_price = $row['ac_price_per_day'];
                        $total_price = $daily_price * $days;

                        $calculated_price = $total_price;
                    } else {
                        echo 'กรุณาเลือกวันที่ถูกต้อง';
                    }
                } else {
                    echo 'กรุณาเลือกวันที่เริ่มเช่ารถที่อยู่ในอนาคต';
                }
            }
        }

        if (!is_null($calculated_price)) {
            echo '<p class="mt-3">ราคารวมทั้งหมด: ' . $calculated_price . ' บาท</p>';
            echo '<form method="post" action="booking_record.php">';
            echo '<input type="hidden" name="car_id" value="' . $car_id . '">';
            echo '<input type="hidden" name="total_price" value="' . $calculated_price . '">';
            echo '<input type="hidden" name="start_date" value="' . $_POST['start_date'] . '">';
            echo '<input type="hidden" name="end_date" value="' . $_POST['end_date'] . '">';
            echo '<button type="submit" class="btn btn-success" name="confirm_booking_button">ยืนยันการจอง</button>';
            echo '</form>';
        }
        ?>
    </div>
</body>

</html>