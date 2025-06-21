<?php
session_start();
if (!isset($_SESSION['Username']) || $_SESSION['UserRole'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_feedback_id'])) {
    $feedback_id = $_POST['delete_feedback_id'];

    $delete_sql = "DELETE FROM feedback WHERE feedback_id = ?";
    $stmt = $connection->prepare($delete_sql);
    $stmt->bind_param("i", $feedback_id);

    if ($stmt->execute()) {
        echo "<script>alert('ลบ Feedback สำเร็จ'); window.location = 'show_feedback.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการลบ: " . addslashes($connection->error) . "');</script>";
    }

    $stmt->close();
}

$sql = "SELECT * FROM feedback";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - เช่ายานพาหนะ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'admin_menu.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">ข้อมูล Feedback</h2>
        <br>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ชื่อผู้ใช้งาน</th>
                    <th>อีเมล</th>
                    <th>ข้อคิดเห็น</th>
                    <th>การดำเนินการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['e_mail']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                        echo "<td>";
                        echo "<form method='POST' onsubmit='return confirm(\"คุณแน่ใจหรือไม่ว่าต้องการลบ Feedback นี้?\");'>";
                        echo "<input type='hidden' name='delete_feedback_id' value='" . $row['feedback_id'] . "'>";
                        echo "<button type='submit' class='btn btn-danger btn-sm'>ลบ</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>ไม่มีข้อมูล Feedback</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
<?php
$connection->close();
?>