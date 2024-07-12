<?php
session_start();
$login_status = $_SESSION['adminlogged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
include("../../connection.php");
$selectQuery = "SELECT id,image, title, content FROM dapf_motives";
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
            <div class="sidebar d-flex flex-column gap-1">
                <h5><a href="../dashboard.php" class="sidebar-heading d-flex align-items-center gap-1"><img src="../../images/dashboard.png" class="sidebar-logo"> <span>Dashboard</span></a></h5>
                <div class="sidebar-activities">

                    <h5 class="pt-1 sidebar-heading cursor-pointer d-flex justify-content-between align-items-center" onclick="toggleUsers()">
                        <div class=" d-flex align-items-center gap-1">
                            <img src="../../icons/users.png" class="sidebar-logo" alt="">
                            <span class="sidebar-title">Manage Users</span>
                        </div>
                        <img src="../../icons/arrow_down.png" class="sidebar-logo" id="user-toggle-img" alt="">
                    </h5>
                    <ul style=" padding-left:30px; display:none" id="user-lists">
                        <li class="admin-sidebar-content-list"><a href="../manage_user/userlists.php" class="sidebar-content-lists">User Lists</a></li>
                    </ul>
                    <h5 class="sidebar-heading cursor-pointer pt-1 d-flex justify-content-between align-items-center" onclick="toggleMotives()">
                        <div class="d-flex align-items-center gap-1">
                            <img src="../../icons/motives.png" class="sidebar-logo" alt="">
                            <span class="sidebar-title">Motives</span>
                        </div>
                        <img src="../../icons/arrow_down.png" class="sidebar-logo" id="motives-toggle-img" alt="">
                    </h5>
                    <ul style="padding-left:30px;" id="motive-lists">
                        <li class="admin-sidebar-content-list"><a href="./add_motives.php" class="sidebar-content-lists">Add Motives</a></li>
                        <li class="admin-sidebar-content-list"><a href="#" class="sidebar-content-lists active-sidebar">Motives List</a></li>

                    </ul>
                    <h5 class="pt-1 sidebar-heading d-flex justify-content-between align-items-center cursor-pointer" onclick="toggleContactus()">
                        <div class="d-flex align-items-center gap-1">
                            <img src="../../icons/icons8-comment-50 (1).png" class="sidebar-logo" alt="">
                            <span class="sidebar-title">Messages</span>
                        </div>
                        <img src="../../icons/arrow_down.png" class="sidebar-logo" id="contact-toggle-img" alt="">
                    </h5>
                    <ul style="padding-left:30px; display:none" id="message-lists">
                        <li class="admin-sidebar-content-list"><a href="../messages/message_list.php" class="sidebar-content-lists">Messages List</a></li>

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
                                    <h2 class="page-title">Motives Lists</h2>
                                </div>
                                <table class="col-12" cellpadding="10" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $id = 1;
                                        while ($row = mysqli_fetch_assoc($fetch)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $id;
                                                    $id++; ?></td>
                                                <td><?php echo $row['title'] ?></td>
                                                <td><img src="../../images/<?php echo $row['image'] ?>" style="height:50px; width:50px;" /></td>
                                                <td class="d-flex gap-1">
                                                    <a href="./update_motives.php?id=<?php echo $row['id']; ?>" class="btn-secondary">Update</a>
                                                    <a href="./delete_motives.php?id=<?php echo $row['id']; ?>" class="btn-danger">Delete</a>
                                                </td>
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