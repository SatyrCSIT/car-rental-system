<?php
session_start();
if (!isset($_SESSION['Username']) || $_SESSION['UserRole'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['car_id'])) {
    include 'connect.php';

    $car_id = $_GET['car_id'];

    $sql = "SELECT * FROM car WHERE car_id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $car_id);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $car_name = $row['car_name'];
            $car_nameplate = $row['car_nameplate'];
            $ac_price = $row['ac_price'];
            $ac_price_per_day = $row['ac_price_per_day'];
            $non_ac_price_per_day = $row['non_ac_price_per_day'];
            $car_availability = $row['car_availability'];
        } else {
            echo "ไม่พบรถที่คุณต้องการแก้ไข";
            mysqli_close($connection);
            exit();
        }
    } else {
        echo "เกิดข้อผิดพลาดในการดึงข้อมูลรถ: " . mysqli_error($connection);
        mysqli_close($connection);
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = $_POST['car_id'];
    $car_name = $_POST['car_name'];
    $car_nameplate = $_POST['car_nameplate'];
    $ac_price = $_POST['ac_price'];
    $ac_price_per_day = $_POST['ac_price_per_day'];
    $non_ac_price_per_day = $_POST['non_ac_price_per_day'];
    $car_availability = $_POST['car_availability'];

    include 'Connect.php';

    $sql = "UPDATE car SET car_name = ?, car_nameplate = ?, ac_price = ?, ac_price_per_day = ?, non_ac_price_per_day = ?, car_availability = ? WHERE car_id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssi', $car_name, $car_nameplate, $ac_price, $ac_price_per_day, $non_ac_price_per_day, $car_availability, $car_id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: car_admin.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
        mysqli_close($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car - เช่ายานพาหนะ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include 'admin_menu.php'; ?>

    <div class="container mt-5">
        <h2>Edit Car</h2>
        <form action="edit_car.php" method="POST">
            <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
            <div class="mb-3">
                <label for="car_name" class="form-label">ยี่ห้อรถ:</label>
                <input type="text" class="form-control" id="car_name" name="car_name" required
                    value="<?php echo $car_name; ?>">
            </div>
            <div class="mb-3">
                <label for="car_nameplate" class="form-label">ป้ายทะเบียนรถ</label>
                <input type="text" class="form-control" id="car_nameplate" name="car_nameplate" required
                    value="<?php echo $car_nameplate; ?>">
            </div>
            <div class="mb-3">
                <label for="ac_price" class="form-label">ราคาเช่ารถต่อชั่วโมง:</label>
                <input type="text" class="form-control" id="ac_price" name="ac_price" required
                    value="<?php echo $ac_price; ?>">
            </div>
            <div class="mb-3">
                <label for="ac_price_per_day" class="form-label">ราคาเช่ารถต่อวัน:</label>
                <input type="text" class="form-control" id="ac_price_per_day" name="ac_price_per_day" required
                    value="<?php echo $ac_price_per_day; ?>">
            </div>
            <div class="mb-3">
                <label for="non_ac_price_per_day" class="form-label">ค่าเช่ารายเดือน:</label>
                <input type="text" class="form-control" id="non_ac_price_per_day" name="non_ac_price_per_day" required
                    value="<?php echo $non_ac_price_per_day; ?>">
            </div>
            <div class="mb-3">
                <label for="car_availability" class="form-label">สถานะรถ:</label>
                <select class="form-control" id="car_availability" name="car_availability" required>
                    <option value="yes" <?php if ($car_availability == 'yes') echo 'selected'; ?>>ว่างให้เช่า</option>
                    <option value="no" <?php if ($car_availability == 'no') echo 'selected'; ?>>ไม่ว่างให้เช่า</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form> <br>
        <a href="admin.php"><button type="submit" class="btn btn-primary">ย้อนกลับ</button></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>