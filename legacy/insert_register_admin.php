<?php
include 'connect.php';

if (
    !isset($_POST['admin_username'], $_POST['admin_name'], $_POST['admin_phone'], $_POST['admin_email'], $_POST['admin_address'], $_POST['admin_password']) ||
    empty($_POST['admin_username']) || empty($_POST['admin_name']) || empty($_POST['admin_phone']) || empty($_POST['admin_email']) || empty($_POST['admin_address']) || empty($_POST['admin_password'])
) {
    echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
    echo "<script>window.location='register_admin.php';</script>";
    exit();
}

$admin_username = $_POST['admin_username'];
$admin_name = $_POST['admin_name'];
$admin_phone = $_POST['admin_phone'];
$admin_email = $_POST['admin_email'];
$admin_address = $_POST['admin_address'];
$admin_password = password_hash($_POST['admin_password'], PASSWORD_DEFAULT);

$check_username_sql = "SELECT * FROM admin WHERE admin_username = ?";
$stmt = $connection->prepare($check_username_sql);
$stmt->bind_param("s", $admin_username);
$stmt->execute();
$check_username_result = $stmt->get_result();

if ($check_username_result->num_rows > 0) {
    echo "<script>alert('มีชื่อผู้ใช้อยู่แล้ว');</script>";
    echo "<script>window.location='register_admin.php';</script>";
    $stmt->close();
    $connection->close();
    exit();
}

$sql = "INSERT INTO admin (admin_username, admin_name, admin_phone, admin_email, admin_address, admin_password) VALUES (?, ?, ?, ?, ?, ?)";
$insert_stmt = $connection->prepare($sql);
$insert_stmt->bind_param("ssssss", $admin_username, $admin_name, $admin_phone, $admin_email, $admin_address, $admin_password);

if ($insert_stmt->execute()) {
    echo "<script>alert('สมัครสมาชิกเรียบร้อยแล้ว');</script>";
    echo "<script>window.location='login.php';</script>";
} else {
    echo "<script>alert('สมัครสมาชิกไม่สำเร็จ: " . addslashes($connection->error) . "');</script>";
    echo "<script>window.location='register_admin.php';</script>";
}

$insert_stmt->close();
$stmt->close();
$connection->close();
?>