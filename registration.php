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
    <form action="" method="post" id="registrationForm">
      <h2 style="text-align: center;">Registration</h2>
      <div><label for="">Full Name</label> <input type="text" name="fullname" required /></div>
      <div><label for="">Email</label> <input name="email" type="email" required /></div>
      <div><label for="">Password</label> <input name="password" type="password" required /></div>
      <div><button name="register">Registration</button></div>
      <div>
        or <a href="./login.php">Login?</a>
      </div>
    </form>

  </div>
  <?php
  include("connection.php");
  if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $insertQuery = "INSERT INTO users(fullname, email, password) VALUES ('$fullname', '$email', '$password') ";
    $response = mysqli_query($conn, $insertQuery);
    header("location:./login.php");
  }

  ?>
</body>

</html>