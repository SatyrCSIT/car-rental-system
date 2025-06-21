<?php
include 'connect.php';

if (
    !isset($_POST['customer_username'], $_POST['customer_name'], $_POST['customer_phone'], $_POST['customer_email'], $_POST['customer_address'], $_POST['customer_password']) ||
    empty($_POST['customer_username']) || empty($_POST['customer_name']) || empty($_POST['customer_phone']) || empty($_POST['customer_email']) || empty($_POST['customer_address']) || empty($_POST['customer_password'])
) {
    echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
    echo "<script>window.location='Register.php';</script>";
    exit();
}

$customer_username = $_POST['customer_username'];
$customer_name = $_POST['customer_name'];
$customer_phone = $_POST['customer_phone'];
$customer_email = $_POST['customer_email'];
$customer_address = $_POST['customer_address'];
$customer_password = password_hash($_POST['customer_password'], PASSWORD_DEFAULT);

$check_username_sql = "SELECT * FROM customers WHERE customer_username = ?";
$stmt = $connection->prepare($check_username_sql);
$stmt->bind_param("s", $customer_username);
$stmt->execute();
$check_username_result = $stmt->get_result();

if ($check_username_result->num_rows > 0) {
    echo "<script>alert('มีชื่อผู้ใช้อยู่แล้ว');</script>";
    echo "<script>window.location='Register.php';</script>";
    $stmt->close();
    $connection->close();
    exit();
}

$sql = "INSERT INTO customers (customer_username, customer_name, customer_phone, customer_email, customer_address, customer_password) VALUES (?, ?, ?, ?, ?, ?)";
$insert_stmt = $connection->prepare($sql);
$insert_stmt->bind_param("ssssss", $customer_username, $customer_name, $customer_phone, $customer_email, $customer_address, $customer_password);

if ($insert_stmt->execute()) {
    echo "<script>alert('สมัครสมาชิกเรียบร้อยแล้ว');</script>";
    echo "<script>window.location='Login.php';</script>";
} else {
    echo "<script>alert('สมัครสมาชิกไม่สำเร็จ: " . addslashes($connection->error) . "');</script>";
    echo "<script>window.location='Register.php';</script>";
}

$insert_stmt->close();
$stmt->close();
$connection->close();
?>