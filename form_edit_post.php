<div class="dropdown float-end">
    <div data-bs-toggle="dropdown">
        <i class="fas fa-ellipsis-h"></i>
    </div>

    <ul class="dropdown-menu dropdown-menu-end">
        <li><a href="#edit<?= $a['post_id'] ?>" data-bs-toggle="modal" class="dropdown-item text-warning">แก้ไข</a></li>
        <li><a href="../del_post.php?post_id=<?= $a['post_id'] ?>" class="dropdown-item text-danger">ลบ</a></li>
    </ul>
</div>

<!-- Modal -->
<form method="post" enctype="multipart/form-data">
    <div class="modal fade" id="edit<?= $a['post_id'] ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขโพสต์</h5>
                    <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="text" name="edit_post" value="<?= $post_content ?>">
                    <div class="text-end">ลบภาพ</div>
                    <br>
                    <?php
                    $sql_img_post = "SELECT * FROM `post_image` WHERE`post_id`='$post_id'";
                    $quimg = $conn->query($sql_img_post);
                    while ($a_img = $quimg->fetch_assoc()) {
                        $post_img = $a_img['post_img'];
                        $id = $a_img['p_id'];
                    ?>
                    <div class="align-items-center">
                        <img src="<?= URL.$post_img ?>" class="mt-1" style="width: 40px; height: 40px; object-fit: cover;">
                        <!-- <div class="w-100"></div> -->
                        <input class="float-end" type="checkbox" name="del[]" multiple="multiple" value="<?= $id ?>">
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="modal-footer">
                <label for="post<?= $post_id ?>" class="btn btn-warning float-end me-2"><i class="fas fa-image"></i></label>
                <input type="file" name="pic[]" multiple="multiple" id="post<?= $post_id ?>" class="d-none">
                    <button name="edit_btn<?= $a['post_id'] ?>" type="submit" class="btn btn-warning">แก้ไข</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
if (isset($_POST['edit_btn' . $a['post_id']])) {

    // $post_id = $_GET['post_id'];
    $edit_post = $_POST['edit_post'];

    $sql_e = "UPDATE `post` SET `content_post`='$edit_post' WHERE post_id='$post_id'";
    $conn->query("$sql_e");

    if (isset($_POST['del'])){
        foreach ($_POST['del'] as $del) {
            $sql_del = "DELETE FROM `post_image` WHERE `p_id`='$del'";
            $conn->query("$sql_del");
        }
    }

    if (!empty($_FILES['pic']['name'][0])) {
    for ($i=0; $i < count($_FILES['pic']['name']); $i++) { 
            $name = pathinfo($_FILES['pic']['name'][$i]);
            $tmp_name = $_FILES['pic']['tmp_name'][$i];
            $path = '/storage/post_img/'.uniqid($user_id).'.'.$name['extension'];
            if (move_uploaded_file($tmp_name, __DIR__.$path)) {
                $sql_upp = "INSERT INTO `post_image`(`post_id`, `post_img`) VALUES ('$post_id','$path')";
                $conn->query($sql_upp);
            }
        }
    }
    goHome();
}

?>