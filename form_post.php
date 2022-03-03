<!-- <form method="post" action="test_post.php"enctype="multipart/form-data"> -->
<form method="post" enctype="multipart/form-data">
    <div class="card shadow">
        <div class="card">
            <div class="card-header">
                <h3>สร้างโพสต์ใหม่</h3>
            </div>
            <div class="card-body">
                <input class="form-control" type="text" name="post_text" placeholder="คุณคิดอะไรอยู่ <?= getName($user) ?>">

            </div>
            <div class="card-footer">

                <button name="post_btn" class="btn btn-warning float-end" type="submit"><i class="fas fa-paper-plane me-2"></i>โพสต์</button>
                <button type="button" class="btn btn-warning float-end me-2" data-bs-toggle="modal" data-bs-target="#input_img">
                    <i class="fas fa-image"></i>
                </button>
                <!-- <label for="post" class="btn btn-warning float-end me-2"><i class="fas fa-image"></i></label>
                <input type="file" name="pic[]" multiple="multiple" id="post" class="d-none"> -->
            </div>
            <!-- <input type="file" class="my-pond" name="filepond"/> -->
        </div>
    </div>

    <div class="modal fade" id="input_img">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <label for="inimgpost" class="modal-title">เลือกภาพ</label>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="file-loading">
                        <input id="inimgpost" name="pic[]" class="input-img" multiple type="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">
                        ตกลง
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
if (isset($_POST['post_btn']) &&  (!empty($_FILES['pic']['name'][0]) || !empty($_POST['post_text']))) {
    // echo '<pre>';
    // var_dump($_FILES['pic']);
    // echo '</pre>';
    // exit();
    $post_text = $_POST['post_text'];

    $sql_p = "INSERT INTO `post`(`user_id`, `content_post`, `date_post`) VALUES ('$user_id','$post_text',NOW())";
    if ($conn->query($sql_p)) {
        $post_id = $conn->insert_id;

        if (!empty($_FILES['pic']['name'][0])) {
            for ($i = 0; $i < count($_FILES['pic']['name']); $i++) {
                if (!empty($_FILES['pic']['name'][$i])) {
                    $name = pathinfo($_FILES['pic']['name'][$i]);
                    $tmp_name = $_FILES['pic']['tmp_name'][$i];
                    $path = '/storage/post_img/' . uniqid($user_id) . '.' . $name['extension'];
                    if (move_uploaded_file($tmp_name, __DIR__ . $path)) {
                        $sql_upp = "INSERT INTO `post_image`(`post_id`, `post_img`) VALUES ('$post_id','$path')";
                        $conn->query($sql_upp);
                    }
                }
            }
        }
    }
    goHome();
} elseif (isset($_POST['post_btn'])) {

    alert("warning", "ไม่มีรูปภาพ หรือ ข้อความ");
}
?>