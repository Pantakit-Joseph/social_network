<?php
include "head.php";
$ment_id = $_GET['ment_id'];

$sql_d = "DELETE FROM `comment` WHERE ment_id='$ment_id'";
$conn->query("$sql_d");
goHome();
?>