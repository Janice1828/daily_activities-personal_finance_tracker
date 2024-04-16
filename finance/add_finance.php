<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daily Activities & Personal Finance Tracker</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="row">
        <div class="col-3">
            <div class="sidebar">
                <div class="sidebar-activities">
                    <ul>
                        <h2>Activities</h2>
                        <li><a href="../activities/add_activities.php">Add Activities</a></li>
                        <li><a href="../activities/view_activities.php">View Activities</a></li>
                        <li><a href="../activities/edit_activities.php">Edit Activities</a></li>
                        <li><a href="../activities/delete_activities.php">Delete Activities</a></li>
                    </ul>
                </div>

                <div class="sidebar-finance">
                    <ul>
                        <h2>Finance</h2>
                        <li><a href="#">Add Income/Expenses</a></li>
                        <li><a href="./view_finance.php">View Income/Expenses</a></li>
                        <li><a href="./edit_finance.php">Edit Income/Expenses</a></li>
                        <li><a href="./delete_finance.php">Delete Income/Expenses</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-9">
            <nav class="d-flex position-sticky">
                <p>profile</p>
            </nav>
            <div class="p-5">
                <div class="card">
                    <div class="card-body">
                        <div class="p-3">
                            <form class="row gap-2" method="post">
                                <div class="col-12">
                                    <h2>Add Finance</h2>
                                </div>
                                <div class="col-6">
                                    <label for="">Day</label>
                                    <input type="sunday" name="day" value="">
                                </div>
                                <div class="col-6">
                                    <label for="">Date</label>
                                    <input type="date" name="date" value="" id="date" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="">Money Spent</label>
                                    <input type="text" name="money_spent" value="">
                                </div>

                                <div class="col-6">
                                    <label for="">Money Spent On</label>
                                    <input type="text" name="spent_on" value="">
                                </div>

                                <div class="col-12">
                                    <label for="">Summary</label>
                                    <textarea rows="" cols="" name="summary"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="addfinance">Add Finance</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
<?php
include("../connection.php");
if (isset($_POST['addfinance'])) {
    $day = $_POST['day'];
    $date = $_POST['date'];
    $moneySpent = $_POST['money_spent'];
    $spentOn = $_POST['spent_on'];
    $summary = $_POST['summary'];
    $sql = "INSERT INTO dapf_finance(day, date, money_spent, spent_on, summary) VALUES ('$day', '$date','$moneySpent', '$spentOn','$summary')";
    $sub = mysqli_query($conn, $sql);
}

?>
<script>
    let date = new Date();
    let d = date.getDate();
    const month = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    let getMonth = month[date.getMonth()];
    let year = date.getFullYear();
    if (getMonth < 10) {
        getMonth = "0" + getMonth;
    }
    if (d < 10) {
        d = "0" + d;
    }
    document.getElementById("date").value = `${year}-${getMonth}-${d}`;
</script>