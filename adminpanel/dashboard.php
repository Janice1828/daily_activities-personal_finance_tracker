<?php
// include("../../connection.php");
// $selectQuery = "SELECT date, money_spent, spent_on FROM dapf_finance";
// $fetch = mysqli_query($conn, $selectQuery);

?>
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
        <div class="col-2">
            <div class="sidebar">
                <div class="sidebar-activities">
                    <ul>
                        <h2>Manage Users</h2>
                        <li><a href="#">User Lists</a></li>
                    </ul>
                    <ul style="margin-top:15px">
                        <h2>Motives</h2>
                        <li><a href="./motives/add_motives.php">Add Motives</a></li>
                        <li><a href="./motives/motives_list.php">Motives List</a></li>
                        <li><a href="./motives/manage_motives.php">Manage Motives</a></li>
                    </ul>
                    <ul style="margin-top:15px">
                        <h2>Contact Us</h2>
                        <li><a href="./messages/message_list.php">Messages Lists</a></li>
                        <li><a href="./messages/message_detail.php">View Messages</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-9">
            <nav class="d-flex position-sticky">


                <p><a href="../login.php">Logout</a></p>
                <p>Profile</p>
            </nav>
            <div class="p-5">
                <div class="card">
                    <div class="card-body">
                        <div class="p-3">

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</body>