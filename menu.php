<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RENT - VEHICLE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">RENT - VEHICLE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="car.php">เช่า - จองยานพาหนะ</a>
                    </li>
                </ul>
                <?php
                session_start();
                if (isset($_SESSION['Username'])) {
                    $loggedInUsername = $_SESSION['Username'];
                    echo '<ul class="navbar-nav">';
                    echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
                    echo 'ยินดีต้อนรับ, ' . $loggedInUsername;
                    echo '</a>';
                    echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    echo '<li><a class="dropdown-item" href="#" id="editProfileButton">Edit Profile</a></li>';
                    echo '<li><a class="dropdown-item" href="my_booking.php">My Booking</a></li>';
                    echo '<li><a class="dropdown-item" href="feedback_form.php">Feed Back</a></li>';
                    echo '<li><hr class="dropdown-divider"></li>';
                    echo '<li><a class="dropdown-item" href="logout.php">Logout</a></li>';
                    echo '</ul>';
                    echo '</li>';
                    echo '</ul>';
                }
                ?>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editProfileButton = document.getElementById('editProfileButton');

            editProfileButton.addEventListener('click', function (event) {
                event.preventDefault();

                Swal.fire({
                    title: 'ยืนยันการแก้ไขโปรไฟล์',
                    text: 'คุณต้องการแก้ไขโปรไฟล์หรือไม่?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'แก้ไข',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'edit_profile.php';
                    }
                });
            });
        });
    </script>
</body>

</html>