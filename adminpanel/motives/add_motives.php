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
            <div class="sidebar">
                <div class="sidebar-activities">
                    <ul>
                        <h2>Manage Users</h2>
                        <li><a href="../manage_user/userlists.php">User Lists</a></li>
                    </ul>
                    <ul style="margin-top:15px">
                        <h2>Motives</h2>
                        <li><a href="#" class="active-sidebar">Add Motives</a></li>
                        <li><a href="./motives_list.php">Motives List</a></li>
                        <li><a href="./manage_motives.php">Manage Motives</a></li>
                    </ul>
                    <ul style="margin-top:15px">
                        <h2>Contact Us</h2>
                        <li><a href="../messages/message_list.php">Messages Lists</a></li>
                        <li><a href="../messages/message_detail.php">View Messages</a></li>
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