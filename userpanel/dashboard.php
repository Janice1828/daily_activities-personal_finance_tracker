<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daily Activities & Personal Finance Tracker</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div>
        <div class="">
            <div class="row">
                <div class="col-2">
                    <div class="sidebar">
                        <div class="sidebar-activities">
                            <ul>
                                <h2>Tasks</h2>
                                <li><a href="./tasks/add_tasks.php">Add Tasks</a></li>
                                <li><a href="./tasks/view_tasks.php">View Tasks</a></li>
                                <li><a href="./tasks/delete_tasks.php">Delete Tasks</a></li>
                                <li><a href="./tasks/completed_task.php">Completed Tasks</a></li>
                            </ul>
                        </div>

                        <div class="sidebar-finance">
                            <ul>
                                <h2>Finance</h2>
                                <li><a href="finance/add_finance.php">Add Income/Expenses</a></li>
                                <li><a href="finance/view_finance.php">View Income/Expenses</a></li>
                                <li><a href="finance/edit_finance.php">Edit Income/Expenses</a></li>
                                <li><a href="#">Delete Income/Expenses</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-10">
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