<?php
session_start();
$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
include("../../connection.php");
$user_id = $_SESSION['user_id'];
if (isset($_POST['addincome'])) {
    $day = $_POST['day'];
    $date = $_POST['date'];
    $incomed_money = $_POST['incomed_money'];
    $incomed_from = $_POST['incomed_from'];
    $summary = $_POST['summary'];
    $sql = "INSERT INTO dapf_income(date, incomed_money, incomed_from, summary,user_id) VALUES ('$date','$incomed_money', '$incomed_from','$summary','$user_id')";
    $sub = mysqli_query($conn, $sql);
    header("location:./view_income.php");
}
$fetch_monthly_income = "SELECT id, title FROM dapf_monthlyincome WHERE user_id=$user_id";
$income_sources = mysqli_query($conn, $fetch_monthly_income);
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
                            <ul style="padding-left:5px;" id="incomes-list">
                                <li><a href="#" class="active-sidebar">Add Income</a></li>
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
                            <ul style="padding-left:5px; display:none;" id="expenses-list">
                                <li><a href="./add_expenses.php">Add Expense</a></li>
                                <li><a href="./view_expense.php">View Expenses</a></li>
                                <li><a href="./add_monthly_expense.php">Add Monthly Expenses</a></li>
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
                <h4 style="display:flex; justify-content:flex-end; padding:0px 0px 20px 0px;">Date: &nbsp;<span id="displayDate" style="font-weight: 400;"></span></h4>

                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <form class="row gap-2" method="post">
                                <div class="col-12">
                                    <h2>Add Income</h2>
                                </div>

                                <input type="date" name="date" value="" id="date" readonly hidden>
                                <div class="col-6" style="transform:translateX(-22px)">
                                    <label for="">Incomed Money</label>
                                    <input type="text" name="incomed_money" value="" required>
                                </div>
                                <div class="col-6" style="transform:translateX(22px)">
                                    <label for="">Income Source</label>
                                    <?php if (mysqli_num_rows($income_sources) >= 1) {
                                    ?>
                                        <select name="incomed_from" id="select" required>
                                            <?php while ($row = mysqli_fetch_assoc($income_sources)) {
                                            ?>
                                                <option value="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></option>
                                            <?php }
                                        } else {
                                            ?>
                                            <select id="invalid-select" required>
                                            </select>
                                            <!-- <select disabled id="invalid-select" required></select> -->
                                            <p class="error-color">First Add Monthly Incomes</p>
                                        <?php } ?>
                                        <!-- <option value="Others">Others</option> -->

                                        </select>
                                </div>
                                <div class="col-12">
                                    <label for="">Summary</label>
                                    <textarea rows="" cols="" name="summary"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-success" name="addincome">Add Income</button>
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