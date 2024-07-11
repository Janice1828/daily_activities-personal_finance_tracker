<?php
session_start();
$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];
include("../../connection.php");
if (isset($_POST['updateexpenses'])) {
    $moneySpent = $_POST['money_spent'];
    $spentOn = $_POST['spent_on'];
    $summary = $_POST['summary'];
    $updateQuery = "UPDATE dapf_expense SET money_spent='$moneySpent', spent_on='$spentOn',summary='$summary' WHERE id='$id'";
    // $sql = "INSERT INTO dapf_expense(date, money_spent, spent_on, summary, user_id) VALUES ('$date','$moneySpent', '$spentOn','$summary','$user_id')";
    $sub = mysqli_query($conn, $updateQuery);
    header("location:./view_expense.php");
}
$getexpenses = "SELECT id, user_id, title FROM dapf_monthlyexpense WHERE user_id=$user_id";
$data = mysqli_query($conn, $getexpenses);
$fetch_expense_query = "SELECT * FROM dapf_expense WHERE id='$id'";
$expense_execute = mysqli_query($conn, $fetch_expense_query);
$expense = mysqli_fetch_assoc($expense_execute);
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

        <div class="col-12">
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
                <h4 style="display:flex; justify-content:flex-end; padding:0px 0px 20px 0px;">Date: &nbsp;<span id="displayDate" style="font-weight: 400;"></span></h4>
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <form class="row gap-2" method="post">
                                <div class="col-12">
                                    <h2 class="page-title">Update Expense</h2>
                                </div>
                                <input type="date" name="date" value="" id="date" readonly hidden>
                                <div class="col-6" style="transform: translateX(-24px);">
                                    <label for="">Money Spent</label>
                                    <input type="text" name="money_spent" value="<?php echo $expense['money_spent'] ?>" required>
                                </div>
                                <div class="col-6" style="transform: translateX(20px);">
                                    <label for="">Money Spent On</label>

                                    <select name="spent_on" id="select" required>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($data)) {
                                            $selected = $row['id'] == $expense['spent_on'] ? 'selected' : '';
                                        ?>
                                            <option <?php echo $selected ?> value="<?php echo $row['id'] ?>"><?php echo $row['title'] ?></option>
                                        <?php } ?>
                                    </select>


                                </div>
                                <div class="col-12">
                                    <label for="">Summary</label>
                                    <textarea rows="" cols="" name="summary"><?php echo $expense['summary'] ?></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-success" name="updateexpenses">Update Expense</button>
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