<?php
include("../connection.php");
$fetch_motives_query = "SELECT image, title, content FROM dapf_motives";
$fetch_motives = mysqli_query($conn, $fetch_motives_query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="../style.css" />
</head>

<body>
  <nav class="d-flex position-sticky justify-content-between">
    <img src="../images/logo.jpeg" alt="Logo" id="logo" />
    <ul class="nav-links">
      <li>
        <a href="#home" class="active">Home</a>
      </li>

      <li>
        <a href="#motives">Motives</a>
      </li>
      <li>
        <a href="#contactus">Contact Us</a>
      </li>
    </ul>
    <div class="d-flex gap-2">
      <a href="../registration.php" id="register">Sign Up</a>
      <a href="../login.php" id="login">Sign In</a>
    </div>
  </nav>
  <div class="container">
    <div class="position-relative" id="home">
      <div id="bannerImg"></div>
      <h1 class="banner-slogan">
        Empower Your Every Day,<br />
        Manage Your Money the Smart Way!
      </h1>
    </div>
    <div class="main-content">
      <div class="row gx-4 gy-2" id="motives">
        <div class="col-12">
          <h1>Our Motives</h1>
        </div>
        <?php while ($row = mysqli_fetch_assoc($fetch_motives)) { ?>
          <div class="col-6">
            <div class="card">
              <div class="card-body">
                <img src="../images/<?php echo $row['image'] ?>" alt="Motive 1" />
                <div class="card-content">
                  <h3 class="pb-1"><?php echo $row['title'] ?></h3>
                  <p>
                    <?php echo $row['content'] ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
      <!-- <div class="services">
          <div class="row" style="column-gap: 37px; row-gap: 20px">
            <h1 class="col-12">Services</h1>
            <div class="services-card col-4">
              <div class="services-card-body">
                <img src="../images/motive_three.jpg" alt="" />
                <div class="services-card-content">
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                  Quibusdam, facere?
                </div>
              </div>
            </div>
            <div class="services-card col-4">
              <div class="services-card-body">
                <img src="../images/motive_three.jpg" alt="" />
                <div class="services-card-content">
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                  Quibusdam, facere?
                </div>
              </div>
            </div>

            <div class="services-card col-4">
              <div class="services-card-body">
                <img src="../images/motive_three.jpg" alt="" />
                <div class="services-card-content">
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                  Quibusdam, facere?
                </div>
              </div>
            </div>
          </div>
        </div> -->

    </div>
    <div class="contact-us" id="contactus">
      <div class="row align-items-center">
        <h1 class="col-12 text-center contact-us-title">Contact us</h1>
        <div class="col-5 justify-content-center d-flex">
          <div class="contact-us-details">
            <div class="d-flex gap-1 align-items-center">
              <img src="../icons/location.png" alt="" />
              <p>Imadol, Lalitpur, Nepal</p>
            </div>
            <div class="d-flex gap-1 align-items-center">
              <img src="../icons/telephone.png" alt="" />
              <p>+977 9812345678</p>
            </div>
            <div class="d-flex gap-1 align-items-center">
              <img src="../icons/email.png" alt="" />
              <p>test@gmail.com</p>
            </div>
          </div>
        </div>
        <div class="col-7">
          <form action="#" method="post" class="row send-message-form gx-4">
            <div class="col-6">
              <input type="text" placeholder="Name" name="name" />
            </div>
            <div class="col-6">
              <input type="number" placeholder="Phone" name="phone" />
            </div>
            <div class="col-12">
              <input type="email" placeholder="Email Address" name="email" />
            </div>
            <div class="col-12">
              <textarea id="" placeholder="Message" rows="7" name="message"></textarea>
            </div>
            <div class="col-12">
              <button class="" name="send_message">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <footer class="row">
    <div class="col-4 d-flex justify-content-center">
      <div>
        <h3>Shortcut Links</h3>
        <a href="#" class="home-shortcut-links footer-links">Home</a>
        <a href="#" class="home-shortcut-links footer-links">About Us</a>
        <a href="#" class="home-shortcut-links footer-links">Services</a>
        <a href="#" class="home-shortcut-links footer-links">Contact Us</a>
      </div>
    </div>
    <div class="col-4 d-flex justify-content-center">
      <div>
        <h3>Our Motives</h3>
        <p class="footer-links">Aids in Saving Money</p>
        <p class="footer-links">Lifestyle Awareness</p>
        <p class="footer-links">Time Management and Productivity</p>
        <p class="footer-links">Tracks Spending Habits</p>
      </div>
    </div>
    <div class="col-4 d-flex justify-content-center">
      <div>
        <h3>Additional Activities</h3>
        <p class="footer-links">Help</p>
        <p class="footer-links">About us</p>
      </div>
    </div>
  </footer>
</body>

</html>
<?php
include("../connection.php");
if (isset($_POST['send_message'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $message = $_POST['message'];
  $message_insert_query = "INSERT INTO dapf_messages(name, email, phone, message) VALUES ('$name','$email','$phone','$message')";
  mysqli_query($conn, $message_insert_query);
}

?>