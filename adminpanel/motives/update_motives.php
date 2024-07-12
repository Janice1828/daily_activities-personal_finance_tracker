<?php
session_start();
$id = $_GET['id'];
$login_status = $_SESSION['adminlogged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
include("../../connection.php");
if (isset($_POST['updatemotive'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $file = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $path = "../../images/" . $file;
    $file1 = explode('.', $file);
    $ext = $file1[1];
    $allowed = array("jpg", "png", "jpeg");
    if (in_array($ext, $allowed)) {
        if (move_uploaded_file($tmp_name, $path)) {
            mysqli_query($conn, "UPDATE dapf_motives SET title='$title', content='$content', image='$file' WHERE id=$id ");
            header("location:./motives_list.php");
        }
    } else {
        mysqli_query($conn, "UPDATE dapf_motives SET title='$title', content='$content' WHERE id=$id ");
        header("location:./motives_list.php");
    }
}
$selectQuery = "SELECT id,image, title, content FROM dapf_motives WHERE id=$id";
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
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <form class="row gap-2" method="post" enctype="multipart/form-data">
                                <div class="col-12">
                                    <h2 class="ml-2 page-title">Update Motives</h2>
                                </div>

                                <div class="col-6">
                                    <label for="">Title</label>
                                    <input type="text" name="title" value="<?php echo $data['title'] ?>">
                                </div>

                                <div class="col-6">
                                    <div class="d-flex gap-1 align-items-center">
                                        <label for="">Image</label> <img src="../../images/<?php echo $data['image']; ?>" alt="" style="height:30px !important; width:30px !important">
                                    </div>
                                    <input type="file" name="image" value="../../images/<?php echo $data['image'] ?>">
                                </div>
                                <div class="col-12 ml-2">
                                    <label for="">Content</label>
                                    <textarea rows="" cols="" name="content"><?php echo $data['content']; ?></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="updatemotive" class="btn-success ml-2">Update Motives</button>
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