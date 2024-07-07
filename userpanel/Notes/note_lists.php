<?php
session_start();
$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
include("../../connection.php");
$user_id = $_SESSION['user_id'];

$selectQuery = "SELECT id, title, content FROM dapf_notes WHERE `user_id`=$user_id";
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
<?php

?>

<body id="<?php echo $id; ?>">
    <div class="row">

        <div class="col-12">
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
                            <div class="row gap-2">
                                <div class="col-12 d-flex justify-content-between">
                                    <h2>Notes List</h2>
                                    <a href="./add_note.php" class="btn-success">Add Note</a>
                                </div>
                                <div class="col-12">
                                    <a href=".././dashboard.php" style="text-decoration:none"> Dashboard </a>
                                </div>
                                <div class="col-12 row gap-2 justify-content-center mt-3">

                                    <?php
                                    while ($row = mysqli_fetch_assoc($fetch)) {

                                    ?>
                                        <div class="card col-4">
                                            <div class="note-card-body">
                                                <h3 class="note-card-title"><?php echo $row['title']; ?></h3>
                                                <p><?php echo $row['content']; ?></p>
                                                <div class="d-flex mt-3 gap-2 align-items-center">
                                                    <a href="./edit_note.php?id=<?php echo $row['id'] ?>" class="btn-secondary">Edit</a>
                                                    <a href="./delete_note.php?id=<?php echo $row['id'] ?>" class="btn-danger">Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>

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