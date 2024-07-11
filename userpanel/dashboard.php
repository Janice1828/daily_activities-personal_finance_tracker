<?php
session_start();
include('../connection.php');

$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../login.php");
}
$user_id = $_SESSION['user_id'];
$start = 0;
$rows_per_page = 10;
$tasks = $conn->query("SELECT * FROM dapf_tasks WHERE `deleted_status` = 0 AND `user_id`=$user_id");
$no_of_rows = mysqli_num_rows($tasks);
$pages = ceil($no_of_rows / $rows_per_page);
if (isset($_GET['page-nr'])) {
    $id = $_GET['page-nr'];
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
} else {
    $id = 1;
}
$selectQuery = "SELECT id,date, user_id,importance, task_name, task_due_date,status, importance FROM dapf_tasks WHERE `deleted_status` = 0 AND `user_id`=$user_id ORDER BY task_due_date DESC LIMIT $start, $rows_per_page";
$fetch = mysqli_query($conn, $selectQuery);
$date = date("Y-m-d");
$current_page = isset($_GET['page-nr']) ? (int)$_GET['page-nr'] : 1;

function createPageLinks($total_pages, $current_page, $limit = 5)
{
    $start_page = max(1, $current_page - intval($limit / 2));
    $end_page = min($total_pages, $current_page + intval($limit / 2));

    if ($end_page - $start_page < $limit) {
        $start_page = max(1, $end_page - $limit + 1);
    }

    $page_links = [];
    if ($start_page > 1) {
        $page_links[] = 1;
        if ($start_page > 2) {
            $page_links[] = '...';
        }
    }

    for ($i = $start_page; $i <= $end_page; $i++) {
        $page_links[] = $i;
    }

    if ($end_page < $total_pages) {
        if ($end_page < $total_pages - 1) {
            $page_links[] = '...';
        }
        $page_links[] = $total_pages;
    }

    return $page_links;
}

