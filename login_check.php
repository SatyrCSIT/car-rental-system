<?php
session_start();

include 'connect.php';

unset($_SESSION["Error"]);

if (!isset($_POST['username']) || !isset($_POST['password']) || empty($_POST['username']) || empty($_POST['password'])) {
    $_SESSION["Error"] = "กรุณากรอกชื่อผู้ใช้และรหัสผ่าน";
    header("location: login.php");
    exit();
}

$Username = $_POST['username'];
$Password = $_POST['password'];

$sql = "SELECT * FROM customers WHERE customer_username = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $Username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row && password_verify($Password, $row['customer_password'])) {
    $_SESSION["Username"] = $row['customer_username'];
    $_SESSION["Firstname"] = $row['customer_name'];
    $_SESSION["UserRole"] = 'customer';

    $stmt->close();
    $connection->close();
    header("location: index.php");
    exit();
}

$sql_admin = "SELECT * FROM admin WHERE admin_username = ?";
$stmt_admin = $connection->prepare($sql_admin);
$stmt_admin->bind_param("s", $Username);
$stmt_admin->execute();
$result_admin = $stmt_admin->get_result();
$row_admin = $result_admin->fetch_assoc();

if ($row_admin && password_verify($Password, $row_admin['admin_password'])) {
    $_SESSION["Username"] = $row_admin['admin_username'];
    $_SESSION["Firstname"] = $row_admin['admin_name'];
    $_SESSION["UserRole"] = 'admin';

    $stmt_admin->close();
    $connection->close();
    header("location: admin.php");
    exit();
}

$_SESSION["Error"] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
$stmt->close();
$stmt_admin->close();
$connection->close();
header("location: login.php");
?>