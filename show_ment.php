<?php
$sql_sm = "SELECT * FROM comment,users WHERE comment.user_id = users.user_id AND comment.post_id='$post_id' ORDER BY comment.date_ment DESC";
$qum = $conn->query($sql_sm);
while ($am = $qum->fetch_assoc()) {
    $ment_content = $am['content_ment'];
    $u_name = $am['user_name'];
    $u_lastname = $am['user_lastname'];
    $ment_id = $am['ment_id'];
    $user_profile = $am['user_profile'];
    $ment_date = $am['date_ment'];
    // $ment_id = $am['ment_id'];
?>
    <div class="card mt-4 shadow">
        <div class="card-body">
            <?php
            if ($user_level == 'admin') {
                include "form_edit_ment.php";
            } elseif ($user_id == $am['user_id']) {
                include "form_edit_ment.php";
            }
            ?>
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <img src="<?= URL . $user_profile ?>" class="rounded-circle" style="width: 40px; height: 40px;">
                </div>
                <div class="flex-grow-1 ms-2 lh-1">
                    <?= getName($am) ?><br>
                    <span style="font-size: 8px"><?= $ment_date ?></span>
                </div>
            </div>

            <div class="ms-5 mt-2">
                <?= $ment_content; ?>
                <br>
                <?php
                $sql_img_ment = "SELECT * FROM `ment_image` WHERE `ment_id`='$ment_id'";
                $ooo = $conn->query($sql_img_ment);
                while ($am_img = $ooo->fetch_assoc()) {
                    $ment_img = $am_img['ment_img'];
                ?>
                    <img src="<?= URL . $ment_img ?>" class="mt-1" style="width: 100px; height: 100px; object-fit: cover;">
                <?php
                }
                ?>
            </div>
        </div>

    </div>
<?php
}
?>