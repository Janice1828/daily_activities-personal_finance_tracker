  <?php
  session_start();
  include("./../connection.php");
  $id = $_SESSION['user_id'];
  $getDetails = "SELECT fullname, email, profile FROM users WHERE id=$id";
  $res = mysqli_query($conn, $getDetails);
  $data = mysqli_fetch_assoc($res);
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daily Activities & Personal Finance Tracker</title>
    <link rel="stylesheet" href="./../style.css" />
  </head>

  <body>
    <div class="row">
      <div class="col-2">
        <div class="sidebar d-flex flex-column gap-1">
          <h5><a href="./dashboard.php" class="sidebar-heading d-flex align-items-center gap-1"><img src="./../images/dashboard.png" class="sidebar-logo"> <span>Dashboard</span></a></h5>
          <div class="sidebar-activities">
            <h5 class="sidebar-heading cursor-pointer d-flex justify-content-between align-items-center" onclick="toggleMaster()">
              <div class="d-flex align-items-center gap-1">
                <img src="./../icons/master.png" class="sidebar-logo" alt="">
                <span>Master</span>
              </div>
              <img src="./../icons/arrow_down.png" class="sidebar-logo" id="master-toggle-img" alt="">
            </h5>
            <ul style="padding-left:30px; display:none" id="master-lists">
              <li><a href="./importances/view_importances.php">Importances</a></li>
            </ul>
            <h5 class="pt-1 sidebar-heading cursor-pointer d-flex justify-content-between align-items-center" onclick="toggleUsers()">
              <div class=" d-flex align-items-center gap-1">
                <img src="./../icons/users.png" class="sidebar-logo" alt="">
                <span>Manage Users</span>
              </div>
              <img src="./../icons/arrow_down.png" class="sidebar-logo" id="user-toggle-img" alt="">
            </h5>
            <ul style=" padding-left:30px; display:none" id="user-lists">
              <li><a href="./manage_user/userlists.php" class="active-sidebar">User Lists</a></li>
            </ul>
            <h5 class="sidebar-heading cursor-pointer pt-1 d-flex justify-content-between align-items-center" onclick="toggleMotives()">
              <div class="d-flex align-items-center gap-1">
                <img src="./../icons/motives.png" class="sidebar-logo" alt="">
                <span>Motives</span>
              </div>
              <img src="./../icons/arrow_down.png" class="sidebar-logo" id="motives-toggle-img" alt="">
            </h5>
            <ul style="padding-left:30px; display:none" id="motive-lists">
              <li><a href="../motives/add_motives.php">Add Motives</a></li>
              <li><a href="../motives/motives_list.php">Motives List</a></li>
              <li><a href="../motives/manage_motives.php">Manage Motives</a></li>
            </ul>
            <h5 class="pt-1 sidebar-heading d-flex justify-content-between align-items-center cursor-pointer" onclick="toggleContactus()">
              <div class="d-flex align-items-center gap-1">
                <img src="./../icons/contactus.png" class="sidebar-logo" alt="">
                <span>Contact Us</span>
              </div>
              <img src="./../icons/arrow_down.png" class="sidebar-logo" id="contact-toggle-img" alt="">
            </h5>
            <ul style="padding-left:30px; display:none" id="message-lists">
              <li><a href="../messages/message_list.php">Messages</a></li>

            </ul>
          </div>
        </div>
      </div>
      <div class="col-10">
        <nav class="d-flex position-sticky">
          <div class="user-profile position-relative">
            <div class="profile-icon cursor-pointer" onclick="displayProfile()">
              <img src="./../images/people.png" alt="" />
            </div>
            <ul id="logout-userprofile">
              <li><a href="./../logout.php">Logout</a></li>
              <li><a href="#">Profile</a></li>
            </ul>
          </div>
        </nav>
        <div class="p-5">
          <div class="card">
            <div class="card-body">
              <div class="p-3">
                <form class="row gap-2" method="post" enctype="multipart/form-data">
                  <div class="col-12 d-flex gap-2">

                    <div>
                      <input type="file" name="profile" hidden id="profile" />
                      <label for="profile" class="cursor-pointer" title="Change Profile">
                        <div class="profileimg">
                          <img src="../images/<?php echo $data['profile']; ?>" alt="JL" id="profileImg" />
                      </label>

                    </div>
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <h5><?php echo $data['fullname']; ?></h5>
                    <p><?php echo $data['email']; ?></p>
                  </div>
              </div>
              <div class="col-6">
                <label for="">Full Name</label>
                <input type="text" name="fullname" value="<?php echo $data['fullname'] ?>" id="fullname" />
              </div>
              <div class="col-6">
                <label for="">Email</label>
                <input type="email" name="email" value="<?php echo $data['email'] ?>" />
              </div>
              <div class="col-12">
                <button type="submit" name="updateprofile" class="btn-success">
                  Update Profile
                </button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </body>

  </html>
  <script src="./../script.js"></script>
  <?php
  if (isset($_POST['updateprofile'])) {
    $fullName = $_POST['fullname'];
    $email = $_POST['email'];
    $file = $_FILES['profile']['name'];
    $tmp_name = $_FILES['profile']['tmp_name'];
    $path = "../images/" . $file;
    $file1 = explode('.', $file);
    $ext = $file1[1];
    $allowed = array("jpg", "png", "jpeg");
    // if (in_array($ext, $allowed)) {
    // if (move_uploaded_file($tmp_name, $path)) {
    mysqli_query($conn, "UPDATE users SET fullname='$fullName', email='$email', profile='$file' WHERE id=$id");
    // }
    // }
  }

  ?>