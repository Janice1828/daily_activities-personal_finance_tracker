<?php
session_start();
$user_id = $_SESSION['user_id'];
$currentDate = date("Y-m-d");
include("../../connection.php");
$user_id = $_SESSION['user_id'];

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
                    <ul style="padding-left: 30px; display:none" id="tasks-lists">
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
                                <li><a href="./add_monthly_income.php">Add Income Sources</a></li>
                                <li><a href="./view_monthly_income.php">View Income Sources</a></li>
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
                                <li><a href="./add_monthly_expense.php">Add Expenses Outflow</a></li>
                                <li><a href="./view_monthly_expense.php">View Expenses Outflows</a></li>
                                <li><a href="./allocate_budget.php">Allocate Budget</a></li>
                                <li><a href="./view_allocatedbudget.php">View Allocated Budget</a></li>
                            </ul>
                        </li>
                        <li style="padding-left:5px">
                            <div class="d-flex justify-content-between">
                                <h4 class="cursor-pointer income-expense-title active-sidebar">Summary</h4>
                            </div>
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
                    $income = 0;
                    $expense = 0;
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $fromDate = $_POST['from_date'];
                        $toDate = $_POST['to_date'];
                        $incomeQuery = "SELECT date, SUM(incomed_money) as income_sum FROM dapf_income WHERE user_id='$user_id' AND date >= '$fromDate' AND date <= '$toDate'";
                        $incomeResult = mysqli_query($conn, $incomeQuery);
                        $incomeRow = mysqli_fetch_assoc($incomeResult);
                        $incomeSum = $incomeRow['income_sum'];
                        $expenseQuery = "SELECT date, SUM(money_spent) as expenses FROM dapf_expense WHERE user_id='$user_id' AND date >= '$fromDate' AND date <= '$toDate'";
                        $expenseResult = mysqli_query($conn, $expenseQuery);
                        $expenseRow = mysqli_fetch_assoc($expenseResult);
                        $expenseSum = $expenseRow['expenses'];
                        $income = $incomeSum;
                        $expense = $expenseSum;
                    }
                    ?>
                    <form method="POST" class="d-flex gap-2 align-items-center">
                        <div>
                            <label for="from_date">From</label>
                            <input type="date" name="from_date" value="" max="<?php echo $currentDate ?>" required>
                        </div>
                        <div>
                            <label for="to_date">To</label>
                            <input type="date" name="to_date" max="<?php echo $currentDate ?>" required>
                        </div>
                        <div style="margin-top:15px">
                            <button type="submit" class="btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="tasks-report d-flex" style="gap:25px">
                    <div class="box d-flex flex-column gap-1 align-items-center justify-content-center">
                        <h3 class="details-title">Income</h3>
                        <span class="summary-data"><?php echo $income > 0 ? $income : 0  ?></span>
                    </div>
                    <div class="box d-flex flex-column gap-1 align-items-center justify-content-center">
                        <h3 class="details-title">Expense</h3>
                        <span class="summary-data"><?php echo $expense > 0 ? $expense : 0  ?></span>
                    </div>
                    <div class="box d-flex flex-column gap-1 align-items-center justify-content-center">
                        <h3 class="details-title">Summary</h3>
                        <span class="summary-data"><?php echo $income - $expense ?></span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<script src="../../script.js">
</script>