<?php
session_start();
require 'connect/db.php';
require 'helper.php';

if (empty($_SESSION['user_id'])) {
	session_destroy();
	header("Location: " . URL);
	exit();	
}

$user_id = $_SESSION['user_id'];
$qr_user = $conn->query(
	"SELECT * FROM `users` WHERE `user_id`='{$user_id}'"
);
$user = $qr_user->fetch_assoc();

$user_level = $user['user_level'];