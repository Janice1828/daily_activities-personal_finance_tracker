<?php
session_start();
include("../../connection.php");
$user_id = $_SESSION['user_id'];
$currentDate = date("Y-m-d");
$to_date = isset($_POST['to_date']) ? $_POST['to_date'] : 0;
$from_date = isset($_POST['from_date']) ? $_POST['from_date'] : 0;

if (isset($_POST['timely_task_csv'])) {
    $file_name = "tasks_" . date("Y-m-d") . ".csv";
    $delimiter = ",";
    $f = fopen('php://memory', 'w');
    $fields = array('id', 'date', 'task_name', 'task_due_date', 'importance', 'status', 'summary');
    fputcsv($f, $fields, $delimiter);
    $result = $conn->query("SELECT * FROM dapf_tasks WHERE user_id='$user_id' AND date>='$from_date' AND date<='$to_date'");
    $id = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $lineData = array(++$id, $row['date'], $row['task_name'], $row['task_due_date'], $row['importance'], $row['status'], $row['summary']);
            fputcsv($f, $lineData, $delimiter);
        }
    }
    fseek($f, 0);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $file_name . '";');
    fpassthru($f);
    exit();
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
    <div class="row">
        <div class="col-2">
            <div class="sidebar d-flex flex-column gap-1">
                <h5><a href="../dashboard.php" class="sidebar-heading d-flex align-items-center gap-1"><img src="../../images/dashboard.png" class="sidebar-logo"> <span>Dashboard</span></a></h5>

                <div class="sidebar-activities">
                    <h5 id="task-link" class="cursor-pointer sidebar-heading d-flex align-items-center justify-content-between" onclick="displayTask()">
                        <div class="d-flex gap-1 align-items-center">
                            <img src="../../images/to-do-list.png" class="sidebar-logo" alt=""><span>Tasks</span>
                        </div>
                        <img src="../../icons/arrow_down.png" id="tasks-toggle-icon" class="sidebar-logo" alt="">
                    </h5>
                    <ul style="padding-left:30px;" id="tasks-lists">
                        <li><a href="./add_tasks.php">Add Tasks</a></li>
                        <li><a href="./view_tasks.php">View Tasks</a></li>
                        <li><a href="./incomplete_task.php">Expired Tasks</a></li>
                        <li><a href="./completed_task.php">Completed Tasks</a></li>
                        <li><a href="#" class="active-sidebar">Summary</a></li>
                    </ul>
                </div>
                <div class="sidebar-finance">
                    <h2 class="sidebar-heading cursor-pointer d-flex align-items-center justify-content-between" onclick="toggleFinances()">
                        <div class="d-flex align-items-center gap-1">
                            <img src="../../images/finance.png" class="sidebar-logo" alt=""><span>Finance</span>
                        </div>
                        <img src="../../icons/arrow_down.png" class="sidebar-logo" id="finance-toggle-logo" alt="">
                    </h2>
                    <ul style="padding-left:30px; display:none" id="finance-lists">
                        <li style="padding-left:5px;">
                            <div class="d-flex justify-content-between">
                                <h4 onclick="toggleIncome()" class="cursor-pointer income-expense-title">Incomes</h4>
                                <img src="../../icons/arrow_down.png" id="incomeArrow" class="incomeExpensesArrow" alt="">
                            </div>
                            <ul style="padding-left:5px; display:none" id="incomes-list">
                                <li><a href="../finance/add_income.php">Add Income</a></li>
                                <li><a href="../finance/view_income.php">View Income</a></li>
                                <li><a href="../finance/add_monthly_income.php">Add Income Sources</a></li>
                                <li><a href="../finance/view_monthly_income.php">View Income Sources</a></li>
                            </ul>
                        </li>
                        <li style="padding-left:5px">
                            <div class="d-flex justify-content-between">
                                <h4 class="cursor-pointer income-expense-title" onclick="toggleExpenses()">Expenses</h4>
                                <img src="../../icons/arrow_down.png" id="expenseArrow" class="incomeExpensesArrow" alt="">
                            </div>
                            <ul style="padding-left:5px; display:none;" id="expenses-list">
                                <li><a href="../finance/add_expenses.php">Add Expense</a></li>
                                <li><a href="../finance/view_expense.php">View Expenses</a></li>
                                <li><a href="../finance/add_monthly_expense.php">Add Expenses Outflow</a></li>
                                <li><a href="../finance/view_monthly_expense.php">View Expenses Outflows</a></li>
                                <li><a href="../finance/allocate_budget.php">Allocate Budget</a></li>
                                <li><a href="../finance/view_allocatedbudget.php">View Allocated Budget</a></li>
                            </ul>
                        </li>

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
                <div class="pb-2 d-flex justify-content-between align-items-center">
                    <h3>Summary</h3>
                    <?php

                    $date = date("Y-m-d");
                    $totalTasks = 0;
                    $newTasks = 0;
                    $completedTasks = 0;
                    $expiredTasks = 0;
                    if (isset($_POST['tasks_summary'])) {
                        $fromDate = $_POST['from_date'];
                        $toDate = $_POST['to_date'];
                        $totalTasks = "SELECT COUNT(id) AS totalTasks FROM `dapf_tasks` WHERE user_id=$user_id";
                        $resul = mysqli_query($conn, $totalTasks);
                        $totalData = mysqli_fetch_assoc($resul);
                        $totalTasks = $totalData['totalTasks'];
                        $new_task_query = "SELECT status, task_due_date,COUNT(id) AS newTasks FROM `dapf_tasks` WHERE user_id=$user_id AND status='new task' AND task_due_date >= '$date' AND date >= '$fromDate' AND date <= '$toDate'";
                        $new = mysqli_query($conn, $new_task_query);
                        $new_task = mysqli_fetch_assoc($new);
                        $completedTasks = "SELECT status,COUNT(id) AS completedTasks FROM `dapf_tasks` WHERE user_id=$user_id AND status='completed' AND date >= '$fromDate' AND date <= '$toDate'";
                        $completed = mysqli_query($conn, $completedTasks);
                        $completed_tasks = mysqli_fetch_assoc($completed);
                        $expired_query = "SELECT status, task_due_date,COUNT(id) AS expiredTasks FROM `dapf_tasks` WHERE user_id=$user_id AND status='new task' AND task_due_date < '$date' AND date >= '$fromDate' AND date <= '$toDate'";
                        $expired = mysqli_query($conn, $expired_query);
                        $expired_query = mysqli_fetch_assoc($expired);
                        $newTasks = $new_task['newTasks'];
                        $completedTasks = $completed_tasks['completedTasks'];
                        $expiredTasks = $expired_query['expiredTasks'];
                        $to_date = $toDate;
                        $from_date = $fromDate;
                    }
                    ?>
                    <form method="POST" class="d-flex gap-2 align-items-center">
                        <div>
                            <label for="from_date">From</label>
                            <input type="date" name="from_date" value="<?php echo $from_date ?>" max="<?php echo $currentDate ?>" required>
                        </div>
                        <div>
                            <label for="to_date">To</label>
                            <input type="date" name="to_date" max="<?php echo $currentDate ?>" value="<?php echo $currentDate ?>" required>
                        </div>
                        <div style="margin-top:15px">
                            <button type="submit" name="tasks_summary" class="btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div style="margin-bottom:20px;">
                    <form method="POST" onsubmit="stopRefreshing()">
                        <input type="hidden" name="from_date" value="<?php echo $from_date ?>">
                        <input type="hidden" name="to_date" value="<?php echo $to_date ?>">
                        <button name="timely_task_csv" class="btn-danger">Download CSV</button>
                    </form>
                </div>
                <div class="tasks-report d-flex" style="gap:25px">
                    <div class="tasks-report d-flex " style="gap:25px;">
                        <div class="box d-flex flex-column gap-1 align-items-center justify-content-center">
                            <h3 class="details-title">Total Tasks</h3>
                            <span class="summary-data"><?php echo $totalTasks   ?></span>

                        </div>
                        <div class="box d-flex flex-column gap-1 align-items-center justify-content-center">
                            <h3 class="details-title">New Tasks</h3>
                            <span class="summary-data"><?php echo $newTasks  ?></span>

                        </div>
                        <div class="box d-flex flex-column gap-1 align-items-center justify-content-center">
                            <h3 class="details-title">Completed Tasks</h3>
                            <span class="summary-data"><?php echo $completedTasks ?></span>
                        </div>
                        <div class="box d-flex flex-column gap-1 align-items-center justify-content-center">
                            <h3 class="details-title">Incomplete/Expired Tasks</h3>
                            <span class="summary-data"><?php echo $expiredTasks  ?></span>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<script src="../../script.js">
</script>

</html>