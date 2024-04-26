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
        <div class="col-3">
            <div class="sidebar">
                <div class="sidebar-activities">
                    <ul>
                        <h2>Tasks</h2>
                        <li><a href="#">Add Tasks</a></li>
                        <li><a href="./view_tasks.php">View Tasks</a></li>
                        <li><a href="./delete_activities.php">Delete Tasks</a></li>
                        <li><a href="./completed_task.php">Completed Tasks</a></li>
                    </ul>
                </div>

                <div class="sidebar-finance">
                    <ul>
                        <h2>Finance</h2>
                        <li><a href="../finance/add_finance.php">Add Income/Expenses</a></li>
                        <li><a href="../finance/view_finance.php">View Income/Expenses</a></li>
                        <li><a href="../finance/edit_finance.php">Edit Income/Expenses</a></li>
                        <li><a href="../finance/delete_finance.php">Delete Income/Expenses</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-9">
            <nav class="d-flex position-sticky">

                <p><a href="../../login.php">Logout</a></p>
                <p>Profile</p>
            </nav>
            <div class="p-5">
                <div class="card">
                    <div class="card-body">
                        <div class="p-3">
                            <form class="row gap-2" method="post">
                                <div class="col-12">
                                    <h2>Add Tasks</h2>
                                </div>
                                <div class="col-6">
                                    <label for="">Date</label>
                                    <input type="date" name="date" value="" id="date">
                                </div>
                                <div class="col-6">
                                    <label for="">Task Name</label>
                                    <input type="text" name="task_name" value="">
                                </div>
                                <div class="col-6">
                                    <label for="">Importance</label>
                                    <select id="select" name="importance">
                                        <option value="">Select Option</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="">Due Date</label>
                                    <input type="date" name="tasks_due_date">
                                </div>
                                <div class="col-12">
                                    <label for="">Summary</label>
                                    <textarea rows="" cols="" name="summary"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="addtasks">Add Activity</button>
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
include("../../connection.php");
if (isset($_POST['addtasks'])) {
    $date = $_POST['date'];
    $task_name = $_POST['task_name'];
    $tasks_due_date = $_POST['tasks_due_date'];
    $importance = $_POST['importance'];
    $summary = $_POST['summary'];
    $sql = "INSERT INTO dtpf_tasks(date, task_name, task_due_date, importance,summary) VALUES ('$date', '$task_name','$tasks_due_date', '$importance','$summary')";
    $sub = mysqli_query($conn, $sql);
    header("location:./view_tasks.php");
}

?>