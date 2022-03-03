<?php
// $sql_list_friend = "SELECT * FROM `users` WHERE `user_level`='user'";
$sql_list_friend = "SELECT * FROM `users` WHERE (
    `user_id` IN (SELECT `friends`.`friend_id` FROM `friends` WHERE `friends`.`user_id`='$user_id' AND `friends`.`accept`='1')
    OR `user_id` IN (SELECT `friends`.`user_id` FROM `friends` WHERE `friends`.`friend_id`='$user_id' AND `friends`.`accept`='1')
    ) AND `user_level`='user' ORDER BY `online_time` DESC
    ";
$qr_list_friend = $conn->query($sql_list_friend);
?>
<div class="card">
    <div class="card-header">
        <div class="card-title">เพื่อน</div>
    </div>
    <div class="card-body p-0">
        <ul class="list-group">
            <?php 
            while ($friend = $qr_list_friend->fetch_assoc()) { 
                $time_check = 60; 
                $time = null;
                if (!empty($friend['online_time'])) {
                    $online_time = (int)$friend['online_time'];
                    $time = time() - $online_time;
                }
                
            ?>
                <li class="list-group-item p-2 d-flex justify-content-start align-items-center gap-2">
                    <div class="d-block">
                        <img src="<?= getProfile($friend) ?>" alt="" class="rounded-circle" style="width:40px; height: 40px; object-fit: cover;">
                        <?php
                        if ($time > 0 && $time < $time_check) {
                        ?>
                        <span class="position-absolute translate-middle p-1 bg-success border rounded-circle" style="bottom: 0.2rem; left: 40px; font-size: 8pt">
                        </span>
                        <?php
                        }
                        ?>
                        
                    </div>
                    <div><?= getName($friend) ?></div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>