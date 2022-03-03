<div class="dropdown float-end">
    <div data-bs-toggle="dropdown">
        <i class="fas fa-ellipsis-h"></i>
</div>

    <ul class="dropdown-menu dropdown-menu-end">
                <li><a href="#edit<?= $am['ment_id'] ?>" data-bs-toggle="modal" class="dropdown-item text-warning">แก้ไข</a></li>
                <li><a href="../del_ment.php?ment_id=<?= $am['ment_id'] ?>" class="dropdown-item text-danger">ลบ</a></li> 
    </ul>
</div>

<!-- Modal -->
<form method="post" enctype="multipart/form-data">
    <div class="modal fade" id="edit<?= $am['ment_id'] ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขโพสต์</h5>
                    <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="text" name="edit_ment" value="<?= $ment_content ?>">
                    <div class="text-end">ลบภาพ</div>
                    <br>
                    <?php
                    $sql_img_ment = "SELECT * FROM `ment_image` WHERE`ment_id`='$ment_id'";
                    $qumimg = $conn->query($sql_img_ment);
                    while ($am_img = $qumimg->fetch_assoc()) {
                        $ment_img = $am_img['ment_img'];
                        $id = $am_img['m_id'];
                    ?>
                    <div class="align-items-center">
                        <img src="<?= URL.$ment_img ?>" class="mt-1" style="width: 40px; height: 40px; object-fit: cover;">
                        <!-- <div class="w-100"></div> -->
                        <input class="float-end" type="checkbox" name="del[]" multiple="multiple" value="<?= $id ?>">
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="modal-footer">
                <label for="ment<?= $ment_id ?>" class="btn btn-warning float-end me-2"><i class="fas fa-image"></i></label>
                <input type="file" name="pic[]" multiple="multiple" id="ment<?= $ment_id ?>" class="d-none">
                    <button name="edit_btn<?= $am['ment_id'] ?>" type="submit" class="btn btn-warning">แก้ไข</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
if (isset($_POST['edit_btn'.$am['ment_id']])) {

    // $ment_id = $_GET['ment_id'];
   $edit_ment = $_POST['edit_ment'];

   $sql_e = "UPDATE `comment` SET `content_ment`='$edit_ment' WHERE ment_id='$ment_id'";
    $conn->query("$sql_e");
    if (isset($_POST['del'])){
        foreach ($_POST['del'] as $del) {
            $sql_del = "DELETE FROM `ment_image` WHERE `m_id`='$del'";
            $conn->query("$sql_del");
        }
    }

    if (!empty($_FILES['pic']['name'][0])) {
    for ($i=0; $i < count($_FILES['pic']['name']); $i++) { 
            $name = pathinfo($_FILES['pic']['name'][$i]);
            $tmp_name = $_FILES['pic']['tmp_name'][$i];
            $path = '/storage/ment_img/'.uniqid($user_id).'.'.$name['extension'];
            if (move_uploaded_file($tmp_name, __DIR__.$path)) {
                $sql_upp = "INSERT INTO `ment_image`(`ment_id`, `ment_img`) VALUES ('$ment_id','$path')";
                $conn->query($sql_upp);
            }
        }
    }
    goHome();
}

?>