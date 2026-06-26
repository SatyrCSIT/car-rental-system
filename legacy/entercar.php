<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container mt-5">
            <h2>เพิ่มข้อมูลรถ</h2>
            <form action="add_car.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="car_name" class="form-label">ยี่ห้อรถ:</label>
                            <input type="text" class="form-control" id="car_name" name="car_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="car_nameplate" class="form-label">ป้ายทะเบียนรถ</label>
                            <input type="text" class="form-control" id="car_nameplate" name="car_nameplate" required>
                        </div>
                        <div class="mb-3">
                            <label for="car_img" class="form-label">รูปภาพ:</label>
                            <input type="file" class="form-control" id="car_img" name="car_img" required>
                        </div>
                        <div class="mb-3">
                            <label for="car_availability" class="form-label">สถานะรถ:</label>
                            <select class="form-select" id="car_availability" name="car_availability" required>
                                <option value="yes">รออัพเดทสถานะ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="ac_price" class="form-label">ราคาเช่ารถต่อชั่วโมง:</label>
                            <input type="text" class="form-control" id="ac_price" name="ac_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="ac_price_per_day" class="form-label">ราคาเช่ารถต่อวัน:</label>
                            <input type="text" class="form-control" id="ac_price_per_day" name="ac_price_per_day"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="non_ac_price_per_day" class="form-label">ค่าเช่ารายเดือน:</label>
                            <input type="text" class="form-control" id="non_ac_price_per_day"
                                name="non_ac_price_per_day" required>
                        </div>
                        <div class="mb-3">
                            <label for="car_type" class="form-label">ประเภทรถ:</label>
                            <select class="form-select" id="car_type" name="car_type" required>
                                <option value="1">มอเตอร์ไซต์</option>
                                <option value="2">รถเก๋ง</option>
                                <option value="3">รถกระบะ</option>
                                <option value="4">รถตู้</option>
                                <option value="5">รถพิเศษ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-start mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <a href="admin.php" class="btn btn-primary">ย้อนกลับ</a>
                </div>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

    <!-- เรียกใช้ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>