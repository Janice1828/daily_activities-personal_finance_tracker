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
          <div class="sidebar-activities">
            <h5 id="task-link" class="cursor-pointer sidebar-heading d-flex align-items-center justify-content-between" onclick="displayTask()">
              <div class="d-flex gap-1 align-items-center">
                <img src="../images/to-do-list.png" class="sidebar-logo" alt=""><span>Tasks</span>
              </div>
              <img src="../icons/arrow_down.png" id="tasks-toggle-icon" class="sidebar-logo" alt="">
            </h5>
            <ul style="padding-left:30px">
              <li><a href="./tasks/add_tasks.php">Add Tasks</a></li>
              <li><a href="./tasks/view_tasks.php">View Tasks</a></li>
              <li><a href="./tasks/delete_tasks.php">Delete Tasks</a></li>
              <li><a href="./tasks/completed_task.php">Completed Tasks</a></li>
            </ul>
          </div>

          <div class="sidebar-finance">
            <h2 class="sidebar-heading cursor-pointer d-flex align-items-center justify-content-between" onclick="toggleFinances()">
              <div class="d-flex align-items-center gap-1">
                <img src="../images/finance.png" class="sidebar-logo" alt=""><span>Finance</span>
              </div>
              <img src="../icons/arrow_down.png" class="sidebar-logo" id="finance-toggle-logo" alt="">
            </h2>
            <ul style="padding-left:30px">
              <li>
                <a href="./finance/add_finance.php">Add Income/Expenses</a>
              </li>
              <li>
                <a href="./finance/view_finance.php">View Income/Expenses</a>
              </li>
              <li>
                <a href="./finance/edit_finance.php">Edit Income/Expenses</a>
              </li>
              <li>
                <a href="./finance/delete_finance.php">Delete Income/Expenses</a>
              </li>
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