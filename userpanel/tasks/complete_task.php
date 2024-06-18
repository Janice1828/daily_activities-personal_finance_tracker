<?php
include("../../connection.php");
$id = $_GET['id'];
print_r($id);
$tblName = "dapf_tasks";
$query = "UPDATE `dapf_tasks` SET `status` = 'completed' WHERE `dapf_tasks`.`id`= $id";
mysqli_query($conn, $query);
header("location:./view_tasks.php");
