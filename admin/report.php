<?php
require "head.php";
$sql_sum = "SELECT
SUM(CASE WHEN `user_level`='user' THEN 1 ELSE 0 END) AS user
,SUM(CASE WHEN `user_level`='admin' THEN 1 ELSE 0 END) AS admin
,SUM(CASE WHEN `user_level`='request' THEN 1 ELSE 0 END) AS request
,SUM(CASE WHEN `user_level`='cancel' THEN 1 ELSE 0 END) AS cancel
FROM `users`"; 
$qr_sum = $conn->query($sql_sum);
$sum = $qr_sum->fetch_assoc();

$sql_list = "SELECT * FROM `users` WHERE `user_level`='user'";
$qr_list = $conn->query($sql_list);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Network</title>
    <link rel="stylesheet" href="../assets/bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <script src="../assets/bootstrap5/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/fontawesome/js/all.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.js"></script>
</head>
<body>
    <?php include "nav.php"; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
            <?php include "../profile.php"; ?>
            <?php include "menu.php"; ?>
                
            </div>
            <div class="col-md-8"> 
                <h3 class="mt-3 mt-md-0"><i class="fas fa-pen"></i> รายงานข้อมูลผู้ใช้ระบบ </h3>
                <div class="row g-3">
                    <div class="col-sm-6 ">
                        <div class="card">
                            <div class="card-body p-3">
                                <h1 class="d-flex align-items-center">
                                    <i class="fas fa-users" style="color: #20c997;"></i> 
                                    <div class="ms-2 w-100">Users</div> 
                                    <div><?= $sum['user'] ?></div>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body p-3">
                                <h1 class="d-flex align-items-center">
                                    <i class="fas fa-user-plus" style="color: #ffc107;"></i> 
                                    <div class="ms-2 w-100">Request</div> 
                                    <div><?= $sum['request'] ?></div>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body p-3">
                                <h1 class="d-flex align-items-center">
                                    <i class="fas fa-user-slash" style="color: #6c757d;"></i> 
                                    <div class="ms-2 w-100">Cancel</div> 
                                    <div><?= $sum['cancel'] ?></div>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body p-3">
                                <h1 class="d-flex align-items-center">
                                    <i class="fas fa-user-shield" style="color: #d63384;"></i> 
                                    <div class="ms-2 w-100">Admin</div> 
                                    <div><?= $sum['admin'] ?></div>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="mt-5">ข้อมูลผู้ใช้ระบบ</h5>

                <table class="table table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อ</th>
                            <th>สกุล</th>
                            <th>อีเมล</th>
                            <th>เพศ</th>
                            <th>ประเทศ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n=0; while ($list = $qr_list->fetch_assoc()) { ?>
                        <tr>
                            <td><?= ++$n ?></td>
                            <td><?= $list['user_name'] ?></td>
                            <td><?= $list['user_lastname'] ?></td>
                            <td><?= $list['user_email'] ?></td>
                            <td><?= $list['user_gender'] ?></td>
                            <td><?= $list['user_country'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>