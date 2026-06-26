<?php
session_start();
if (!isset($_SESSION['Username']) || $_SESSION['UserRole'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    $sql = "DELETE FROM customers WHERE customer_username = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, 's', $user_id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: manage_users.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>