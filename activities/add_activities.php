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
                        <li><a href="#">Add Activities</a></li>
                        <li><a href="./view_activities.php">View Activities</a></li>
                        <li><a href="./edit_activities.php">Edit Activities</a></li>
                        <li><a href="./delete_activities.php">Delete Activities</a></li>
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

                <p>profile Icon</p>
            </nav>
            <div class="p-5">
                <div class="card">
                    <div class="card-body">
                        <div class="p-3">
                            <form class="row">
                                <div class="col-12">
                                    <h5>Add Activity</h5>
                                </div>
                                <div class="col-6">
                                    <label for="">Day</label>
                                    <input type="sunday" name="day" value="">
                                </div>
                                <div class="col-6">
                                    <label for="">Date</label>
                                    <input type="date" name="date" value="" id="date">
                                </div>
                                <div class="col-6">
                                    <label for="">Activity</label>
                                    <input type="text" name="activity" value="">
                                </div>
                                <div class="col-6">
                                    <label for="">Importance</label>
                                    <select id="select" name="importance">
                                        <option value="">Select Option</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="">Started From</label>
                                    <input type="" name="started_from" value="">
                                </div>
                                <div class="col-6">
                                    <label for="">Until</label>
                                    <input type="" name="" value="">
                                </div>
                                <div class="col-12">
                                    <label for="">Summary</label>
                                    <textarea rows="" cols=""></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="addactivity">Add Activity</button>
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
include("connection.php");
if (isset($_POST['addactivity'])) {
    $date = $_POST['date'];
    $day = $_POST['day'];
    $activity = $_POST['activity'];
    $startedFrom = $_POST['started_from'];
    $until = $_POST['until'];
    $importance = $_POST['importance'];
    print_r($_POST);
    $hash_pw = sha1($password);
    $sql = "INSERT INTO dapf_activities(date, day, activity, started_from, until, importance) VALUES ('$date', '$day','$activity', '$startedFrom','$until','$importance')";
    $sub = mysqli_query($conn, $sql);
    if ($sub) {
        echo "success";
    } else {
        echo "failed";
    }
    // header("location:fetch.php");
}

?>
<script>
    let date = new Date();
    document.getElementById("date").value = "12/2/2002"
    // console.log(date.get());
</script>