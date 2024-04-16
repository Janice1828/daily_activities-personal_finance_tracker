<?php
include("../connection.php");
$id = $_GET['id'];
$getQuery = "SELECT date, day, activity, started_from, until,summary FROM dapf_activities WHERE id=$id";
$data = mysqli_query($conn, $getQuery);
$result = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="p-5">
        <div class="card">
            <div class="card-body">
                <div class="p-3">
                    <form class="row gap-2" method="post">
                        <div class="col-12">
                            <h2>Add Activity</h2>
                        </div>
                        <div class="col-6">
                            <label for="">Day</label>
                            <input type="sunday" name="day" value="<?php echo $result['day'] ?>">
                        </div>
                        <div class="col-6">
                            <label for="">Date</label>
                            <input type="date" name="date" value="<?php echo $result['date'] ?>" id="date" readonly>
                        </div>
                        <div class="col-6">
                            <label for="">Activity</label>
                            <input type="text" name="activity" value="<?php echo $result['activity'] ?>">
                        </div>
                        <div class="col-6">
                            <label for="">Importance</label>
                            <select id="select" name="importance" value="<?php echo $result['importance'] ?>">
                                <option value="">Select Option</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="">Started From</label>
                            <input type="" name="started_from" value="<?php echo $result['started_from'] ?>">
                        </div>
                        <div class="col-6">
                            <label for="">Until</label>
                            <input type="" name="until" value="<?php echo $result['until'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="">Summary</label>
                            <textarea name="summary"><?php echo $result['summary'] ?></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="updateactivity">Add Activity</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>

</body>

</html>
<?php
if (isset($_POST['updateactivity'])) {
    $date = $_POST['date'];
    $day = $_POST['day'];
    $activity = $_POST['activity'];
    $startedFrom = $_POST['started_from'];
    $until = $_POST['until'];
    $importance = $_POST['importance'];
    $summary = $_POST['summary'];
    $sql = "UPDATE dapf_activities SET date='$date', day='$day', activity='$activity', started_from='$startedFrom',until='$until',importance='$importance',summary='$summary' WHERE id=$id ";
    $sub = mysqli_query($conn, $sql);
    header("location:./edit_activities.php");
}


?>