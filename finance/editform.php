<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php
    include("../connection.php");
    $id = $_GET['id'];
    $selectQuery = "SELECT day, date, money_spent, spent_on, summary FROM dapf_finance WHERE id=$id";
    $fetch = mysqli_query($conn, $selectQuery);
    // print_r($fetch);
    $data = mysqli_fetch_assoc($fetch);

    ?>
    <div class="p-5">

        <form class="row gap-2" method="post">
            <div class="col-12">
                <h2>Add Finance</h2>
            </div>
            <div class="col-6">
                <label for="">Day</label>
                <input type="sunday" name="day" value="<?php echo $data['day'] ?>">
            </div>
            <div class="col-6">
                <label for="">Date</label>
                <input type="date" name="date" value="<?php echo $data['date'] ?>" id="date" readonly>
            </div>
            <div class="col-6">
                <label for="">Money Spent</label>
                <input type="text" name="money_spent" value="<?php echo $data['money_spent'] ?>">
            </div>

            <div class="col-6">
                <label for="">Money Spent On</label>
                <input type="text" name="spent_on" value="<?php echo $data['spent_on'] ?>">
            </div>

            <div class="col-12">
                <label for="">Summary</label>
                <textarea rows="" cols="" name="summary"><?php echo $data['summary'] ?></textarea>
            </div>
            <div class="col-12">
                <button type="submit" name="updatefinance">Update Finance</button>
            </div>
        </form>
    </div>
</body>

</html>

<?php
if (isset($_POST['updatefinance'])) {
    $day = $_POST['day'];
    $date = $_POST['date'];
    $moneySpent = $_POST['money_spent'];
    $spentOn = $_POST['spent_on'];
    $summary = $_POST['summary'];
    $update = "UPDATE dapf_finance SET day='$day', date='$date', money_spent='$moneySpent',spent_on='$spentOn',summary='$summary' WHERE id=$id ";
    $sub = mysqli_query($conn, $update);
    header("location:./edit_finance.php");
}

?>