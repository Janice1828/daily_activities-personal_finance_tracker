<?php
session_start();
$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
include("../../connection.php");
$selectQuery = "SELECT dapf_expense.id, dapf_expense.date, dapf_expense.money_spent, dapf_allocatebudget.allocation_for, dapf_allocatebudget.estimated_money,dapf_allocatebudget.estimated_money FROM dapf_expense LEFT JOIN dapf_allocatebudget ON  dapf_expense.spent_on = dapf_allocatebudget.id ORDER BY dapf_expense.id DESC ";
$fetch = mysqli_query($conn, $selectQuery);

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
                    <ul style="padding-left: 7px;">
                        <li><a href="../tasks/add_tasks.php">Add Tasks</a></li>
                        <li><a href="../tasks/view_tasks.php">View Tasks</a></li>
                        <li><a href="../tasks/delete_tasks.php">Delete Tasks</a></li>
                        <li><a href="../tasks/completed_task.php">Completed Tasks</a></li>
                    </ul>
                </div>

                <div class="sidebar-finance">
                    <h2>Finance</h2>
                    <ul style="padding-left:7px;">
                        <li><a href="./add_income.php">Add Income</a></li>
                        <li><a href="./add_expenses.php">Add Expense</a></li>
                        <li><a href="./view_income.php">View Income</a></li>
                        <li><a href="#" class="active-sidebar">View Expenses</a></li>
                        <li><a href="./add_monthly_expense.php">Add Monthly Expenses</a></li>
                        <li><a href="./allocate_budget.php">Allocate Budget</a></li>
                        <li><a href="./view_allocatedbudget.php">View Allocated Budget</a></li>

                        <li><a href="./view_monthly_expense.php">View Monthly Expenses</a></li>

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
                            <form class="row gap-2">
                                <div class="col-12">
                                    <h2>View Expense</h2>
                                </div>
                                <table class="col-12" cellpadding="10" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Date</th>
                                            <th>Money Spent</th>
                                            <th>Spent On</th>
                                            <th>Allocated Money</th>
                                            <th>Remaining Allocated Money</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($fetch)) { ?>
                                            <tr>
                                                <td><?php echo ++$i; ?></td>
                                                <td><?php echo $row['date'] ?></td>
                                                <td><?php echo $row['money_spent'] ?></td>
                                                <td><?php echo $row['allocation_for'] ?></td>
                                                <td><?php echo $row['estimated_money'] ?></td>
                                                <td></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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