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
        <div class="col-3">
            <div class="sidebar">
                <div class="sidebar-finance">
                    <ul>
                        <h2>Manage Users</h2>
                        <li><a href="./manage_user/userlists.php">User Lists</a></li>
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
                            <form class="row gap-2">
                                <div class="col-12">
                                    <h2>View Finance</h2>
                                </div>
                                <table class="col-12" border="1" cellpadding="10" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Date</th>
                                            <th>Money Spent</th>
                                            <th>Spent On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $i = 0;
                                        // while ($row = mysqli_fetch_assoc($fetch)) { 
                                        ?>
                                        <tr>
                                        </tr>
                                        <?php
                                        //  }
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