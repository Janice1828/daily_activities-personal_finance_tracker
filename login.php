<?php include("header.php") ?>
<form action="" method="post">
  <div><label for="">Email</label> <input type="text" name="email" /></div>
  <div><label for="">Password</label> <input name="password" type="text" /></div>
  <div><button name="login">Login</button></div>
</form>

<?php include("footer.php") ?>

<?php
session_start();
include("connection.php");
$tbl_name="users";
if(isset($_POST["login"])){
  $email = $_POST["email"];
  $password = $_POST["password"];
  $selectQuery="SELECT * FROM $tbl_name where email='$email' && password='$password'";
 
  $execute=mysqli_query($conn, $selectQuery);
 $fetchedData=mysqli_fetch_assoc($execute);
if($fetchedData['email']===$email && $fetchedData['password']===$password){
  header("location:dashboard.php");
  $_SESSION['fullname']=$fetchedData['fullname'];
}else{
  echo "login failed";  
}
 
}
?>