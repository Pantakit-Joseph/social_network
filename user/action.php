<?php
require '../head.php';

$time = time();
$query = $conn->query("
    UPDATE `users` SET `online_time`='$time' WHERE `user_id`='$user_id'
");

if ($query) {
    echo $time;
}