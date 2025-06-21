<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>สมัครสมาชิก</title>
</head>

<body>
    <div class="container">
        <h2 class="text-success">Admin</h2>
        <br>
        <form method="POST" action="insert_register_admin.php">
            ชื่อผู้ใช้: <input type="text" name="admin_username" class="form-control" required><br>

            ชื่อ: <input type="text" name="admin_name" class="form-control" required><br>

            เบอร์โทรศัพท์: <input type="text" name="admin_phone" id="phone" class="form-control" required><br>

            อีเมล: <input type="text" name="admin_email" class="form-control" required><br>

            ที่อยู่: <input type="text" name="admin_address" class="form-control" required><br>

            รหัสผ่าน: <input type="password" name="admin_password" id="password" class="form-control" required>

            <input type="submit" name="submit" value="สมัครสมาชิก"><br>

            <input type="reset" name="cancel" value="รีเซ็ต"><br>

            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const phoneInput = document.querySelector('input[name="phone"]');
            phoneInput.addEventListener("input", function () {
                phoneInput.value = phoneInput.value.replace(/\D/g, '');
                if (phoneInput.value.length !== 10) {
                    phoneInput.setCustomValidity("โปรดใส่เบอร์โทรศัพท์ให้ครบ 10 ตัว");
                } else {
                    phoneInput.setCustomValidity("");
                }
                if (phoneInput.value.length > 10) {
                    phoneInput.value = phoneInput.value.slice(0, 10);
                }
            });
        });
    </script>

    <script>
        document.getElementById('password').addEventListener('input', function () {
            var password = this.value;
            var englishPattern = /^[a-zA-Z0-9!@#$%^&*()_+{}\[\]:;<>,.?~\\-]+$/;

            if (password.length < 8) {
                this.setCustomValidity("รหัสผ่านควรมีอย่างน้อย 8 ตัว");
            } else if (!englishPattern.test(password)) {
                this.setCustomValidity("โปรดใช้รหัสผ่านเป็นภาษาอังกฤษเท่านั้น");
            } else {
                this.setCustomValidity('');
            }
        });
    </script>



</body>

</html>