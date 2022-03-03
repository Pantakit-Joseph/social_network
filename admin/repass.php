<?php 
	require 'head.php';

	$id = $_GET['id'];
	$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
	$sql = "UPDATE `users` SET `user_pass`='{$pass}' WHERE `user_id`='{$id}'";
	$conn->query($sql);

	goHome();