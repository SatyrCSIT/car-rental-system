<?php
include 'menu.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "project_carrent";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

$loggedInUsername = $_SESSION['Username'];
$sql = "SELECT * FROM customers WHERE customer_username='$loggedInUsername'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];
    $customer_password = password_hash($_POST['customer_password'], PASSWORD_DEFAULT);

    $update_sql = "UPDATE customers SET customer_name='$customer_name', customer_phone='$customer_phone', customer_email='$customer_email', customer_address='$customer_address', customer_password='$customer_password' WHERE customer_username='$loggedInUsername'";

    if ($conn->query($update_sql) === TRUE) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
        Swal.fire({
          title: "อัปเดตข้อมูลสำเร็จ",
          text: "ข้อมูลของคุณถูกอัปเดตเรียบร้อยแล้ว",
          icon: "success",
          confirmButtonText: "ตกลง"
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "edit_profile.php";
          }
        });
        </script>';
    } else {
        echo "ผิดพลาดในการอัปเดตข้อมูล: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Profile</h2>
        <form action="edit_profile.php" method="POST" id="editForm">
            <div class="form-group">
                <label for="customer_name">ชื่อ - นามสกุล:</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name"
                    value="<?php echo $row['customer_name']; ?>">
            </div>
            <div class="form-group">
                <label for="customer_phone">เบอร์โทรศัพท์:</label>
                <input type="text" class="form-control" id="customer_phone" name="customer_phone"
                    value="<?php echo $row['customer_phone']; ?>">
            </div>
            <div class "form-group">
                <label for="customer_email">อีเมล:</label>
                <input type="email" class="form-control" id="customer_email" name="customer_email"
                    value="<?php echo $row['customer_email']; ?>">
            </div>
            <div class="form-group">
                <label for="customer_address">ที่อยู่</label>
                <input type="text" class="form-control" id="customer_address" name="customer_address"
                    value="<?php echo $row['customer_address']; ?>">
            </div>
            <div class="form-group">
                <label for="customer_password">รหัสผ่าน:</label>
                <input type="password" class="form-control" id="customer_password" name="customer_password"
                    value="<?php echo $row['customer_password']; ?>">
            </div>
            <button type="submit" class="btn btn-primary" id="submitBtn">บันทึกการแก้ไข</button>
        </form> <br>
        <a href="index.php"><button type="submit" class="btn btn-primary">ย้อนกลับ</button></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>