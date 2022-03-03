<?php 
require 'head.php';

$i = $_GET['i'];
$uid = $_GET['uid'];
$fid = $_GET['fid'];

switch ($i) {
	case '0':
		$sql = "DELETE FROM `friends` WHERE (`friend_id`='$uid' AND `user_id`='$fid') OR (`friend_id`='$fid' AND `user_id`='$uid')";
		break; 
	case '1':
		$sql = "UPDATE `friends` SET `accept`='1' WHERE `friend_id`='$fid' AND `user_id`='$uid'";
		break; 
	case '2':
		$sql = "INSERT INTO `friends`(`friend_id`, `user_id`, `accept`) VALUES ('$fid', '$uid', 0)";
		break;
}
$conn->query($sql);
goHome();
