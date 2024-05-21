<?php
session_start();
// $login_status = $_SESSION['logged_in'];
// if ($login_status != "true") {
//     header("location:../../login.php");
// }
include("../../connection.php");
$user_id = $_SESSION['user_id'];
$selectQuery = "SELECT id,date, user_id,importance, task_name, task_due_date,status, importance FROM dapf_tasks WHERE `deleted_status` = 0 AND `user_id`=$user_id ORDER BY status DESC ";
$fetch = mysqli_query($conn, $selectQuery);
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
                        <li><a href="#" class="active-sidebar">View Tasks</a></li>
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
                        <li><a href="../finance/add_income.php">Add Income</a></li>
                        <li><a href="../finance/view_income.php">View Income</a></li>
                        <li><a href="../finance/add_expenses.php">Add Expense</a></li>
                        <li><a href="../finance/view_expense.php">View Expenses</a></li>
                        <li><a href="../finance/add_monthly_income.php">Add Monthly Income</a></li>
                        <li><a href="../finance/view_monthly_income.php">View Monthly Incomes</a></li>
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
                                    <h2>View Tasks</h2>
                                </div>
                                <table class="col-12" cellpadding="10" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Task Name</th>
                                            <th>Importance</th>
                                            <th>Task Due Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($fetch)) {
                                            if ($row['task_due_date'] >= $date || $row['status'] === 'completed') {
                                        ?>
                                                <tr>
                                                    <td><?php echo ++$i; ?></td>
                                                    <td><a style="text-decoration: none; color:blue" href="./task_detail.php?id=<?php echo $row['id'] ?>"><?php echo $row['task_name'] ?></a></td>
                                                    <td><?php echo $row['importance'] ?></td>
                                                    <td><?php echo $row['task_due_date']  ?></td>
                                                    <td><?php echo $row['status']  ?></td>
                                                    <td>
                                                        <?php
                                                        if ($row['status'] == "completed") {
                                                            echo "completed";
                                                        } else {
                                                        ?>
                                                            <a href="./complete_task.php?id=<?php echo $row['id'] ?>" class="btn-primary">Complete</a>
                                                            <a href="./editform.php?id=<?php echo $row['id'] ?>" class="btn-secondary">Update</a>
                                                            <a href="./delete.php?id=<?php echo $row['id'] ?>" class="btn-danger">Delete</a>
                                                        <?php }

                                                        ?>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>

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