<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รถที่คุณได้ทำการเช่า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h2 class="mb-0">รถที่คุณได้ทำการเช่า</h2>
            </div>
            <div class="card-body p-4">
                <?php
                if (isset($_SESSION['Username'])) {
                    $customer_username = $_SESSION['Username'];

                    $sql = "SELECT rc.rent_id, rc.car_id, c.car_name, c.car_nameplate, rc.rent_start_date, rc.rent_end_date, rc.total_amount, c.car_img, rc.return_status FROM rentedcars rc JOIN car c ON rc.car_id = c.car_id WHERE rc.customer_username = ?";
                    $stmt = mysqli_prepare($connection, $sql);
                    mysqli_stmt_bind_param($stmt, 's', $customer_username);

                    if (mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if (mysqli_num_rows($result) > 0) {
                            echo '
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>รหัสการเช่า</th>
                                                <th>ยี่ห้อรถ</th>
                                                <th>ป้ายทะเบียนรถ</th>
                                                <th>วันที่เริ่มเช่า</th>
                                                <th>วันที่คืนรถ</th>
                                                <th>ราคารวม</th>
                                                <th>รูปรถ</th>
                                                <th>สถานะการเช่า</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                            ';
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<tr>';
                                echo '	<td>' . $row['rent_id'] . '</td>';
                                echo '	<td>' . $row['car_name'] . '</td>';
                                echo '	<td>' . $row['car_nameplate'] . '</td>';
                                echo '	<td>' . $row['rent_start_date'] . '</td>';
                                echo '	<td>' . $row['rent_end_date'] . '</td>';
                                echo '	<td>' . number_format($row['total_amount'], 2) . ' บาท</td>';
                                echo '	<td><img src="' . $row['car_img'] . '" class="img-fluid rounded" width="100"></td>';
                                echo '	<td>' . $row['return_status'] . '</td>';
                                echo '</tr>';
                            }
                            echo '</tbody></table></div>';
                        } else {
                            echo '<div class="alert alert-info text-center" role="alert">คุณยังไม่มีรายการเช่ารถ</div>';
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        echo '<div class="alert alert-danger text-center" role="alert">เกิดข้อผิดพลาดในการดึงข้อมูล: ' . mysqli_error($connection) . '</div>';
                    }
                    mysqli_close($connection);
                } else {
                    echo '<div class="alert alert-warning text-center" role="alert">กรุณาเข้าสู่ระบบก่อนดูข้อมูลการเช่ารถ</div>';
                }
                ?>
                <div class="text-center mt-3">
                    <a href="index.php" class="btn btn-primary btn-lg">ย้อนกลับ</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>