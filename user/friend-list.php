<?php
require "head.php"; 
$sql_list = "SELECT * FROM `users` WHERE (
`user_id` IN (SELECT `friends`.`friend_id` FROM `friends` WHERE `friends`.`user_id`='$user_id' AND `friends`.`accept`='1')
OR `user_id` IN (SELECT `friends`.`user_id` FROM `friends` WHERE `friends`.`friend_id`='$user_id' AND `friends`.`accept`='1')
) AND `user_level`='user' AND `user_id`!='$user_id'";
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
                <h3><i class="fas fa-users"></i> เพื่อน</h3> 

                <div class="mt-3 d-flex flex-wrap gap-2">
                    <?php while ($list = $qr_list->fetch_assoc()) { ?>
                    <div class="card" style="width: 14rem;">
                        <img src="<?= getProfile($list) ?>" alt="" class="card-img-top" style="width: 100%; height: 14rem; object-fit: cover;">
                        <div class="card-body">
                            <p>
                                ชื่อ: <?= getName($list) ?>
                                <br>อีเมล: <?= $list['user_email'] ?>
                                <br>เพศ: <?= $list['user_gender'] ?>
                                <br>ประเทศ: <?= $list['user_country'] ?>
                            </p>
                            <div class="d-grid gap-2">
                                <a href="friend.php?i=0&fid=<?= $list['user_id'] ?>&uid=<?= $user_id ?>" 
                                class="btn btn-sm btn-outline-danger">
                                    ยกเลิกการเป็นเพื่อน
                                </a>
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