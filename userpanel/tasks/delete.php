<?php
$id = $_GET['id'];
include("../../connection.php");
$delete_query = "DELETE FROM dapf_tasks WHERE id=$id";
mysqli_query($conn, $delete_query);
header("location:./delete_tasks.php");
