<?php
session_start();

?>
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
    <h2 style="text-align:center">Login Form</h2>

    <div><label for="">Email</label> <input type="text" name="email" /></div>
    <div><label for="">Password</label> <input name="password" type="text" /></div>
    <div><button name="login">Login</button></div>
    <div>
      or <a href="./registration.php">register?</a>
    </div>
  </form>
</div>
<?php
include("connection.php");
$tbl_name = "users";
try {
  if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $selectQuery = "SELECT id, email, password,usertype FROM $tbl_name where email='$email' && password='$password'";
    $execute = mysqli_query($conn, $selectQuery);
    $fetchedData = mysqli_fetch_assoc($execute);
    if ($fetchedData['email'] === $email && $fetchedData['password'] === $password && $fetchedData['usertype'] == "user") {
      $_SESSION['logged_in'] = "true";
      $_SESSION['user_id'] = $fetchedData['id'];
      header("location:./userpanel/dashboard.php");
      $_SESSION['fullname'] = $fetchedData['fullname'];
    } else if ($fetchedData['email'] === $email && $fetchedData['password'] === $password && $fetchedData['usertype'] == "admin") {
      $_SESSION['user_id'] = $fetchedData['id'];
      header("location:./adminpanel/dashboard.php");
    } else {
      echo "login failed";
    }
  }
} catch (Exception $e) {
  echo $e->getMessage();
}
?>

</html>