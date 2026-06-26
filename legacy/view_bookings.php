<?php
session_start();
if (!isset($_SESSION['Username']) || $_SESSION['UserRole'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_booking_id'])) {
    $booking_id = $_POST['delete_booking_id'];

    mysqli_begin_transaction($connection);

    try {
        $sql_select = "SELECT car_id, customer_username FROM rentedcars WHERE rent_id = ?";
        $stmt_select = mysqli_prepare($connection, $sql_select);
        mysqli_stmt_bind_param($stmt_select, 'i', $booking_id);
        mysqli_stmt_execute($stmt_select);
        $result_select = mysqli_stmt_get_result($stmt_select);
        $row = mysqli_fetch_assoc($result_select);
        mysqli_stmt_close($stmt_select);

        if ($row) {
            $car_id = $row['car_id'];
            $customer_username = $row['customer_username'];

            $sql_delete_clientcars = "DELETE FROM clientcars WHERE car_id = ? AND client_username = ?";
            $stmt_delete_clientcars = mysqli_prepare($connection, $sql_delete_clientcars);
            mysqli_stmt_bind_param($stmt_delete_clientcars, 'is', $car_id, $customer_username);
            mysqli_stmt_execute($stmt_delete_clientcars);
            mysqli_stmt_close($stmt_delete_clientcars);

            $sql_delete_rentedcars = "DELETE FROM rentedcars WHERE rent_id = ?";
            $stmt_delete_rentedcars = mysqli_prepare($connection, $sql_delete_rentedcars);
            mysqli_stmt_bind_param($stmt_delete_rentedcars, 'i', $booking_id);
            mysqli_stmt_execute($stmt_delete_rentedcars);
            mysqli_stmt_close($stmt_delete_rentedcars);

            mysqli_commit($connection);
            header("Location: view_bookings.php");
            exit();
        } else {
            throw new Exception("ไม่พบข้อมูลการจอง");
        }
    } catch (Exception $e) {
        mysqli_rollback($connection);
        echo "Error: " . $e->getMessage();
        exit();
    }
}

$sql = "SELECT rc.rent_id AS booking_id, rc.car_id, c.customer_name, c.customer_phone, rc.rent_start_date, rc.rent_end_date, car.car_img
        FROM rentedcars rc
        INNER JOIN customers c ON rc.customer_username = c.customer_username
        INNER JOIN car ON rc.car_id = car.car_id";

$result = mysqli_query($connection, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($connection);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings - เช่ายานพาหนะ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include 'admin_menu.php'; ?>

    <div class="container mt-5">
        <h2>View Bookings</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Car ID</th>
                    <th>Image</th>
                    <th>Customer Name</th>
                    <th>Booking Start Date</th>
                    <th>Booking End Date</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['booking_id']; ?></td>
                        <td><?php echo $row['car_id']; ?></td>
                        <td><img src="<?php echo $row['car_img']; ?>" alt="Car Image" class="img-fluid"
                                style="max-width: 100px;"></td>
                        <td><?php echo $row['customer_name']; ?></td>
                        <td><?php echo $row['rent_start_date']; ?></td>
                        <td><?php echo $row['rent_end_date']; ?></td>
                        <td><?php echo $row['customer_phone']; ?></td>
                        <td>
                            <form method="post" action="view_bookings.php">
                                <input type="hidden" name="delete_booking_id" value="<?php echo $row['booking_id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>