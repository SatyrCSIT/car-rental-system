<?php
session_start();
if (!isset($_SESSION['Username']) || $_SESSION['UserRole'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include 'connect.php';
$sql = "SELECT * FROM customers";
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
    <title>Manage Users - เช่ายานพาหนะ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include 'admin_menu.php'; ?>

    <div class="container mt-5">
        <h2>Manage Users</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Username</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['customer_name']; ?></td>
                        <td><?php echo $row['customer_username']; ?></td>
                        <td><?php echo $row['customer_phone']; ?></td>
                        <td><?php echo $row['customer_email']; ?></td>
                        <td><?php echo $row['customer_address']; ?></td>
                        <td><?php echo $row['customer_password']; ?></td>
                        <td>
                            <form method="POST" action="delete_user.php">
                                <input type="hidden" name="user_id" value="<?php echo $row['customer_username']; ?>">
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