<?php
include("../../connection.php");
$id = $_GET['id'];
print_r($id);
$new_status = "completed";
echo $new_status;
$tblName = "dtpf_tasks";
$query = "UPDATE `dtpf_tasks` SET `status` = 'completed' WHERE `dtpf_tasks`.`id`= $id";
mysqli_query($conn, $query);
header("location:completed_task.php");
