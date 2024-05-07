<?php
session_start();
$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
include("../../connection.php");
if (isset($_POST['allocatemoney'])) {
    $allocation_for = $_POST['allocation_for'];
    $estimated_money = $_POST['estimated_money'];
    $sql = "INSERT INTO dapf_allocatebudget(allocation_for, estimated_money) VALUES ('$allocation_for', '$estimated_money')";
    $sub = mysqli_query($conn, $sql);
    header("location:./view_allocatedbudget.php");
}
$fetch_expenses = "SELECT id, title FROM dapf_monthlyexpense";
$get_expenses = mysqli_query($conn, $fetch_expenses);
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
            <div class="sidebar">
                <div class="sidebar-activities">
                    <h2>Tasks</h2>
                    <ul style="padding-left:7px">
                        <li><a href="../tasks/add_tasks.php">Add Tasks</a></li>
                        <li><a href="../tasks/view_tasks.php">View Tasks</a></li>
                        <li><a href="../tasks/delete_tasks.php">Delete Tasks</a></li>
                        <li><a href="../tasks/completed_task.php">Completed Tasks</a></li>
                    </ul>
                </div>
                <div class="sidebar-finance">
                    <h2>Finance</h2>
                    <ul style="padding-left:7px">
                        <li><a href="./add_income.php">Add Income</a></li>
                        <li><a href="./add_expenses.php">Add Expense</a></li>
                        <li><a href="./view_income.php">View Income</a></li>
                        <li><a href="./view_expense.php">View Expenses</a></li>
                        <li><a href="./add_monthly_expense.php">Add Monthly Expenses</a></li>
                        <li><a href="./allocate_budget.php" class="active-sidebar">Allocate Budget</a></li>
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
                            <form class="row gap-2" method="post">
                                <div class="col-12">
                                    <h2 class="ml-2">Allocate Budget</h2>
                                </div>
                                <div class="col-6">
                                    <label for="">Allocation For</label>
                                    <select id="select" name="allocation_for">
                                        <?php while ($data = mysqli_fetch_assoc($get_expenses)) { ?>
                                            <option value="<?php echo $data['title'] ?>"><?php echo $data['title']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="">Estimated Money</label>
                                    <input type="number" name="estimated_money" value="">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-success ml-2" name="allocatemoney">Allocate</button>
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