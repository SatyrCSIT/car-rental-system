<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="show_product.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/D#wwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.7/dist/sweetalert2.all.min.js"></script>
    <style>
    .card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .card img {
        flex: 1;
        object-fit: cover;
        max-height: 200px;
    }

    .card .card-body {
        flex: 0;
    }
    </style>
    <title>Home Page</title>
</head>

<body>
    <?php
    include 'menu.php';
    ?>
    <div class="container mt-4">
        <h1 class="alert alert-success text-center mb-4">รายการรถทั้งหมด</h1>
        <form class="mb-4 d-flex align-items-end">
            <div class="col-md-4">
                <label for="typeDropdown">เลือกประเภทรถ: </label>
                <select id="typeDropdown" name="type" class="form-select">
                    <option value="">ทั้งหมด</option>
                    <option value="1" <?php if(isset($_GET['type']) && $_GET['type'] == 1) echo 'selected' ?>>
                        มอเตอร์ไซต์</option>
                    <option value="2" <?php if(isset($_GET['type']) && $_GET['type'] == 2) echo 'selected' ?>>รถเก๋ง
                    </option>
                    <option value="3" <?php if(isset($_GET['type']) && $_GET['type'] == 3) echo 'selected' ?>>รถกระบะ
                    </option>
                    <option value="4" <?php if(isset($_GET['type']) && $_GET['type'] == 4) echo 'selected' ?>>รถตู้
                    </option>
                    <option value="5" <?php if(isset($_GET['type']) && $_GET['type'] == 5) echo 'selected' ?>>รถพิเศษ
                    </option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">ค้นหา</button>
            </div>
        </form>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php
            $connection = mysqli_connect("localhost", "root", "", "project_carrent");
            if (!$connection) {
                die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
            }

            if (isset($_GET['type']) && is_numeric($_GET['type'])) {
                $selectedType = $_GET['type'];
                $sql = "SELECT * FROM car WHERE type_id = $selectedType";
            } else {
                $sql = "SELECT * FROM car";
            }

            $result = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='col'>";
                echo "<div class='card'>";
                echo "<img src='" . $row['car_img'] . "' class='card-img-top' alt='รูปรถ'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $row['car_name'] . "</h5>";
                echo "<p class='card-text'>ราคาเช่าต่อวัน: " . $row['ac_price_per_day'] . " บาท</p>";
                echo "<a href='#' class='btn btn-primary rent-button'>เช่า</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            mysqli_close($connection);
            ?>
        </div>
    </div> <br>
    <footer class="bg-light text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 Don't Copy By ตองสุดหล่อ:)
            <a class="text-dark" href="https://mdbootstrap.com/"></a>
        </div>
        <!-- Copyright -->
    </footer>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const rentButtons = document.querySelectorAll('.rent-button');

        rentButtons.forEach((button) => {
            button.addEventListener('click', function() {
                Swal.fire({
                    icon: 'question',
                    title: 'ต้องการไปที่หน้าเช่ารถไหม',
                    text: 'ไปที่หน้าเช่ารถทั้งหมด',
                    showCancelButton: true,
                    cancelButtonText: 'ปิด',
                    confirmButtonText: 'ไปที่หน้าเช่ารถทั้งหมด',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'car.php';
                    }
                });
            });
        });
    });
    </script>
</body>

</html>