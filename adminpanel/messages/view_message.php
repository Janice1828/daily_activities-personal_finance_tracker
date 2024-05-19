<?php
session_start();
$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
$id = $_GET['id'];
include("../../connection.php");
$selectQuery = "SELECT id,name, email, phone,message FROM dapf_messages WHERE id=$id";
$fetch = mysqli_query($conn, $selectQuery);
$data = mysqli_fetch_assoc($fetch);
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
    <div class="row">
        <div class="col-2">
            <div class="sidebar d-flex flex-column gap-1">
                <div class="sidebar-activities">
                    <ul>
                        <h3>Master</h3>
                        <li><a href="../importances/view_importances.php">Importances</a></li>
                    </ul>
                    <ul style="margin-top:15px;">
                        <h3>Manage Users</h3>
                        <li><a href="../manage_user/userlists.php">User Lists</a></li>
                    </ul>
                    <ul style="margin-top:15px">
                        <h3>Motives</h3>
                        <li><a href="../motives/add_motives.php">Add Motives</a></li>
                        <li><a href="../motives/motives_list.php">Motives List</a></li>
                        <li><a href="../motives/manage_motives.php">Manage Motives</a></li>
                    </ul>
                    <ul style="margin-top:15px">
                        <h3>Contact Us</h3>
                        <li><a href="./message_list.php" class="active-sidebar">Messages</a></li>

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
                        <li><a href="../../logout.php">Logout</a></li>
                        <li><a href="../profile.php">Profile</a></li>
                    </ul>
                </div>
            </nav>
            <div class="p-5">
                <div class="card">
                    <div class="card-body">
                        <div class="" style="box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.2); padding:30px;">
                            <div class="row gy-2">
                                <div class="col-6">
                                    <p><b>Name : </b> <?php echo $data['name'] ?></p>
                                </div>
                                <div class="col-6">
                                    <p><b>Email : </b> <?php echo $data['email'] ?></p>
                                </div>
                                <div class="col-6">
                                    <p><b>Phone : </b> <?php echo $data['phone'] ?></p>
                                </div>
                                <div class="col-6">
                                    <p><b>Message : </b> <?php echo $data['message'] ?></p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
<script src="../../script.js">
</script>