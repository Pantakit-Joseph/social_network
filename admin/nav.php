<?php
$sql_rq = "SELECT * FROM `users` WHERE `user_level`='request' ORDER BY `user_id` DESC";
$sql_cc = "SELECT * FROM `users` WHERE `user_level`='cancel' ORDER BY `user_id` DESC";

$qr_rq = $conn->query($sql_rq);
$qr_cc = $conn->query($sql_cc);
?>
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
	<div class="container-sm">
		<a href="home.php" class="navbar-brand">
			<b>
				SOCIAL <span class="text-warning">NETWORK</span>
			</b>
		</a>

		<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-between" id="menu">
			<form action="search.php" method="post">
				<div class="input-group">
					<input type="text" name="search" id="" class="form-control" autocomplete="off" placeholder="ค้นหา">
					<button type="submit" class="btn btn-warning">
						<i class="fas fa-search"></i>
					</button>
				</div>
			</form>

			<ul class="navbar-nav">
				<li class="nav-item me-2">
					<a href="" class="nav-link active"><?= getName($user) ?></a>
				</li>
				<li class="nav-item mx-2">
					<a href="home.php" class="nav-link">หน้าหลัก</a>
				</li>
				<li class="nav-item mx-2">
					<div class="dropdown">
						<a class="nav-link" data-bs-toggle="dropdown">
							<i class="fas fa-user-plus"></i>
							<span class="badge rounded-pill bg-danger position-absolute top-0 opacity-75">
								<?= $qr_rq->num_rows ?>
							</span>
						</a>

						<ul class="dropdown-menu dropdown-menu-end">
							<?php while ($rq = $qr_rq->fetch_assoc()) { ?>
							<li class="px-3 py-2">
								<div class="d-flex align-items-center gap-2" style="width: 400px;">
									<div class="" style="width: 50px;">
										<img src="<?= getProfile($rq) ?>" alt="" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
									</div>
									<div class="w-100"><?= getName($rq) ?></div>
									<a href="approve.php?i=1&id=<?= $rq['user_id'] ?>" class="btn btn-sm btn-warning">อนุมัติ</a>
									<a href="approve.php?i=0&id=<?= $rq['user_id'] ?>" class="btn btn-sm btn-danger">ยกเลิก</a>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
				</li>
				<li class="nav-item mx-2">
					<div class="dropdown">
						<a class="nav-link" data-bs-toggle="dropdown">
							<i class="fas fa-user-slash"></i>
							<span class="badge rounded-pill bg-danger position-absolute top-0 opacity-75">
								<?= $qr_cc->num_rows ?>
							</span>
						</a>

						<ul class="dropdown-menu dropdown-menu-end">
							<?php while ($cc = $qr_cc->fetch_assoc()) { ?>
							<li class="px-3 py-2">
								<div class="d-flex align-items-center gap-2" style="width: 400px;">
									<div class="" style="width: 50px;">
										<img src="<?= getProfile($cc) ?>" alt="" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
									</div>
									<div class="w-100"><?= getName($cc) ?></div>
									<a href="approve.php?i=1&id=<?= $cc['user_id'] ?>" class="btn btn-sm btn-warning">อนุมัติ</a>
									<a href="approve.php?i=2&id=<?= $cc['user_id'] ?>" class="btn btn-sm btn-danger">ลบ</a>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
				</li>

				<li class="nav-item ms-4">
					<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#logout">
						ออกจากระบบ
					</button>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div class="modal fade" id="logout">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-warning">ออกจากระบบ</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<div class="alert alert-warning m-0">
					คุณต้องการออกจากระบบหรือไม่
				</div>
			</div>
			<div class="modal-footer">
				<a href="../logout.php" class="btn btn-warning">ใช่</a>
				<button class="btn btn-secondary ms-2" data-bs-dismiss="modal">ไม่</button>
			</div>
		</div>
	</div>
</div>