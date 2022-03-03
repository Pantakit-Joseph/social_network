<?php 
$conn = new mysqli('127.0.0.1', 'root', 'root', 'social_net');
if ($conn->connect_error) {
	die($conn->connect_error);
}

$conn->set_charset('utf8mb4');
