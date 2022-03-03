<?php
if ($user_level == 'admin') {
    $sql_sp = "SELECT * FROM post,users WHERE post.user_id = users.user_id ORDER BY post.date_post DESC";
} else {
    $sql_sp = "SELECT * FROM post JOIN users ON post.user_id = users.user_id WHERE post.user_id IN
    (SELECT friends.friend_id FROM friends WHERE friends.user_id='$user_id' AND friends.accept='1') OR post.user_id IN
    (SELECT friends.user_id FROM friends WHERE friends.friend_id='$user_id' AND friends.accept='1') OR post.user_id='$user_id' OR users.user_level='admin' ORDER BY post.date_post DESC";
}
$qu = $conn->query($sql_sp);
while ($a = $qu->fetch_assoc()) {
    $post_content = $a['content_post'];
    $u_name = $a['user_name'];
    $u_lastname = $a['user_lastname'];
    $post_id = $a['post_id'];
    $user_profile = $a['user_profile'];
    $post_date = $a['date_post'];
    // $post_id = $a['post_id'];
?>
    <div class="card mt-4 shadow">
        <div class="card-header">
            <?php
            if ($user_level == 'admin') {
                include "../form_edit_post.php";
            } elseif ($user_id == $a['user_id']) {
                include "../form_edit_post.php";
            }
            ?>
            <!-- <img src="<?= URL . $user_profile ?>" class="rounded-circle" style="width: 40px; height: 40px;">
            <?php if ($a['user_level'] == 'admin') {
                echo  getName($a); ?> <span class="float-end">👑</span>
            <?php
            } else {
                echo getName($a);
            }  ?>
            <p style="font-size: 8px"><?= $post_date ?></p> -->

            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <img src="<?= URL . $user_profile ?>" class="rounded-circle" style="width: 40px; height: 40px;">
                </div>
                <div class="flex-grow-1 ms-2 lh-1">
                    <?php if ($a['user_level'] == 'admin') {
                        echo  getName($a); ?> <span class="float-end">👑</span>
                    <?php
                    } else {
                        echo getName($a);
                    }  ?>
                    <br>
                    <span style="font-size: 8px"><?= $post_date ?></span>
                </div>
            </div>

        </div>
        <div class="card-body">
            <?= $post_content; ?>
            <br>
            <?php
            $sql_img_post = "SELECT * FROM `post_image` WHERE`post_id`='$post_id'";
            $quimg = $conn->query($sql_img_post);
            while ($a_img = $quimg->fetch_assoc()) {
                $post_img = $a_img['post_img'];
            ?>
                <img src="<?= URL . $post_img ?>" class="mt-1" style="width: 100px; height: 100px; object-fit: cover;">
            <?php
            }
            ?>
        </div>

        <div class="card-footer">
            <form method="post" enctype="multipart/form-data">
                <button class="btn btn-warning rounded-circle float-end" name="ment_btn<?= $post_id ?>" type="submit"><i class="fas fa-paper-plane"></i></button>
                <label for="ment<?= $post_id ?>" class="btn btn-warning rounded-circle float-end me-2"><i class="fas fa-image"></i></label>
                <input type="file" name="pic[]" multiple="multiple" id="ment<?= $post_id ?>" class="d-none">
                <input class="form-control w-50" type="text" name="ment_text" placeholder="แสดงความคิดเห็น">
            </form>
            <?php include "show_ment.php"; ?>
        </div>
    </div>


    <?php
    if (isset($_POST['ment_btn' . $post_id]) &&  (!empty($_FILES['pic']['name'][0]) || !empty($_POST['ment_text']))) {
        $ment_text = $_POST['ment_text'];

        $sql_m = "INSERT INTO `comment`(`post_id`, `user_id`, `content_ment`, `date_ment`) VALUES ('$post_id','$user_id','$ment_text',NOW())";
        if ($conn->query($sql_m)) {

            $ment_id = $conn->insert_id;

            if (!empty($_FILES['pic']['name'][0])) {
                for ($i = 0; $i < count($_FILES['pic']['name']); $i++) {
                    $name = pathinfo($_FILES['pic']['name'][$i]);
                    $tmp_name = $_FILES['pic']['tmp_name'][$i];
                    $path = '/storage/ment_img/' . uniqid($user_id) . '.' . $name['extension'];
                    if (move_uploaded_file($tmp_name, __DIR__ . $path)) {
                        $sql_upm = "INSERT INTO `ment_image`(`ment_id`, `ment_img`) VALUES ('$ment_id','$path')";
                        $conn->query($sql_upm);
                    }
                }
            }
        }
        goHome();
    } elseif (isset($_POST['ment_btn' . $post_id])) {

        alert("warning", "ไม่มีรูปภาพ หรือ ข้อความ");
    }
    ?>
<?php
}
?>