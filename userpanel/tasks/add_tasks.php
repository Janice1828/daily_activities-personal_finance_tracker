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
    $tasks_due_date = $_POST['task_due_date'];
    $importance = $_POST['importance'];
    $summary = $_POST['summary'];
    $sql = "INSERT INTO dapf_tasks(date, task_name, task_due_date, importance,summary,user_id) VALUES ('$date', '$task_name','$tasks_due_date', '$importance','$summary','$user_id')";
    $sub = mysqli_query($conn, $sql);
    header("location:./view_tasks.php");
    exit;
}

$date = date("Y-m-d");
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
                        <li><a href="#" class="active-sidebar">Add Tasks</a></li>
                        <li><a href="./view_tasks.php">View Tasks</a></li>
                        <li><a href="./incomplete_task.php">Expired Tasks</a></li>
                        <li><a href="./completed_task.php">Completed Tasks</a></li>
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
                        <li><a href="../profile.php">Profile</a></li>
                        <li><a href="../../logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
            <div class="p-5">
                <h4 style="display:flex; justify-content:flex-end; padding:0px 0px 20px 0px;">Date: &nbsp;<span id="displayDate" style="font-weight: 400;"></span></h4>
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <form class="row gap-2" method="post">
                                <div class="col-12">
                                    <h2 class="page-title">Add Task</h2>
                                </div>
                                <div>
                                    <input type="date" hidden name="date" value="" id="date">
                                </div>
                                <div class="col-6" style="transform:translateX(-35px)">
                                    <label for="taskName" class="cursor-pointer">Title</label>
                                    <input id="taskName" type="text" name="task_name" value="" required>
                                </div>
                                <div class="col-6" style="transform:translateX(10px)">
                                    <label for="select" class="cursor-pointer">Importance</label>
                                    <select id="select" name="importance" required>
                                        <option selected disabled>Select Option</option>
                                        <option value="low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                        <option value="Critical">Critical</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="task_due_date" class="cursor-pointer">Due Date</label>
                                    <input type="date" value="<?php echo date("Y-m-d") ?>" min="<?php echo $date; ?>" name="task_due_date" id="task_due_date" required>
                                </div>
                                <div class="col-12 overflow-hidden">
                                    <label for="summary" class="cursor-pointer">Summary</label>
                                    <textarea id="summary" rows="" cols="" name="summary"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="addtasks" class="btn-success">Add Task</button>
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