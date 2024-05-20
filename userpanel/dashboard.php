<?php
session_start();
include('../connection.php');
$user_id = $_SESSION['user_id'];
$fetch_tasks = "SELECT id, status,task_name, task_due_date, importance FROM dapf_tasks WHERE user_id=$user_id AND deleted_status=0";
$fetch = mysqli_query($conn, $fetch_tasks);
$get_income_query = "SELECT id,date,  incomed_money, incomed_from FROM dapf_income WHERE user_id=$user_id";
$fetch_income = mysqli_query($conn, $get_income_query);
?>
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
                    <div class="sidebar d-flex flex-column gap-1">
                        <h5><a href="#" class="active-sidebar sidebar-heading d-flex align-items-center gap-1"><img src="../images/dashboard.png" class="sidebar-logo"> <span>Dashboard</span></a></h5>
                        <div class="sidebar-activities">
                            <h5 id="task-link" class="cursor-pointer sidebar-heading d-flex align-items-center justify-content-between" onclick="displayTaskback()">
                                <div class="d-flex gap-1 align-items-center">
                                    <img src="../images/to-do-list.png" class="sidebar-logo" alt=""><span>Tasks</span>
                                </div>
                                <img src="../icons/arrow_down.png" id="tasks-back-toggle-icon" class="sidebar-logo" alt="">
                            </h5>
                            <ul style="padding-left:30px; display:none;" id="tasks-lists-back">
                                <li><a href="./tasks/add_tasks.php">Add Tasks</a></li>
                                <li><a href="./tasks/view_tasks.php">View Tasks</a></li>
                                <li><a href="./tasks/delete_tasks.php">Delete Tasks</a></li>
                                <li><a href="./tasks/completed_task.php">Completed Tasks</a></li>
                            </ul>
                        </div>
                        <div class="sidebar-finance">
                            <h2 class="sidebar-heading cursor-pointer d-flex align-items-center justify-content-between" onclick="toggleFinancesback()">
                                <div class="d-flex align-items-center gap-1">
                                    <img src="../images/finance.png" class="sidebar-logo" alt=""><span>Finance</span>
                                </div>
                                <img src="../icons/arrow_down.png" class="sidebar-logo" id="finance-back-toggle-logo" alt="">
                            </h2>
                            <ul style="padding-left:30px; display:none" id="finance-lists-back">
                                <li><a href="./finance/add_income.php">Add Income</a></li>
                                <li><a href="./finance/view_income.php">View Income</a></li>
                                <li><a href="./finance/add_expenses.php">Add Expense</a></li>
                                <li><a href="./finance/view_expense.php">View Expenses</a></li>
                                <li><a href="./finance/add_monthly_expense.php">Add Monthly Expenses</a></li>
                                <li><a href="./finance/view_monthly_expense.php">View Monthly Expenses</a></li>
                                <li><a href="./finance/allocate_budget.php">Allocate Budget</a></li>
                                <li><a href="./finance/view_allocatedbudget.php">View Allocated Budget</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-10">
                    <nav class="d-flex position-sticky">

                        <div class="user-profile position-relative">
                            <div class="profile-icon cursor-pointer" onclick="displayProfile()">
                                <img src="./../images/people.png" alt="">
                            </div>
                            <ul id="logout-userprofile">
                                <li><a href="./profile.php">Profile</a></li>
                                <li><a href="./../logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </nav>
                    <div class="dashboard-content">
                        <h1>Welcome <?php
                                    echo $_SESSION['fullname'];
                                    ?></h1>
                        <div class="new-tasks pt-2">
                            <h2 class="pb-1">Tasks</h2>
                            <table class="col-12" cellpadding="10" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Task Name</th>
                                        <th>Importance</th>
                                        <th>Task Due Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($fetch)) {
                                    ?>
                                        <tr>
                                            <td><?php echo ++$i; ?></td>
                                            <td><a style="text-decoration: none; color:blue" href="./tasks/task_detail.php?id=<?php echo $row['id'] ?>"><?php echo $row['task_name'] ?></a></td>
                                            <td><?php echo $row['importance'] ?></td>
                                            <td><?php echo $row['task_due_date']  ?></td>
                                            <td><?php echo $row['status']  ?></td>

                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>

                        </div>
                        <div class="income-lists pt-2">
                            <h2 class="pb-1">
                                Incomes
                            </h2>
                            <table>
                                <table class="col-12" cellpadding="10" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Date</th>
                                            <th>Incomed Money</th>
                                            <th>Income From</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($fetch_income)) { ?>
                                            <tr>
                                                <td><?php echo ++$i; ?></td>
                                                <td><?php echo $row['date'] ?></td>
                                                <td><?php echo $row['incomed_money'] ?></td>
                                                <td><?php echo $row['incomed_from'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>




    </div>
</body>
<script src="../script.js">

</script>