<?php
session_start();
include("../../connection.php");
$id = $_SESSION['user_id'];
$date = date("Y-m-d");
$insertQuery = "INSERT INTO dapf_tasks (user_id,date, task_name, task_due_date, importance, status,summary,deleted_status)
 VALUES('$id','$date','Do not Use Mobile','$date','Critical','new task','',0),('$id','$date','Do not sleep in day','$date','Critical','new task','',0),('$id','$date','Bath','$date','Critical','new task','',0)";
mysqli_query($conn, $insertQuery);
header("location:./view_tasks.php");
