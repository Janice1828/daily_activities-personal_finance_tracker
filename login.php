<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daily Activities & Personal Finance Tracker</title>
  <link rel="stylesheet" href="./style.css">
</head>
<div class="p-5">
  <form action="" method="post" id="loginForm">
    <div><label for="">Email</label> <input type="text" name="email" /></div>
    <div><label for="">Password</label> <input name="password" type="text" /></div>
    <div><button name="login">Login</button></div>
    <div>
      or <a href="./registration.php">register?</a>
    </div>
  </form>
</div>
<?php
session_start();
include("connection.php");
$tbl_name = "users";
if (isset($_POST["login"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $selectQuery = "SELECT email, password,usertype FROM $tbl_name where email='$email' && password='$password'";

  $execute = mysqli_query($conn, $selectQuery);
  $fetchedData = mysqli_fetch_assoc($execute);
  if ($fetchedData['email'] === $email && $fetchedData['password'] === $password && $fetchedData['usertype'] == "user") {
    header("location:./userpanel/dashboard.php");
    $_SESSION['fullname'] = $fetchedData['fullname'];
  } else if ($fetchedData['email'] === $email && $fetchedData['password'] === $password && $fetchedData['usertype'] == "admin") {
    header("location:./adminpanel/dashboard.php");
  } else {
    echo "login failed";
  }
}
?>

</html>