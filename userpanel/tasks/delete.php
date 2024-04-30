<?php
$id = $_GET['id'];
echo $id;
include("../../connection.php");
$delete_query = "UPDATE `dtpf_tasks` SET `deleted_status`=1 WHERE id=$id";
mysqli_query($conn, $delete_query);
header("location:./view_tasks.php");
