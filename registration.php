<?php
include("connection.php");
$emailValidationErr = " ";
$passwordValidationErr = " ";
if (isset($_POST['register'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $fullname = $_POST['fullname'];

  if (preg_match('/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/', $email)) {
    if (preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $password)) {
      $insertQuery = "INSERT INTO users(fullname, email, password) VALUES ('$fullname', '$email', '$password') ";
      $response = mysqli_query($conn, $insertQuery);
      header("location:./login.php");
    } else {
      $passwordValidationErr = "Password Format didn't matched";
    }
  } else {
    $emailValidationErr = "Email Format didn't matched";
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

<body style="background-color: #f5f2f2; display:flex; height:100vh; align-items:center; justify-content:center">

  <div class="p-5">
    <form action="" method="post" id="registrationForm">
      <h2 style="text-align: center;">Registration</h2>
      <div><label for="">Full Name</label> <input type="text" name="fullname" required /></div>
      <div><label for="">Email</label> <input name="email" type="email" required />
        <p class="error-color"><?php echo $emailValidationErr; ?></p>
      </div>
      <div class="position-relative"><label for="">Password</label>
        <input name="password" type="password" required id="password" />
        <img src="./icons/view.png" class="position-absolute cursor-pointer" id="registerShowPassword" alt="">
        <p class="error-color"><?php echo $passwordValidationErr ?></p>
      </div>
      <div><button name="register" class="w-100">Register</button></div>
      <div style="margin-top:25px;">
        or <a href="./login.php">Login?</a>
      </div>
    </form>

  </div>

</body>

</html>
<script>
  document.getElementById("registerShowPassword").addEventListener("click", function() {
    const password = document.getElementById('password');
    if (password.type == 'password') {
      password.type = "text"
      this.src = "./icons/hide.png"
    } else {
      password.type = "password";
      this.src = "./icons/view.png"
    }
  })
</script>