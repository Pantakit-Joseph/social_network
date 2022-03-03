<div class="card">
	<div class="card-header">
		<h5 class="card-title">โปรไฟล์ของฉัน</h5>
	</div>
	<div class="card-body">
		<div class="text-center">
			<img src="<?= getProfile($user) ?>" alt="" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
		</div>
		<hr>
		<p>
			ชื่อ: <?= getName($user) ?>
			<br>อีเมล: <?= $user['user_email'] ?>
			<br>เพศ: <?= $user['user_gender'] ?>
			<br>ประเทศ: <?= $user['user_country'] ?>
		</p>
	</div>
	<div class="card-footer">
		<div class="d-grid">
			<a href="#profile" class="btn btn-warning" data-bs-toggle="modal">แก้ไขโปรไฟล์</a>
		</div>
	</div>
</div>

<div class="modal fade" id="profile">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title">แก้ไขโปรไฟล์</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<p class="text-secondary">เปลี่ยนรูปภาพประจำตัว</p>
					<div class="text-center">
						<img src="<?= getProfile($user) ?>" alt="" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
					</div>
					<input type="file" name="pic" class="form-control mt-2" accept="image/*"> 
					<hr>

					<p class="text-secondary">แก้ไขข้อมูลส่วนตัว</p>
					<div class="input-group mt-3">
                        <input class="form-control" type="text" name="u_name" value="<?= $user['user_name'] ?>" required placeholder="ชื่อ">
                        <input class="form-control" type="text" name="u_lastname" value="<?= $user['user_lastname'] ?>" required placeholder="นามสกุล">
                    </div>
                    <div class="input-group mt-3">
                        <input class="form-control" type="email" name="u_email" value="<?= $user['user_email'] ?>" placeholder="อีเมล" disabled>
                    </div>
                    <div class="input-group mt-3">
                        <select class="form-select" name="u_gender">
                            <option><?= $user['user_gender'] ?></option>
                            <option>ชาย</option>
                            <option>หญิง</option>
                        </select>
                    </div>
                    <div class="input-group mt-3">
                        <select class="form-select" name="u_country">
                            <option><?= $user['user_country'] ?></option> 
                            <option>Thailand</option>
                            <option>United States</option>
                        </select>
                    </div>
                    <hr>

					<p class="text-secondary">เปลี่ยนรหัสผ่าน</p>
					<div class="input-group">
						<span class="input-group-text">
							<i class="fas fa-key"></i>
						</span>
						<input type="password" name="pass_old" class="form-control" placeholder="รหัสผ่านปัจจุบัน">
					</div>
					<div class="input-group mt-3">
						<span class="input-group-text">
							<i class="fas fa-key"></i>
						</span>
						<input type="password" name="pass_new" class="form-control" minlength="6" placeholder="รหัสผ่านใหม่">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="profile" class="btn btn-warning">แก้ไข</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php 
if (isset($_POST['profile'])) {
	if (repass()) {
		if (!empty($_FILES['pic']['name'])) {
			$name = pathinfo($_FILES['pic']['name']);
			$tmp_name = $_FILES['pic']['tmp_name'];
			$path = '/storage/profile_img/'.uniqid($user_id).'.'.$name['extension'];
			if (move_uploaded_file($tmp_name, __DIR__.$path)) {
				$sql_up = "UPDATE `users` SET `user_profile`='$path' WHERE `user_id`='$user_id'";
				$conn->query($sql_up);
			}
		}

		$sql_e = "UPDATE `users` SET `user_name`='{$_POST['u_name']}', `user_lastname`='{$_POST['u_lastname']}', `user_gender`='{$_POST['u_gender']}', `user_country`='{$_POST['u_country']}' WHERE `user_id`='$user_id'";
		$conn->query($sql_e);
		alert("success", "แก้ไขข้อมูลเรียบร้อย", getHome(), "สำเร็จ");
	}
}

function repass()
{
	global $user, $conn, $user_id;
	if (!empty($_POST['pass_new'])) {
		if (password_verify($_POST['pass_old'], $user['user_pass'])) {
			$pass = password_hash($_POST['pass_new'], PASSWORD_DEFAULT);
			$sql = "UPDATE `users` SET `user_pass`='$pass' WHERE `user_id`='$user_id'";
			if (!$conn->query($sql)) {
				alert("warning", "ไม่สามารถแก้ไขข้อมูลได้", getHome(), "เกิดข้อผิดพลาด");
				return false;
			}
		} else {
			alert("warning", "รหัสผ่านปัจจุบันไม่ถูกต้อง", getHome());
			return false; 
		}
	}
	return true;
}