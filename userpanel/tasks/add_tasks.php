<?php
session_start();
$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
$user_id = $_SESSION['user_id'];

include("../../connection.php");
if (isset($_POST['addtasks'])) {
    $date = $_POST['date'];
    $task_name = $_POST['task_name'];
    $tasks_due_date = $_POST['tasks_due_date'];
    $importance = $_POST['importance'];
    $summary = $_POST['summary'];
    $sql = "INSERT INTO dapf_tasks(date, task_name, task_due_date, importance,summary,user_id) VALUES ('$date', '$task_name','$tasks_due_date', '$importance','$summary','$user_id')";
    $sub = mysqli_query($conn, $sql);
    header("location:./view_tasks.php");
    exit;
}
$fetch_importances = "SELECT title FROM dapf_importances";
$importances = mysqli_query($conn, $fetch_importances);
// print_r($importances);
// while ($a = mysqli_fetch_assoc($importances)) {
//     echo $a['title'];
// }
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
        <div class="col-2">
            <div class="sidebar">
                <div class="sidebar-activities">
                    <h2>Tasks</h2>
                    <ul style="padding-left:7px;">
                        <li><a href="#" class="active-sidebar">Add Tasks</a></li>
                        <li><a href="./view_tasks.php">View Tasks</a></li>
                        <li><a href="./delete_tasks.php">Delete Tasks</a></li>
                        <li><a href="./completed_task.php">Completed Tasks</a></li>
                    </ul>
                </div>

                <div class="sidebar-finance">
                    <h2>Finance</h2>
                    <ul style="padding-left:7px;">
                        <li><a href="../finance/add_income.php">Add Income</a></li>
                        <li><a href="../finance/view_income.php">View Income</a></li>
                        <li><a href="../finance/add_expenses.php">Add Expense</a></li>
                        <li><a href=" ../finance/view_expense.php">View Expenses</a></li>
                        <li><a href="../finance/add_monthly_expense.php">Add Monthly Expenses</a></li>
                        <li><a href="../finance/view_monthly_expense.php">View Monthly Expenses</a></li>
                        <li><a href="../finance/allocate_budget.php">Allocate Budget</a></li>
                        <li><a href="../finance/view_allocatedbudget.php">View Allocated Budget</a></li>
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
                        <li><a href="../profile.php">Profile</a></li>
                        <li><a href="../../logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
            <div class="p-5">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <form class="row gap-2" method="post">
                                <div class="col-12">
                                    <h2 class="ml-2">Add Tasks</h2>
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
                                        <?php while ($title = mysqli_fetch_assoc($importances)) { ?>
                                            <option value="<?php echo $title['title'];  ?>"><?php echo $title['title'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="">Due Date</label>
                                    <input type="date" name="tasks_due_date">
                                </div>
                                <div class="col-12 ml-2">
                                    <label for="">Summary</label>
                                    <textarea rows="" cols="" name="summary"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="addtasks" class="btn-success ml-2">Add Tasks</button>
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