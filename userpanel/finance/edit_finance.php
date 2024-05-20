<?php
session_start();
$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
include("../../connection.php");
$selectQuery = "SELECT id, date, money_spent_income, spenton_income FROM dapf_finance WHERE deleted_status=0";
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
            <div class="sidebar d-flex flex-column gap-1">
                <div class="sidebar-activities">
                    <h5 id="task-link" class="cursor-pointer sidebar-heading d-flex align-items-center justify-content-between" onclick="displayTask()">
                        <div class="d-flex gap-1 align-items-center">
                            <img src="../images/to-do-list.png" class="sidebar-logo" alt=""><span>Tasks</span>
                        </div>
                        <img src="../icons/arrow_down.png" id="tasks-toggle-icon" class="sidebar-logo" alt="">
                    </h5>
                    <ul style="padding-left:30px; display:none">
                        <li><a href="../tasks/add_tasks.php">Add Tasks</a></li>
                        <li><a href="../tasks/view_tasks.php">View Tasks</a></li>
                        <li><a href="../tasks/incomplete_task.php">Expired Tasks</a></li>
                        <li><a href="../tasks/completed_task.php">Completed Tasks</a></li>
                    </ul>
                </div>

                <div class="sidebar-finance">
                    <h2 class="sidebar-heading cursor-pointer d-flex align-items-center justify-content-between" onclick="toggleFinances()">
                        <div class="d-flex align-items-center gap-1">
                            <img src="../images/finance.png" class="sidebar-logo" alt=""><span>Finance</span>
                        </div>
                        <img src="../icons/arrow_down.png" class="sidebar-logo" id="finance-toggle-logo" alt="">
                    </h2>
                    <ul style="padding-left:30px; display:none">
                        <li><a href="./add_finance.php">Add Income/Expenses</a></li>
                        <li><a href="./view_income.php">View Income</a></li>
                        <li><a href="./view_expense.php">View Expenses</a></li>
                        <li><a href="./add_monthly_expense.php">Add Monthly Expenses</a></li>
                        <li><a href="./allocate_budget.php">Allocate Budget</a></li>
                        <li><a href="./view_monthly_expense.php">View Monthly Expenses</a></li>
                        <li><a href="#" class="active-sidebar">Edit Income/Expenses</a></li>
                        <li><a href="./delete_finance.php">Delete Income/Expenses</a></li>
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
                                    <h2>Edit Finance</h2>
                                </div>
                                <table class="col-12" cellpadding="10" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Date</th>
                                            <th>Money Spent</th>
                                            <th>Spent On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($fetch)) {  ?>
                                            <tr>
                                                <td><?php echo ++$i; ?></td>
                                                <td><?php echo $row['date'] ?></td>
                                                <td><?php echo $row['money_spent_income'] ?></td>
                                                <td><?php echo $row['spenton_income'] ?></td>
                                                <td><a href="./editform.php?id=<?php echo $row['id'] ?>" class="btn-secondary">Edit</a></td>
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

</html>
<script src="../../script.js">
</script>