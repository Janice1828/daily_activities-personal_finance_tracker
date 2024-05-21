<?php
$id = $_GET['id'];
include("../../connection.php");
$delete_query = "DELETE FROM dapf_monthlyincome WHERE id=$id";
mysqli_query($conn, $delete_query);
header("location:./view_monthly_income.php");
