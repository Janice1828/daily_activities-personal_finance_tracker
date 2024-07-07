<?php
include("../../connection.php");
$id = $_GET['id'];
$deleteQuery = "DELETE FROM dapf_notes WHERE id=$id";
mysqli_query($conn, $deleteQuery);
header("location:./note_lists.php");
