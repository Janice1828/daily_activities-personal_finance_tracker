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
        <div class="col-3">
            <div class="sidebar">
                <div class="sidebar-activities">
                    <ul>
                        <h2>Activities</h2>
                        <li><a href="../activities/add_activities.php">Add Activities</a></li>
                        <li><a href="../activities/view_activities.php">View Activities</a></li>
                        <li><a href="../activities/edit_activities.php">Edit Activities</a></li>
                        <li><a href="../activities/delete_activities.php">Delete Activities</a></li>
                    </ul>
                </div>

                <div class="sidebar-finance">
                    <ul>
                        <h2>Finance</h2>
                        <li><a href="#">Add Income/Expenses</a></li>
                        <li><a href="./view_finance.php">View Income/Expenses</a></li>
                        <li><a href="./edit_finance.php">Edit Income/Expenses</a></li>
                        <li><a href="./delete_finance.php">Delete Income/Expenses</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-9">
            <nav class="d-flex position-sticky">

                <p>profile Icon</p>
            </nav>
            <div class="p-5">
                <div class="card">
                    <div class="card-body">
                        <div class="p-3">
                            <form class="row">
                                <div class="col-12">
                                    <h5>Add Finance</h5>
                                </div>
                                <div class="col-6">
                                    <label for="">Day</label>
                                    <input type="sunday" name="day" value="">
                                </div>
                                <div class="col-6">
                                    <label for="">Date</label>
                                    <input type="date" name="date" value="">
                                </div>
                                <div class="col-6">
                                    <label for="">Money Spent</label>
                                    <input type="text" name="activity" value="">
                                </div>

                                <div class="col-6">
                                    <label for="">Money Spent On</label>
                                    <input type="text" name="activity" value="">
                                </div>

                                <div class="col-12">
                                    <label for="">Summary</label>
                                    <textarea rows="" cols=""></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="addfinance">Add Finance</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
<?php
// include("connection.php");
// if (isset($_POST['addactivity'])) {
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $gender = $_POST['gender'];
//     print_r($_POST);
//     $hash_pw = sha1($password);
//     $sql = "INSERT INTO tbl_a(name, email, password, gender) VALUES ('$name', '$email','$hash_pw', '$gender')";
//     $sub = mysqli_query($conn, $sql);
//     header("location:fetch.php");
// }

?>