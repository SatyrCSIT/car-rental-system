<?php
session_start();
if (!isset($_SESSION['Username']) || $_SESSION['UserRole'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'connect.php';

$sql = "SELECT car_id, car_name FROM car";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Car - เช่ายานพาหนะ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include 'admin_menu.php'; ?>

    <div class="container mt-5">
        <h2>Select Car to Edit</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Car Name</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $car_id = $row['car_id'];
                    $car_name = $row['car_name'];
                    ?>
                    <tr>
                        <td><?php echo $car_name; ?></td>
                        <td>
                            <a href="edit_car.php?car_id=<?php echo $car_id; ?>" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <a href="delete_car.php?car_id=<?php echo $car_id; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>