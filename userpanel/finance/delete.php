<?php
include("../../connection.php");
$id = $_GET['id'];
$deleteQuery = "UPDATE `dapf_finance` SET `dapf_finance`.`deleted_status`=1 WHERE id=$id";
mysqli_query($conn, $deleteQuery);
header("location:delete_finance.php");
