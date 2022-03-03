<?php
require '../head.php';

if ($user_level != 'user') {
	session_destroy();
	header("Location: " . URL);
	exit();	
}
