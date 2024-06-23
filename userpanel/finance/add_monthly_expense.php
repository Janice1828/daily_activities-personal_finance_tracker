<?php
session_start();
$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
$user_id = $_SESSION['user_id'];
include("../../connection.php");
if (isset($_POST['addexpense'])) {
    foreach ($_POST['title'] as $title) {
        if (strlen($title) >= 1) {
            $safe_title = mysqli_real_escape_string($conn, $title);
            $insertQuery = "INSERT INTO dapf_monthlyexpense(title, user_id) VALUES ('$safe_title','$user_id')";
            mysqli_query($conn, $insertQuery);
            header("location:./view_monthly_expense.php");
        }
    }
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
    <div class="row add-finance-container">
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
                    <ul style="padding-left:30px; display:none" id="tasks-lists">
                        <li><a href="../tasks/add_tasks.php">Add Tasks</a></li>
                        <li><a href="../tasks/view_tasks.php">View Tasks</a></li>
                        <li><a href="../tasks/incomplete_task.php">Expired Tasks</a></li>
                        <li><a href="../tasks/completed_task.php">Completed Tasks</a></li>
                    </ul>
                </div>
                <div class="sidebar-finance">
                    <h2 class="sidebar-heading cursor-pointer d-flex align-items-center justify-content-between" onclick="toggleFinances()">
                        <div class="d-flex align-items-center gap-1">
                            <img src="../../images/finance.png" class="sidebar-logo" alt=""><span>Finance</span>
                        </div>
                        <img src="../../icons/arrow_down.png" class="sidebar-logo" id="finance-toggle-logo" alt="">
                    </h2>
                    <ul style="padding-left:30px;" id="finance-lists">
                        <li style="padding-left:5px;">
                            <div class="d-flex justify-content-between">
                                <h4 onclick="toggleIncome()" class="cursor-pointer income-expense-title">Incomes</h4>
                                <img src="../../icons/arrow_down.png" id="incomeArrow" class="incomeExpensesArrow" alt="">
                            </div>
                            <ul style="padding-left:5px; display:none" id="incomes-list">
                                <li><a href="./add_income.php">Add Income</a></li>
                                <li><a href="./view_income.php">View Income</a></li>
                                <li><a href="./add_monthly_income.php">Add Monthly Income</a></li>
                                <li><a href="./view_monthly_income.php">View Monthly Incomes</a></li>
                            </ul>
                        </li>
                        <li style="padding-left:5px">
                            <div class="d-flex justify-content-between">
                                <h4 class="cursor-pointer income-expense-title" onclick="toggleExpenses()">Expenses</h4>
                                <img src="../../icons/arrow_down.png" id="expenseArrow" class="incomeExpensesArrow" alt="">
                            </div>
                            <ul style="padding-left:5px;" id="expenses-list">
                                <li><a href="./add_expenses.php">Add Expense</a></li>
                                <li><a href="./view_expense.php">View Expenses</a></li>
                                <li><a href="#" class="active-sidebar">Add Monthly Expenses</a></li>
                                <li><a href="./view_monthly_expense.php">View Monthly Expenses</a></li>
                                <li><a href="./allocate_budget.php">Allocate Budget</a></li>
                                <li><a href="./view_allocatedbudget.php">View Allocated Budget</a></li>
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
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <form class="row gap-2" method="post">
                                <div class="col-12">
                                    <h2>Add Monthly Expenses</h2>
                                </div>

                                <div class="col-12">
                                    <label for="">Title</label>
                                    <div id="monthlyexpenses-repeater-fields">
                                        <div class="d-flex gap-2 align-items-center">
                                            <input type="text" name="title[]" value="" required>
                                            <button onclick="addExpensesInput()" class="mt-0 addInputBtn">
                                                <img src="../../icons/icons8-add-50.png" class="input-add-icon" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-success" name="addexpense">Add Expenses</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</body>

</html>
<script src="../../script.js">
</script>