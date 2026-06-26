<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าจอง - เช่ายานพาหนะ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <style>
    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .blinking {
        animation: blink 2s infinite;
    }
    </style>
</head>

<body>
    <?php
    include 'menu.php';
    ?>
    <div class="container mt-5">
        <div class="alert alert-secondary text-center" role="alert">
            <h3>รถที่พร้อมให้บริการ</h3>
        </div>
        <br>
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
        </form>

        <?php
        echo '<script>
            document.getElementById("typeDropdown").addEventListener("change", function() {
                var selectedType = this.value;
                var url = "car.php";
                if (selectedType) {
                    url += "?type=" + selectedType;
                }
                location.href = url;
            });
        </script>';

        include 'connect.php';

        if (isset($_GET['type']) && is_numeric($_GET['type'])) {
            $selectedType = $_GET['type'];
            $sql = "SELECT * FROM car WHERE type_id = $selectedType";
        } else {
            $sql = "SELECT * FROM car";
        }

        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered">';
            echo '<thead class="bg-success text-white">';
            echo '<tr>';
            echo '<th style="white-space: nowrap;">รูปรถ</th>';
            echo '<th style="white-space: nowrap;">ยี่ห้อรถ</th>';
            echo '<th style="white-space: nowrap;">ป้ายทะเบียนรถ</th>';
            echo '<th style="white-space: nowrap;">ราคาเช่ารถต่อชั่วโมง</th>';
            echo '<th style="white-space: nowrap;">ราคาเช่ารถต่อวัน</th>';
            echo '<th style="white-space: nowrap;">ค่าเช่ารายเดือน</th>';
            echo '<th style="white-space: nowrap;">สถานะ</th>';
            echo '<th style="white-space: nowrap;">HIRE</th>';
            echo '</tr>';
            echo '</thead>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td><img src="' . $row['car_img'] . '" alt="' . $row['car_name'] . '" class="img-fluid" style="max-width: 100px;"></td>';
                echo '<td>' . $row['car_name'] . '</td>';
                echo '<td>' . $row['car_nameplate'] . '</td>';
                echo '<td>' . number_format($row['ac_price'], 2) . ' บาท</td>';
                echo '<td>' . number_format($row['ac_price_per_day'], 2) . ' บาท</td>';
                echo '<td>' . number_format($row['non_ac_price_per_day'], 2) . ' บาท</td>';
                echo '<td>' . $row['car_availability'] . '</td>';

                if ($row['car_availability'] === 'รถว่างให้เช่า') {
                    echo '<td><a href="booking.php?car_id=' . $row['car_id'] . '" class="btn btn-success btn-sm">เช่ารถคันนี้</a></td>';
                } else {
                    echo '<td><button id="warningButton" class="btn btn-danger btn-sm blinking">รถไม่ว่าง</button></td>';
                }

                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
        } else {
            echo '<p class="text-center">ไม่พบข้อมูลรถ</p>';
        }

        mysqli_close($connection);
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <script>
    var warningButton = document.getElementById("warningButton");

    function startBlinking() {
        warningButton.classList.add("blinking");
    }

    function stopBlinking() {
        warningButton.classList.remove("blinking");
    }

    startBlinking();
    </script>
</body>

</html>