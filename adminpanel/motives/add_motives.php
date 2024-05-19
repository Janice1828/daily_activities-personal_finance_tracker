<?php
// session_start();
// $login_status = $_SESSION['logged_in'];
// if ($login_status != "true") {
//     header("location:../../login.php");
// }
// include("../../connection.php");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daily Activities & Personal Finance Tracker</title>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <div class="row add-task-container">
        <div class="col-2">
            <div class="sidebar d-flex flex-column gap-1">
                <h5><a href="../dashboard.php" class="sidebar-heading d-flex align-items-center gap-1"><img src="../../images/dashboard.png" class="sidebar-logo"> <span>Dashboard</span></a></h5>
                <div class="sidebar-activities">
                    <h5 class="sidebar-heading cursor-pointer d-flex justify-content-between align-items-center" onclick="toggleMaster()">
                        <div class="d-flex align-items-center gap-1">
                            <img src="../../icons/master.png" class="sidebar-logo" alt="">
                            <span>Master</span>
                        </div>
                        <img src="../../icons/arrow_down.png" class="sidebar-logo" id="master-toggle-img" alt="">
                    </h5>
                    <ul style="padding-left:30px; display:none" id="master-lists">
                        <li><a href="../importances/view_importances.php">Importances</a></li>
                    </ul>
                    <h5 class="pt-1 sidebar-heading cursor-pointer d-flex justify-content-between align-items-center" onclick="toggleUsers()">
                        <div class=" d-flex align-items-center gap-1">
                            <img src="../../icons/users.png" class="sidebar-logo" alt="">
                            <span>Manage Users</span>
                        </div>
                        <img src="../../icons/arrow_down.png" class="sidebar-logo" id="user-toggle-img" alt="">
                    </h5>
                    <ul style=" padding-left:30px; display:none" id="user-lists">
                        <li><a href="../manage_user/userlists.php">User Lists</a></li>
                    </ul>
                    <h5 class="sidebar-heading cursor-pointer pt-1 d-flex justify-content-between align-items-center" onclick="toggleMotives()">
                        <div class="d-flex align-items-center gap-1">
                            <img src="../../icons/motives.png" class="sidebar-logo" alt="">
                            <span>Motives</span>
                        </div>
                        <img src="../../icons/arrow_down.png" class="sidebar-logo" id="motives-toggle-img" alt="">
                    </h5>
                    <ul style="padding-left:30px;" id="motive-lists">
                        <li><a href="#" class="active-sidebar">Add Motives</a></li>
                        <li><a href="./motives_list.php">Motives List</a></li>
                        <li><a href="./manage_motives.php">Manage Motives</a></li>
                    </ul>
                    <h5 class="pt-1 sidebar-heading d-flex justify-content-between align-items-center cursor-pointer" onclick="toggleContactus()">
                        <div class="d-flex align-items-center gap-1">
                            <img src="../../icons/contactus.png" class="sidebar-logo" alt="">
                            <span>Contact Us</span>
                        </div>
                        <img src="../../icons/arrow_down.png" class="sidebar-logo" id="contact-toggle-img" alt="">
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
                        <img src="../../images/people.png" alt="">
                    </div>
                    <ul id="logout-userprofile">
                        <li><a href="../profile.php">Profile</a></li>
                        <li><a href="../../logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
            <div class="p-5">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <form class="row gap-2" method="post">
                                <div class="col-12">
                                    <h2 class="ml-2">Add Motives</h2>
                                </div>

                                <div class="col-6">
                                    <label for="">Title</label>
                                    <input type="text" name="title" value="">
                                </div>

                                <div class="col-6">
                                    <label for="">Image</label>
                                    <input type="file" name="image">
                                </div>
                                <div class="col-12 ml-2">
                                    <label for="">Content</label>
                                    <textarea rows="" cols="" name="content"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="addmotive" class="btn-success ml-2">Add Motives</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
<script src="../../script.js">
</script>