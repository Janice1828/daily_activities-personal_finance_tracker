<?php
// session_start();
// $login_status = $_SESSION['logged_in'];
// if ($login_status != "true") {
//     header("location:../../login.php");
// }
include("../../connection.php");
$message_fetch_query = "SELECT title FROM dapf_importances";
$res = mysqli_query($conn, $message_fetch_query);
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
            <div class="sidebar">
                <div class="sidebar-activities">
                    <ul>
                        <h3>Master</h3>
                        <li><a href="#" class="active-sidebar">Importances</a></li>
                    </ul>
                    <ul style="margin-top:15px">
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
                        <li><a href="../../logout.php">Logout</a></li>
                        <li><a href="../profile.php">Profile</a></li>
                    </ul>
                </div>
            </nav>
            <div class="p-5">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <form class="row gap-2">
                                <div class="col-12">
                                    <a href="./add_importances.php" class="btn-primary">Add Importances</a>

                                </div>
                                <div class="col-12">
                                    <h2>View Importances</h2>
                                </div>
                                <table class="col-12" cellpadding="10" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($data = mysqli_fetch_assoc($res)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $i;
                                                    $i++;
                                                    ?></td>
                                                <td><?php echo $data['title'] ?></td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
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