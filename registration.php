<?php
include("header.php")
?>
<form action="" method="post">
  <div><label for="">Full Name</label> <input type="text" name="fullname" required /></div>
  <div><label for="">Email</label> <input name="email" type="email" required /></div>
  <div><label for="">Password</label> <input name="password" type="password" required /></div>
  <div><button name="register">Registration</button></div>
</form>
<?php
include("footer.php");
?>
<?php
include("connection.php");
if(isset($_POST['register'])){
$fullname=$_POST['fullname'];
$email=$_POST['email'];
$password=$_POST['password'];
$insertQuery="INSERT INTO users(fullname, email, password) VALUES ('$fullname', '$email', '$password') ";
$response=mysqli_query($conn, $insertQuery);
}

?>