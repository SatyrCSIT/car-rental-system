<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['Username'])) {
    echo "<script>alert('กรุณาล็อกอินก่อนส่ง Feedback'); window.location='Login.php';</script>";
    exit();
}

$loggedInUsername = $_SESSION['Username'];

$sql = "SELECT customer_name, customer_email FROM customers WHERE customer_username = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $loggedInUsername);
$stmt->execute();
$result = $stmt->get_result();

$customerName = "";
$customerEmail = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $customerName = $row['customer_name'];
    $customerEmail = $row['customer_email'];
} else {
    echo "<script>alert('ไม่พบข้อมูลผู้ใช้'); window.location='Login.php';</script>";
    $stmt->close();
    $connection->close();
    exit();
}
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['message']) || empty(trim($_POST['message']))) {
        echo "<script>alert('กรุณากรอกข้อความ Feedback');</script>";
    } else {
        $name = $customerName;
        $email = $customerEmail;
        $message = $_POST['message'];

        $insert_sql = "INSERT INTO feedback (name, e_mail, message) VALUES (?, ?, ?)";
        $insert_stmt = $connection->prepare($insert_sql);
        $insert_stmt->bind_param("sss", $name, $email, $message);

        if ($insert_stmt->execute()) {
            echo "<script>alert('บันทึกข้อมูล Feedback สำเร็จ'); window.location='feedback_form.php';</script>";
        } else {
            echo "<script>alert('ผิดพลาดในการบันทึกข้อมูล Feedback: " . addslashes($connection->error) . "');</script>";
        }
        $insert_stmt->close();
    }
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>ความคิดเห็นหลังใช้บริการ</h2><br>
        <form action="feedback_form.php" method="POST">
            <div class="form-group">
                <label for="name">ชื่อ - นามสกุล:</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="<?php echo htmlspecialchars($customerName); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">อีเมล:</label>
                <input type="email" class="form-control" id="e_mail" name="e_mail"
                    value="<?php echo htmlspecialchars($customerEmail); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="message">ข้อความ:</label>
                <textarea class="form-control" id="message" name="message" rows="5"></textarea>
            </div><br>
            <button type="submit" class="btn btn-primary">ส่ง Feedback</button>
        </form><br>
        <a href="index.php"><button type="button" class="btn btn-primary">ย้อนกลับ</button></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>