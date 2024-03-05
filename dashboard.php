<?php 
include("header.php");
?>

<div>
Welcome
    <?php 
    session_start();
    echo $_SESSION['fullname'];

    ?>
</div>
<?php 
include('footer.php');
?>