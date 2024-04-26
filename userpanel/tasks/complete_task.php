<?php
include("../../connection.php");
$id = $_GET['id'];
$status = "completed";
$tblName = "dtpf_tasks";
$query = "UDPATE $tblName SET status='$status' WHERE id=$id";
mysqli_query($conn, $query);
// header("location:./completed_task.php");
