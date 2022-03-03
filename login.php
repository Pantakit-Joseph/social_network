<!-- <div class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div> -->

<div class="modal fade" id="login">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<form action="" method="post">
				<div class="modal-header">
					<h5 class="modal-title">เข้าสู่ระบบ</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="input-group">
						<span class="input-group-text">
							<i class="fas fa-envelope"></i>
						</span>
						<input type="email" name="email" class="form-control" placeholder="อีเมล" required>
					</div>
					<div class="input-group mt-3">
						<span class="input-group-text">
							<i class="fas fa-key"></i>
						</span>
						<input type="password" name="pass" class="form-control" placeholder="รหัสผ่าน" required>
					</div>
				</div>
				<div class="modal-footer">
					<div class="d-grid col-12">
						<button type="submit" name="login" class="btn btn-warning">
							เข้าสู่ระบบ
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php 
if (isset($_POST['login'])) {
	$qr_user = $conn->query(
		"SELECT * FROM `users` WHERE `user_email`='{$_POST['email']}'"
	);
	$user = $qr_user->fetch_assoc();

	if (isset($user)) {
		if (password_verify($_POST['pass'], $user['user_pass'])) {
			switch ($user['user_level']) {
				case 'request':
					alert('warning', "บัญชีอยู่ระหว่างการรออนุมัติ", URL);
					break;
				case 'cancel':
					alert('warning', "บัญชีถูกระงับการใช้งาน", URL);
					break;
				default:
					$_SESSION['user_id'] = $user['user_id'];
					goHome();
					break;
			}
		} else {
			alert('warning', "รหัสผ่านไม่ถูกต้อง", URL);
		}
		
	} else {
		alert('warning', "ไม่พบอีเมล {$_POST['email']} ในระบบ", URL);
	}
	
}