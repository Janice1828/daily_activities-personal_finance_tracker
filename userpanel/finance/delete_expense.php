<?php
$id = $_GET['id'];
include("../../connection.php");
$deleteQuery = "DELETE FROM dapf_expense WHERE id='$id'";
mysqli_query($conn, $deleteQuery);
header("location:./view_expense.php");
