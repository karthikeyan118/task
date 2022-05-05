<?php
include_once('./lib/connect.php');
$id = $_REQUEST['tasknum'];
$status = $_REQUEST['status'];
$stmt = $pdo->query("UPDATE task SET status = '".$status."' WHERE id=".$id."");
header('location:dashboard.php');
?>