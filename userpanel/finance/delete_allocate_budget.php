<?php
$id = $_GET['id'];
// echo $id;
include("../../connection.php");
$deleteQuery = "DELETE FROM dapf_allocatebudget WHERE id='$id'";
mysqli_query($conn, $deleteQuery);
header("location:./view_allocatedbudget.php");
