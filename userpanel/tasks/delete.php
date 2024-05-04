<?php
$id = $_GET['id'];
include("../../connection.php");
$delete_query = "UPDATE `dapf_tasks` SET `deleted_status`=1 WHERE id=$id";
mysqli_query($conn, $delete_query);
header("location:./delete_tasks.php");
