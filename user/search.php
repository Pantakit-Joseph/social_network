<?php
require "head.php";
$search = isset($_POST['search']) ? $_POST['search'] : '';
$sql_list = "SELECT * FROM `users` WHERE CONCAT(`user_name`, ' ', `user_lastname`) LIKE '%$search%' AND `user_level`='user' AND `user_id`!='$user_id'";
$qr_list = $conn->query($sql_list);

function isFriend($fid) 
{
    global $user_id, $conn;
    $sql = "SELECT * FROM `friends` WHERE 
        (`friend_id`='$fid' AND `user_id`='$user_id') 
        OR (`friend_id`='$user_id' AND `user_id`='$fid')";
    $qr = $conn->query($sql);
    $re = $qr->fetch_assoc();
    if (isset($re)) {
        if ($re['accept'] == 0 && $re['friend_id'] == $user_id) {
            return '2';
        }
        return $re['accept'];
    } else {
        return '3';
    }
    
}

function getbtn($fid) 
{
    global $user_id;
    $btn = "";
    switch (isFriend($fid)) {
        case '0':
            $btn = "
            <em class=\"text-secondary text-center\" style=\"font-size: 10pt;\">รอการตอบรับ</em>
            <a href=\"friend.php?i=0&fid={$fid}&uid={$user_id}\" class=\"btn btn-sm btn-outline-warning\">ยกเลิกการขอเป็นเพื่อน</a>
            ";
            break;
        case '1':
            $btn = "
            <a href=\"friend.php?i=0&fid={$fid}&uid={$user_id}\" class=\"btn btn-sm btn-outline-danger\">ยกเลิกการเป็นเพื่อน</a>
            ";
            break;
        case '2':
            $btn = "
            <a href=\"friend.php?i=1&fid={$user_id}&uid={$fid}\" 
            class=\"btn btn-sm btn-outline-warning\">ตอบรับคำขอเป็นเพื่อน</a>
            <a href=\"friend.php?i=0&fid={$fid}&uid={$user_id}\" 
            class=\"btn btn-sm btn-outline-danger\">ปฏิเสธคำขอเป็นเพื่อน</a>
            ";
            break;
        case '3':
            $btn = "
            <a href=\"friend.php?i=2&fid={$fid}&uid={$user_id}\"
            class=\"btn btn-sm btn-outline-success\">ขอเป็นเพื่อน</a>";
            break;
    }
    return $btn;
}
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
                        <img src="<?= getProfile($list) ?>" alt="" class="card-img-top" style="width: 100%; height: 14rem; object-fit: cover;">
                        <div class="card-body">
                            <p>
                                ชื่อ: <?= getName($list) ?>
                                <br>อีเมล: <?= $list['user_email'] ?>
                                <br>เพศ: <?= $list['user_gender'] ?>
                                <br>ประเทศ: <?= $list['user_country'] ?>
                            </p>
                            <div class="d-grid gap-2">
                                <?= getbtn($list['user_id']); ?> 
                                
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