<?php
require "head.php";
$search = isset($_POST['search']) ? $_POST['search'] : '';
$sql_list = "SELECT * FROM `users` WHERE CONCAT(`user_name`, ' ', `user_lastname`) LIKE '%$search%' AND `user_level`='user' AND `user_id`!='$user_id'";
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
                <h3><i class="fas fa-search"></i> ผลการค้นหา: <em class="text-secondary"><?= $search ?></em></h3>
                <div class="mt-3 d-flex flex-wrap gap-2">
                    <?php while ($list = $qr_list->fetch_assoc()) { ?>
                        <div class="card" style="width: 14rem;">
                            <img src="<?= getProfile($list) ?>" alt="" class="card-img-top" style="width: 100%; height: 14rem; object-fit: cover;"
                            data-bs-toggle="modal" data-bs-target="#smodal<?= $list['user_id'] ?>">
                            <div class="card-body">
                                <p data-bs-toggle="modal" data-bs-target="#smodal<?= $list['user_id'] ?>">
                                    ชื่อ: <?= getName($list) ?>
                                    <br>อีเมล: <?= $list['user_email'] ?>
                                    <br>เพศ: <?= $list['user_gender'] ?>
                                    <br>ประเทศ: <?= $list['user_country'] ?>
                                </p>
                                <div class="d-grid gap-3">
                                    <a href="approve.php?i=0&id=<?= $list['user_id'] ?>" class="btn btn-sm btn-outline-danger">ระงับการใช้งาน</a>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="smodal<?= $list['user_id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Profile</h5>
                                        <button class="btn btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center">
                                            <img src="<?= getProfile($list) ?>" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                        <hr>
                                        <p>
                                            ชื่อ: <?= getName($list) ?>
                                            <br>

                                            อีเมล: <?= $list['user_email'] ?>
                                            <br>

                                            เพศ: <?= $list['user_gender'] ?>
                                            <br>

                                            ประเทศ: <?= $list['user_country'] ?>
                                        </p>
                                        <hr>
                                        <form action="repass.php?id=<?= $list['user_id'] ?>" method="post">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-key"></i>
                                                </span>
                                                <input type="password" name="pass" class="form-control" minlength="6" required placeholder="รหัสผ่าน">
                                                <button type="submit" name="pass_btn" class="btn btn-secondary">
                                                    แก้ไขรหัสผ่าน
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="d-grid col-12">
                                            <a href="approve.php?i=0&id=<?= $list['user_id'] ?>" class="btn btn-outline-danger" onclick="return confirm('ยืนยันการระงับการใช้งาน')">
                                                ระงับการใช้งาน
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>