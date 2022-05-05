<?php
session_start();
// connection script
include_once('./lib/connect.php');
//delete operation

$deleteId = $_REQUEST['task'];
$delTask = "DELETE FROM task WHERE id='".$deleteId."'";
$pdo->prepare($delTask)->execute();
$delComment = "DELETE FROM comment WHERE task_id='".$deleteId."'";
$pdo->prepare($delComment)->execute();
header ('location:mytask.php');
?>

