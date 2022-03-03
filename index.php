<?php
session_start();
include "connect/db.php";
include "helper.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>social network</title>
    <link rel="stylesheet" href="assets/bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <script src="assets/bootstrap5/js/bootstrap.bundle.min.js"></script>
    <script src="assets/fontawesome/js/all.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">
                <b>SOCIAL <span class="text-warning">NETWORK</span></b>
            </a>
            <button data-bs-target="#login" data-bs-toggle="modal" class="btn btn-sm btn-warning">
                เข้าสู่ระบบ
            </button>
            <?php include "login.php"; ?>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md text-center">
                <div class="pt-md-5 m-md-5">
                    <h1>
                        <b>SOCIAL <span class="text-warning">NETWORK</span></b>
                    </h1>
                    <p class="fs-4">
                        Social Network ช่วยคุณเชื่อมต่อและแชร์กับผู้คนมากมายรอบตัวคุณ
                    </p>
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <form method="post">

                        <div class="card-header">
                            <h3 class="card-title">สมัครขอใช้งานระบบ</h3>
                        </div>
                        <div class="card-body">

                            <div class="input-group mt-3">
                                <input class="form-control" type="text" name="u_name" required placeholder="ชื่อ">
                                <input class="form-control" type="text" name="u_lastname" required placeholder="นามสกุล">
                            </div>
                            <div class="input-group mt-3">
                                <input class="form-control" type="email" name="u_email" required placeholder="อีเมล">
                            </div>
                            <div class="input-group mt-3">
                                <input class="form-control" minlength="6" type="password" name="u_pass" required placeholder="รหัสผ่าน">
                            </div>

                            <div class="input-group mt-3">
                                <select class="form-select" name="u_gender" required>
                                    <option selected disabled value="">เลือกเพศ</option>
                                    <option>ชาย</option>
                                    <option>หญิง</option>
                                    <option>อื่นๆ</option>
                                </select>
                            </div>

                            <div class="input-group mt-3">
                                <select class="form-select" name="u_country" required>
                                    <option selected disabled value="">เลือกประเทศ</option>
                                    <option>Thailand</option>
                                    <option>China</option>
                                    <option>England</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-grid">
                                <button name="sign_btn" class="btn btn-warning" type="submit">
                                    สมัคร
                                </button>
                            </div>
                        </div>
                    </form>
                    <?php include "sign.php"; ?>
                </div>

            </div>
        </div>
    </div>
</body>

</html>