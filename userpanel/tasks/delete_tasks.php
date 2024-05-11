<?php
session_start();
$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
$user_id = $_SESSION['user_id'];
include("../../connection.php");
$selectQuery = "SELECT id,date, task_name, task_due_date,user_id ,importance FROM dapf_tasks WHERE `status`!='completed' AND `deleted_status`= 0 AND `user_id`=$user_id";
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
                    <ul style="padding-left:7px;">
                        <li><a href="./add_tasks.php">Add Tasks</a></li>
                        <li><a href="./view_tasks.php">View Tasks</a></li>
                        <li><a href="#" class="active-sidebar">Delete Tasks</a></li>
                        <li><a href="./completed_task.php">Completed Tasks</a></li>
                    </ul>
                </div>

                <div class="sidebar-finance">
                    <h2>Finance</h2>
                    <ul style="padding-left:7px;">
                        <li><a href="../finance/add_income.php">Add Income</a></li>
                        <li><a href="../finance/add_expenses.php">Add Expense</a></li>
                        <li><a href="../finance/view_income.php">View Income</a></li>
                        <li><a href=" ../finance/view_expense.php">View Expenses</a></li>
                        <li><a href="../finance/add_monthly_expense.php">Add Monthly Expenses</a></li>
                        <li><a href="../finance/allocate_budget.php">Allocate Budget</a></li>
                        <li><a href="../finance/view_allocatedbudget.php">View Allocated Budget</a></li>
                        <li><a href="../finance/view_monthly_expense.php">View Monthly Expenses</a></li>
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
                                    <h2>Delete Tasks</h2>
                                </div>
                                <table class="col-12" cellpadding="10" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Task Name</th>
                                            <th>Importance</th>
                                            <th>Task Due Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($fetch)) {
                                        ?>
                                            <tr>
                                                <td><?php echo ++$i; ?></td>
                                                <td><a style="text-decoration: none; color:blue" href="./task_detail.php?id=<?php echo $row['id'] ?>"><?php echo $row['task_name'] ?></a></td>
                                                <td><?php echo $row['importance']  ?></td>
                                                <td><?php echo $row['task_due_date']  ?></td>
                                                <td><a class="btn-danger" href="./delete.php?id=<?php echo $row['id'] ?>">Delete</a></td>


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