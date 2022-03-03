<?php
include "head.php";
$post_id = $_GET['post_id'];

$sql_d = "DELETE FROM `post` WHERE post_id='$post_id'";
$conn->query("$sql_d");
goHome();
?>