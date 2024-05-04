<?php
include("../../connection.php");
$id = $_GET['id'];
// echo $id;
$update_query = "UPDATE users SET status=0 WHERE id=$id";
mysqli_query($conn, $update_query);
header("location:./userlists.php");
