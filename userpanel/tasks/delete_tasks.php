<?php
include("../../connection.php");
$selectQuery = "SELECT id,date, task_name, task_due_date, importance FROM dtpf_tasks";
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
        <div class="col-3">
            <div class="sidebar">
                <div class="sidebar-activities">
                    <ul>
                        <h2>Activities</h2>
                        <li><a href="./add_tasks.php">Add Tasks</a></li>
                        <li><a href="./view_tasks.php">View Activities</a></li>
                        <li><a href="#">Delete Tasks</a></li>
                        <li><a href="#">Completed Tasks</a></li>
                    </ul>
                </div>

                <div class="sidebar-finance">
                    <ul>
                        <h2>Finance</h2>
                        <li><a href="../finance/add_finance.php">Add Income/Expenses</a></li>
                        <li><a href="../finance/view_finance.php">View Income/Expenses</a></li>
                        <li><a href="../finance/edit_finance.php">Edit Income/Expenses</a></li>
                        <li><a href="../finance/delete_finance.php">Delete Income/Expenses</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-9">
            <nav class="d-flex position-sticky">

                <p>Profile</p>
            </nav>
            <div class="p-5">
                <div class="card">
                    <div class="card-body">
                        <div class="p-3">
                            <form class="row gap-2">
                                <div class="col-12">
                                    <h2>Delete Activity</h2>
                                </div>
                                <table class="col-12" border="1" cellpadding="10" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Date</th>
                                            <th>Task Name</th>
                                            <th>Task Due Date</th>
                                            <th>Importance</th>
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
                                                <td><?php echo $row['date'] ?></td>
                                                <td><?php echo $row['task_name'] ?></td>
                                                <td><?php echo $row['task_due_date']  ?></td>
                                                <td><?php echo $row['importance']  ?></td>
                                                <td><a class="btn-danger" href="./delete.php?id=<?php echo $row['id'] ?>">Delete</a></td>
                                                <!-- <a href="edit.php?id=  -->
                                                <?php
                                                // echo $row['id'];
                                                ?>
                                                <!-- ">Edit</a> -->
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