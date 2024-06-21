<?php
session_start();
// $login_status = $_SESSION['logged_in'];
// if ($login_status != "true") {
//     header("location:../../login.php");
// }
include("../../connection.php");
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
    <link rel="stylesheet" href="../../style.css">
</head>
<?php

// if (isset($_GET['page-nr'])) {
//     $id = $_GET['page-nr'];
// } else {
//     $id = 1;
// }

?>

<body id="<?php echo $id; ?>">
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
                            <div class="row gap-2">
                                <div class="col-12 d-flex justify-content-between">
                                    <h2>View Tasks</h2>
                                    <a href="./daily_tasks.php" id="add-daily-tasks-btn">Add Daily Tasks</a>
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
                                        echo $date;
                                        echo "<br/>";
                                        while ($row = mysqli_fetch_assoc($fetch)) {
                                            // echo $row['task_due_date'];
                                            // echo "<br/>";
                                            // if ($row['task_due_date'] >= $date || $row['status'] === 'completed') {
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
                                                    } else if ($row['task_due_date'] < $date) {
                                                        echo "Expired";
                                                    } else {
                                                    ?>
                                                        <a href="./complete_task.php?id=<?php echo $row['id'] ?>" class="btn-primary">Complete</a>
                                                        <a href="./editform.php?id=<?php echo $row['id'] ?>" class="btn-secondary">Update</a>
                                                        <a href="./delete.php?id=<?php echo $row['id'] ?>" class="btn-danger">Delete</a>
                                                        <?php
                                                        // }

                                                        ?>
                                                </td>
                                            </tr>
                                    <?php }
                                                } ?>

                                    </tbody>
                                </table>
                                <div class="col-12">
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

                                </div>
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