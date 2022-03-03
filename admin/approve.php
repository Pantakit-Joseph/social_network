<?php 
require 'head.php';
$i = $_GET['i'];
$id = $_GET['id'];

switch ($i) {
	case '0':
		$sql = "UPDATE `users` SET `user_level`='cancel' WHERE `user_id`='$id'";
		break;
	case '1':
		$sql = "UPDATE `users` SET `user_level`='user' WHERE `user_id`='$id'";
		break;
	case '2':
		$sql = "DELETE FROM `users` WHERE `user_id`='$id'";
		break;
}

$conn->query($sql);
goHome();