$page_links = createPageLinks($pages, $current_page);

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
                                <li style="padding-left:5px;">
                                    <div class="d-flex justify-content-between">
                                        <h4 onclick="toggleDashboardIncome()" class="cursor-pointer income-expense-title">Incomes</h4>
                                        <img src="../icons/arrow_down.png" id="dashboardIncomeArrow" class="incomeExpensesArrow" alt="">
                                    </div>
                                    <ul style="padding-left:5px; display:none" id="dashboard-incomes-list">
                                        <li><a href="./finance/add_income.php">Add Income</a></li>
                                        <li><a href="./finance/view_income.php">View Income</a></li>
                                        <li><a href="./finance/add_monthly_income.php">Add Monthly Income</a></li>
                                        <li><a href="./finance/view_monthly_income.php">View Monthly Incomes</a></li>
                                    </ul>
                                </li>
                                <li style="padding-left:5px;">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="cursor-pointer income-expense-title" onclick="toggleDashboardExpenses()">Expenses</h4>
                                        <img src="../icons/arrow_down.png" id="dashboardExpenseArrow" class="incomeExpensesArrow" alt="">
                                    </div>
                                    <ul style="padding-left:5px; display:none;" id="dashboard-expenses-list">
                                        <li><a href="./finance/add_expenses.php">Add Expense</a></li>
                                        <li><a href="./finance/view_expense.php">View Expenses</a></li>
                                        <li><a href="./finance/add_monthly_expense.php">Add Monthly Expenses</a></li>
                                        <li><a href="./finance/view_monthly_expense.php">View Monthly Expenses</a></li>
                                        <li><a href="./finance/allocate_budget.php">Allocate Budget</a></li>
                                        <li><a href="./finance/view_allocatedbudget.php">View Allocated Budget</a></li>
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
                                <img src="./../images/people.png" alt="">
                            </div>
                            <ul id="logout-userprofile">
                                <li><a href="./profile.php">Profile</a></li>
                                <li><a href="./../logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </nav>
                    <div class="dashboard-content">
                        <div class="d-flex justify-content-center align-items-center border-bottom">
                            <h1>Welcome <?php
                                        echo $_SESSION['fullname'];
                                        ?>!</h1>
                            <!-- <a href="./Notes/note_lists.php" class="btn-secondary">Notes</a> -->
                        </div>
                        <?php
                        $totalTasks = "SELECT COUNT(id) AS totalTasks FROM `dapf_tasks` WHERE user_id=$user_id";
                        $completedTasks = "SELECT status,COUNT(id) AS completedTasks FROM `dapf_tasks` WHERE user_id=$user_id AND status='completed'";
                        $resul = mysqli_query($conn, $totalTasks);
                        $totalData = mysqli_fetch_assoc($resul);
                        $completed = mysqli_query($conn, $completedTasks);
                        $completed_tasks = mysqli_fetch_assoc($completed);
                        $expired_query = "SELECT status, task_due_date,COUNT(id) AS expiredTasks FROM `dapf_tasks` WHERE user_id=$user_id AND status='new task' AND task_due_date < '$date'";
                        $expired = mysqli_query($conn, $expired_query);
                        $expired_query = mysqli_fetch_assoc($expired);

                        $new_task_query = "SELECT status, task_due_date,COUNT(id) AS newTasks FROM `dapf_tasks` WHERE user_id=$user_id AND status='new task' AND task_due_date >= '$date'";
                        $new = mysqli_query($conn, $new_task_query);
                        $new_task = mysqli_fetch_assoc($new);
                        ?>

                        <div class="new-tasks">
                            <h2 class="pb-2 pt-2 d-flex summary-title">Tasks Summary</h2>
                            <div class="tasks-report d-flex " style="gap:25px;">
                                <div class="box d-flex flex-column gap-1 align-items-center justify-content-center">
                                    <h3 class="details-title">Total Tasks</h3>
                                    <span class="summary-data"><?php echo $totalData['totalTasks']; ?></span>

                                </div>
                                <div class="box d-flex flex-column gap-1 align-items-center justify-content-center">
                                    <h3 class="details-title">New Tasks</h3>
                                    <span class="summary-data"><?php echo $new_task['newTasks'] ?></span>

                                </div>
                                <div class="box d-flex flex-column gap-1 align-items-center justify-content-center">
                                    <h3 class="details-title">Completed Tasks</h3>
                                    <span class="summary-data"><?php echo $completed_tasks['completedTasks']; ?></span>
                                </div>
                                <div class="box d-flex flex-column gap-1 align-items-center justify-content-center">
                                    <h3 class="details-title">Incomplete/Expired Tasks</h3>
                                    <span class="summary-data"><?php echo $expired_query['expiredTasks']; ?></span>
                                </div>

                            </div>
                            <?php
                            $income = "SELECT SUM(incomed_money) AS totalIncome FROM dapf_income WHERE user_id='$user_id'";
                            $incomed_money = mysqli_query($conn, $income);
                            $total_income = mysqli_fetch_assoc($incomed_money);
                            $expense = "SELECT SUM(money_spent) AS totalExpenses FROM dapf_expense WHERE user_id='$user_id'";
                            $expenses_money = mysqli_query($conn, $expense);
                            $total_expenses = mysqli_fetch_assoc($expenses_money);



                            ?>
                            <h2 class="pb-2 d-flex summary-title">Finance Summary</h2>
                            <div class="tasks-report d-flex" style="gap:25px">
                                <div class="box d-flex flex-column gap-1 align-items-center justify-content-center">
                                    <h3 class="details-title">Incomes</h3>
                                    <span class="summary-data"><?php echo $total_income['totalIncome']; ?></span>
                                </div>
                                <div class="box d-flex flex-column gap-1 align-items-center justify-content-center">
                                    <h3 class="details-title">Expenses</h3>
                                    <span class="summary-data"><?php echo $total_expenses['totalExpenses']; ?></span>
                                </div>
                                <div class="box d-flex flex-column gap-1 align-items-center justify-content-center">
                                    <h3 class="details-title">Summary</h3>
                                    <span class="summary-data"><?php echo $total_income['totalIncome'] - $total_expenses['totalExpenses']; ?></span>
                                </div>

                            </div>
                            <h2 class="pb-2 d-flex summary-title border-top">Tasks Lists</h2>
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
                                            <td><a style="text-decoration: none; color:blue" href="./task_detail.php?id=<?php echo $row['id'] ?>"><?php echo $row['task_name'] ?></a></td>
                                            <td><?php echo $row['importance'] ?></td>
                                            <td><?php echo $row['task_due_date']  ?></td>
                                            <td><?php echo $row['status']  ?></td>

                                        </tr>
                                    <?php
                                    } ?>

                                </tbody>
                            </table>
                            <div class="col-12">
                                <?php if (mysqli_num_rows($fetch) >= 1) { ?>
                                    <div class="pagination d-flex gap-1 align-items-center">
                                        <a href="?page-nr=<?php echo 1 ?>" class="start-page pagination-btns">First</a>
                                        <div class="page-numbers d-flex gap-1">
                                            <?php
                                            foreach ($page_links as $link) {
                                                if ($link == '...') {
                                                    echo '<span class="pagination-ellipsis">...</span>';
                                                } else {
                                                    $active_class = ($link == $current_page) ? 'active-page' : '';
                                                    echo '<a href="?page-nr=' . $link . '" class="pagination-btns ' . $active_class . '">' . $link . '</a>';
                                                }
                                            }
                                            ?>

                                        </div>
                                        <a href="?page-nr=<?php echo $pages ?>" class="end-page pagination-btns">Last</a>

                                    </div><?php } ?>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>




    </div>
</body>
<script src="../script.js">

</script>