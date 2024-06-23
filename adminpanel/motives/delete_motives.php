<?php
include("../../connection.php");
$id = $_GET['id'];
$deleteQuery = "DELETE FROM dapf_motives WHERE id=$id";
mysqli_query($conn, $deleteQuery);
header("location:./motives_list.php");
