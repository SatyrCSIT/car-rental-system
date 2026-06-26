<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];

    $sql_delete_rentedcars = "DELETE FROM rentedcars WHERE id = ?";
    $stmt_delete_rentedcars = mysqli_prepare($connection, $sql_delete_rentedcars);
    mysqli_stmt_bind_param($stmt_delete_rentedcars, 'i', $booking_id);

    if (mysqli_stmt_execute($stmt_delete_rentedcars)) {
        header("Location: view_bookings.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>