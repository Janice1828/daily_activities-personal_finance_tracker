<?php
session_start();
$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
$user_id = $_SESSION['user_id'];

include("../../connection.php");
if (isset($_POST['addnote'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sql = "INSERT INTO dapf_notes(user_id, title, content) VALUES ('$user_id','$title','$content')";
    $sub = mysqli_query($conn, $sql);
    header("location:./note_lists.php");
}
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

        <div class="col-12">
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
                <h4 style="display:flex; justify-content:flex-end; padding:0px 0px 20px 0px;">Date: &nbsp;<span id="displayDate" style="font-weight: 400;"></span></h4>
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <form class="row gap-2" method="post">
                                <div class="col-12">
                                    <h2>Add Notes</h2>
                                </div>
                                <div>
                                    <input type="date" hidden name="date" value="" id="date">
                                </div>
                                <div class="col-12">
                                    <label for="title" class="cursor-pointer">Title</label>
                                    <input id="title" type="text" name="title" value="" required>
                                </div>

                                <div class="col-12 overflow-hidden">
                                    <label for="content" class="cursor-pointer">Content</label>
                                    <textarea id="content" rows="" cols="" name="content"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="addnote" class="btn-success">Add Note</button>
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