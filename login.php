<?php
session_start();
include("connection.php");
$tbl_name = "users";
$invalidUserErr = "";
if (isset($_POST["login"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $selectQuery = "SELECT id,fullname, status, email, password,usertype FROM $tbl_name where email='$email' && password='$password'";
  $execute = mysqli_query($conn, $selectQuery);
  $fetchedData = mysqli_fetch_assoc($execute);
  if ($fetchedData) {
    if ($fetchedData['email'] === $email && $fetchedData['password'] === $password &&  $fetchedData['usertype'] == "user") {
      if ($fetchedData['status'] == 1) {
        $_SESSION['logged_in'] = "true";
        $_SESSION['user_id'] = $fetchedData['id'];
        $_SESSION['fullname'] = $fetchedData['fullname'];
        header("location:./userpanel/dashboard.php");
      } else {
        $invalidUserErr = "User Not Found!";
      }
    } else if ($fetchedData['email'] === $email && $fetchedData['password'] === $password && $fetchedData['usertype'] == "admin") {
      $_SESSION['user_id'] = $fetchedData['id'];
      $_SESSION['fullname'] = $fetchedData['fullname'];
      header("location:./adminpanel/dashboard.php");
    }
  } else {
    $invalidUserErr = "User Not Found!";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daily Activities & Personal Finance Tracker</title>
  <link rel="stylesheet" href="./style.css">
</head>

<body style="background-color: #adadad; display:flex; height:100vh; align-items:center; justify-content:center">
  <div class="p-5">
    <form action="" method="post" id="loginForm">
      <h2 style="text-align:center">Login</h2>

      <div><label for="">Email</label> <input type="email" name="email" required /></div>
      <div class="position-relative"><label for="">Password</label> <input name="password" type="password" id="password" required /><span class="position-absolute cursor-pointer" id="loginShowPassword">Show</span></div>
      <div><button name="login">Login</button></div>
      <div class="invalid-user-error-displayer">
        <p id="invalid-userErr"><?php echo $invalidUserErr; ?></p>
      </div>
      <div>
        or <a href="./registration.php">register?</a>
      </div>
    </form>
  </div>

</body>

</html>
<script>
  document.getElementById("loginShowPassword").addEventListener("click", function() {
    const password = document.getElementById('password');
    if (password.type == 'password') {
      password.type = "text"
      this.innerHTML = "Hide"
    } else {
      password.type = "password";
      this.innerHTML = "Show"
    }
  })
</script>