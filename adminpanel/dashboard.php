<?php
session_start();
$login_status = $_SESSION['adminlogged_in'];
if ($login_status != "true") {
    header("location:../login.php");
}
include "../connection.php";
$selectQuery = "SELECT id,fullname, email, usertype FROM users WHERE status=1";
$fetch = mysqli_query($conn, $selectQuery);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daily Activities & Personal Finance Tracker</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="row">
        <div class="col-2">
            <div class="sidebar d-flex flex-column gap-1">
                <h5><a href="#" class="sidebar-heading d-flex active-sidebar align-items-center gap-1"><img src="../images/dashboard.png" class="sidebar-logo"> <span>Dashboard</span></a></h5>

                <div class="sidebar-activities">
                    <h5 class="cursor-pointer sidebar-heading d-flex justify-content-between" onclick="toggleMasterback()">
                        <div class="d-flex gap-1 align-items-center">
                            <img src="../icons/master.png" class="sidebar-logo" alt="">
                            <span>Master</span>
                        </div>
                        <img src="../icons/arrow_down.png" class="sidebar-logo" alt="" id="master-back-toggle-img">
                    </h5>
                    <ul style="padding-left:30px; display:none" id="master-back-lists">
                        <li><a href="./importances/view_importances.php">Importances</a></li>
                    </ul>
                    <h5 class="pt-1 sidebar-heading cursor-pointer d-flex justify-content-between align-items-center" onclick="toggleUsersback()">
                        <div class="d-flex align-items-center gap-1">
                            <img src="../icons/users.png" alt="" class="sidebar-logo"><span>Manage Users</span>
                        </div>
                        <img src="../icons/arrow_down.png" class="sidebar-logo" id="user-back-toggle-img" alt="">
                    </h5>
                    <ul style="padding-left:30px; display:none" id="user-back-lists">
                        <li><a href="./manage_user/userlists.php">User Lists</a></li>
                    </ul>

                    <h5 class="pt-1 sidebar-heading cursor-pointer d-flex align-items-center justify-content-between" onclick="toggleMotivesback()">
                        <div class="d-flex gap-1 align-items-center">
                            <img src="../icons/motives.png" alt="" class="sidebar-logo"><span>Motives</span>
                        </div>
                        <img src="../icons/arrow_down.png" class="sidebar-logo" id="motives-back-toggle-img" alt="">
                    </h5>
                    <ul style="padding-left:30px; display:none" id="motive-back-lists">
                        <li><a href="./motives/add_motives.php">Add Motives</a></li>
                        <li><a href="./motives/motives_list.php">Motives List</a></li>
                    </ul>
                    <h5 class="pt-1 sidebar-heading cursor-pointer d-flex align-items-center justify-content-between" onclick="toggleContactusback()">
                        <div class="d-flex gap-1 align-items-center">
                            <img src="../icons/contactus.png" alt="" class="sidebar-logo"><span>Contact Us</span>
                        </div>
                        <img src="../icons/arrow_down.png" class="sidebar-logo" id="contact-toggle-back-img" alt="">
                    </h5>
                    <ul style="padding-left:30px; display:none" id="message-back-lists">
                        <li><a href="./messages/message_list.php">Messages Lists</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-10">
            <nav class="d-flex position-sticky">

                <div class="user-profile position-relative">
                    <div class="profile-icon cursor-pointer" onclick="displayProfile()">
                        <img src="./../images/people.png" alt="">
                    </div>
                    <ul id="logout-userprofile">
                        <li><a href="./profile.php">Profile</a></li>
                        <li><a href="./../logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
            <div class="p-5">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h1>Welcome <?php echo $_SESSION['fullname'] ?></h1>
                        </div>
                        <div class="user-lists pt-2 pb-1">
                            <h2>User Lists</h2>
                        </div>
                        <div>
                            <table class="col-12" cellpadding="10" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($fetch)) {
                                        if ($row['usertype'] != "admin") {
                                    ?>
                                            <tr>
                                                <td><?php echo ++$i; ?></td>
                                                <td><?php echo $row['fullname'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
<script src="../script.js">

</script>