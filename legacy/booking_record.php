<!DOCTYPE html>
<html>

<head>
    <title>ผลการจองรถ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <?php
        session_start();
        include 'connect.php';

        if (!isset($_SESSION['Username']) || $_SESSION['UserRole'] !== 'customer') {
            header("Location: login.php");
            exit();
        }

        if (isset($_POST['confirm_booking_button'])) {
            $car_id = intval($_POST['car_id']);
            $total_price = floatval($_POST['total_price']);
            $customer_username = $_SESSION['Username'];

            if (empty($customer_username)) {
                echo '<div class="alert alert-danger" role="alert">Access denied. Please go through the booking process.</div>';
            } else {
                $check_existing_sql = "SELECT * FROM clientcars WHERE car_id = ? AND client_username = ?";
                $check_existing_stmt = mysqli_prepare($connection, $check_existing_sql);
                mysqli_stmt_bind_param($check_existing_stmt, 'is', $car_id, $customer_username);
                mysqli_stmt_execute($check_existing_stmt);
                $result = mysqli_stmt_get_result($check_existing_stmt);

                if (mysqli_num_rows($result) > 0) {
                    echo 'คุณได้จองรถนี้ไปแล้ว';
                } else {
                    $start_date = new DateTime($_POST['start_date']);
                    $end_date = new DateTime($_POST['end_date']);

                    $rent_start_date = $start_date->format('Y-m-d H:i:s');
                    $rent_end_date = $end_date->format('Y-m-d H:i:s');

                    $sql = "INSERT INTO clientcars (car_id, client_username) VALUES (?, ?)";
                    $stmt = mysqli_prepare($connection, $sql);
                    mysqli_stmt_bind_param($stmt, 'is', $car_id, $customer_username);

                    if (mysqli_stmt_execute($stmt)) {
                        $sql_rented = "INSERT INTO rentedcars (car_id, customer_username, rent_start_date, rent_end_date, total_amount, return_status) VALUES (?, ?, ?, ?, ?, ?)";
                        $return_status = "จองสำเร็จ";

                        $stmt_rented = mysqli_prepare($connection, $sql_rented);
                        mysqli_stmt_bind_param($stmt_rented, 'isssss', $car_id, $customer_username, $rent_start_date, $rent_end_date, $total_price, $return_status);

                        if (mysqli_stmt_execute($stmt_rented)) {
                            echo '<div class="alert alert-success" role="alert">การจองรถสำเร็จ!</div>';
                            echo '<a class="btn btn-primary" href="car.php">ย้อนกลับ</a>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">การจองรถไม่สำเร็จ: ' . mysqli_error($connection) . '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">การจองรถไม่สำเร็จ: ' . mysqli_error($connection) . '</div>';
                    }
                }
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">ไม่สามารถเข้าถึงหน้านี้โดยตรง</div>';
        }
        ?>
    </div>
</body>

</html>