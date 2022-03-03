<?php
require '../head.php';

if ($user_level != 'admin') {
	session_destroy();
	header("Location: " . URL);
	exit();	
}