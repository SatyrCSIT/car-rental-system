<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าจอง - เช่ายานพาหนะ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php
    include 'admin_menu.php'
?>
    <div class="container mt-5">
        <div class="alert alert-secondary text-center" role="alert">
            <h3>Car infomation</h3>
        </div>
        <br>

        <?php
        include 'connect.php';

        $sql = "SELECT car_id, car_name, car_nameplate, car_img, ac_price, ac_price_per_day, non_ac_price_per_day, car_availability FROM car";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered">';
            echo '<thead class="bg-success text-white">';
            echo '<tr>';
            echo '<th>รูปรถ</th>';
            echo '<th>ยี่ห้อรถ</th>';
            echo '<th>ป้ายทะเบียนรถ</th>';
            echo '<th>ราคาเช่ารถต่อชั่วโมง</th>';
            echo '<th>ราคาเช่ารถต่อวัน</th>';
            echo '<th>ค่าเช่ารายเดือน</th>';
            echo '</tr>';
            echo '</thead>';
            

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td><img src="' . $row['car_img'] . '" alt="' . $row['car_name'] . '" class="img-fluid" style="max-width: 100px;"></td>';
                echo '<td>' . $row['car_name'] . '</td>';
                echo '<td>' . $row['car_nameplate'] . '</td>';
                echo '<td>' . number_format($row['ac_price'], 2) . ' บาท</td>';
                echo '<td>' . number_format($row['ac_price_per_day'], 2) . ' บาท</td>';
                echo '<td>' . number_format($row['non_ac_price_per_day'], 2) . ' บาท</td>';                
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

    <!-- Include Bootstrap JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>