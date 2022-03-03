<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('URL', 'http://127.0.0.1/social_network/');

function SAlert($msg)
{
	echo "<script>alert(\"$msg\")</script>";
}

function redirect($url)
{
	echo "<script>window.location.href = \"$url\"</script>";
}

function getHome()
{
	global $user;
	if ($user['user_level'] == 'admin') {
		return URL . 'admin/home.php';
	} else {
		return URL . 'user/home.php';
	}
}

function goHome()
{
	redirect(getHome());
}

function getName($user)
{
	return $user['user_name'] . ' ' . $user['user_lastname'];
}

function getProfile($user)
{
	return URL . $user['user_profile'];
}

include 'alert.php';