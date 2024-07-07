<?php
session_start();
$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
$user_id = $_SESSION['user_id'];
include("../../connection.php");

$start = 0;
$rows_per_page = 10;
$expenses = $conn->query("SELECT * FROM dapf_expense WHERE `user_id`=$user_id");
$no_of_pages = mysqli_num_rows($expenses);

$selectQuery = "SELECT spent_on, SUM(money_spent) AS total_spent, dapf_monthlyexpense.title, dapf_allocatebudget.estimated_money FROM dapf_expense LEFT JOIN dapf_monthlyexpense ON dapf_expense.spent_on=dapf_monthlyexpense.id LEFT JOIN dapf_allocatebudget ON dapf_allocatebudget.allocation_for=dapf_expense.spent_on WHERE dapf_expense.user_id=$user_id GROUP BY dapf_expense.spent_on LIMIT $start, $rows_per_page";
$fetch = mysqli_query($conn, $selectQuery);

$pages = ceil($no_of_pages / $rows_per_page);
if (isset($_GET['page-nr'])) {
    $id = $_GET['page-nr'];
    $page = $id - 1;
    $start = $page * $rows_per_page;
} else {
    $id = 1;
}
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
                                <li><a href="#" class="active-sidebar">View Expenses</a></li>
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
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <div class="row gap-2">
                                <div class="col-12">
                                    <h2>View Expenses</h2>
                                </div>
                                <table class="col-12" cellpadding="10" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Spent On</th>
                                            <th>Money Spent</th>
                                            <th>Allocated Money</th>
                                            <th>Remaining Allocated Budget</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($fetch)) { ?>
                                            <tr>
                                                <td><?php echo ++$i; ?></td>
                                                <td><?php echo $row['dapf_monthlyexpense.title'] ?></td>
                                                <td><?php echo $row['total_spent'] ?></td>
                                                <td><?php echo $row['estimated_money'] ?></td>
                                                <td><?php echo $row['estimated_money'] - $row['total_spent'] ?></td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
                                    </div>
                                <?php } ?>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
<script src="../../script.js">

</script>