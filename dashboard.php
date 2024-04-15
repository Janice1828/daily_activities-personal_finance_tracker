<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daily Activities & Personal Finance Tracker</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <div class="">
            <div class="row">
                <div class="col-3">
                    <div class="sidebar">
                        <div class="sidebar-activities">
                            <ul>
                                <h2>Activities</h2>
                                <li><a href="activities/add_activities.php">Add Activities</a></li>
                                <li><a href="#">View Activities</a></li>
                                <li><a href="#">Edit Activities</a></li>
                                <li><a href="#">Delete Activities</a></li>
                            </ul>
                        </div>

                        <div class="sidebar-finance">
                            <ul>
                                <h2>Finance</h2>
                                <li><a href="activities/add_finance.php">Add Income/Expenses</a></li>
                                <li><a href="#">View Income/Expenses</a></li>
                                <li><a href="#">Edit Income/Expenses</a></li>
                                <li><a href="#">Delete Income/Expenses</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <?php
                    include("./components/Navbar.php");
                    ?>
                    <div class="dashboard-content">
                        <?php
                        // session_start();
                        // echo $_SESSION['fullname'];

                        ?>
                    </div>

                </div>
            </div>
        </div>




    </div>
</body>