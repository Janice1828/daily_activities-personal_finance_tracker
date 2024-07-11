<?php
include('../../connection.php');
$id = $_GET['id'];
$deleteQuery = "DELETE FROM dapf_income WHERE id='$id'";
mysqli_query($conn, $deleteQuery);
header("location:./view_income.php");
