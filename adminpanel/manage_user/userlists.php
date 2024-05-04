<?php
include("../../connection.php");
$selectQuery = "SELECT id,fullname, email, usertype FROM users WHERE status=1";
$fetch = mysqli_query($conn, $selectQuery);

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
                        <h2>Manage Users</h2>
                        <li><a href="#" class="active-sidebar">User Lists</a></li>
                    </ul>
                    <ul style="margin-top:15px">
                        <h2>Motives</h2>
                        <li><a href="../motives/add_motives.php">Add Motives</a></li>
                        <li><a href="../motives/motives_list.php">Motives List</a></li>
                        <li><a href="../motives/manage_motives.php">Manage Motives</a></li>
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
                            <form class="row gap-2">
                                <div class="col-12">
                                    <h2>User Lists</h2>
                                </div>
                                <table class="col-12" cellpadding="10" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
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
                                                    <td><a href="./delete_user.php?id=<?php echo $row['id'] ?>" class="btn-danger">Delete</a></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
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