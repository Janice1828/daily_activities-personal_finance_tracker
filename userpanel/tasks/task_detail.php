<?php
session_start();
$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
$id = $_GET['id'];
include("../../connection.php");
$selectQuery = "SELECT id,date, task_name, task_due_date,status, summary, importance FROM dapf_tasks WHERE id=$id";
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
    <div class="row">
        <div class="col-2">
            <div class="sidebar">
                <div class="sidebar-activities">
                    <h2>Tasks</h2>
                    <ul style="padding-left:7px;">
                        <li><a href="./add_tasks.php">Add Tasks</a></li>
                        <li><a href="./view_tasks.php" class="active-sidebar">View Tasks</a></li>
                        <li><a href="./delete_tasks.php">Delete Tasks</a></li>
                        <li><a href="./completed_task.php">Completed Tasks</a></li>
                    </ul>
                </div>

                <div class="sidebar-finance">
                    <h2>Finance</h2>
                    <ul style="padding-left:7px;">
                        <li><a href="../finance/add_finance.php">Add Income/Expenses</a></li>
                        <li><a href="../finance/view_income.php">View Income</a></li>
                        <li><a href="../finance/view_expense.php">View Expenses</a></li>
                        <li><a href="../finance/edit_finance.php">Edit Income/Expenses</a></li>
                        <li><a href="../finance/delete_finance.php">Delete Income/Expenses</a></li>
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
                        <div class="" style="box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.2); padding:30px;">
                            <div class="row gy-2">
                                <div class="col-6">
                                    <p><b>Date : </b> <?php echo $data['date'] ?></p>
                                </div>
                                <div class="col-6">
                                    <p><b>Task Name : </b> <?php echo $data['task_name'] ?></p>
                                </div>
                                <div class="col-6">
                                    <p><b>Task Due Date : </b> <?php echo $data['task_due_date'] ?></p>
                                </div>
                                <div class="col-6">
                                    <p><b>Status : </b> <?php echo $data['status'] ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Importance : </b> <?php echo $data['importance'] ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Summary : </b> <?php echo $data['summary'] ?></p>
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