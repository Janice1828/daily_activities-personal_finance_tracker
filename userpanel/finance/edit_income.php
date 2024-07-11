<?php
session_start();
$login_status = $_SESSION['logged_in'];
$id = $_GET['id'];
if ($login_status != "true") {
    header("location:../../login.php");
}
include("../../connection.php");
$user_id = $_SESSION['user_id'];
if (isset($_POST['updateincome'])) {
    $incomed_money = $_POST['incomed_money'];
    $incomed_from = $_POST['incomed_from'];
    $summary = $_POST['summary'];
    $updateQuery = "UPDATE dapf_income SET incomed_money='$incomed_money', incomed_from='$incomed_from',summary='$summary' WHERE id='$id'";
    // $sql = "INSERT INTO dapf_income(date, incomed_money, incomed_from, summary,user_id) VALUES ('$date','$incomed_money', '$incomed_from','$summary','$user_id')";
    $sub = mysqli_query($conn, $updateQuery);
    header("location:./view_income.php");
}
$fetch_monthly_income = "SELECT id, title FROM dapf_monthlyincome WHERE user_id=$user_id";
$income_sources = mysqli_query($conn, $fetch_monthly_income);
$income_query = "SELECT * FROM dapf_income WHERE id='$id'";
$execute_income_query = mysqli_query($conn, $income_query);
$incomes = mysqli_fetch_assoc($execute_income_query);
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
                                    <h2 class="page-title">Update Income</h2>
                                </div>

                                <input type="date" name="date" value="" id="date" readonly hidden>
                                <div class="col-6" style="transform:translateX(-22px)">
                                    <label for="">Incomed Money</label>
                                    <input type="text" name="incomed_money" value="<?php echo $incomes['incomed_money'] ?>" required>
                                </div>
                                <div class="col-6" style="transform:translateX(22px)">
                                    <label for="">Income Source</label>

                                    <select name="incomed_from" id="select" required>
                                        <?php while ($row = mysqli_fetch_assoc($income_sources)) {
                                            $selected = $row['title'] == $incomes['incomed_from'] ? 'selected' : '';
                                        ?>
                                            <option <?php echo $selected ?> value="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></option>
                                        <?php }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="">Summary</label>
                                    <textarea rows="" cols="" name="summary"><?php echo $incomes['summary'] ?></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-success" name="updateincome">Update Income</button>
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