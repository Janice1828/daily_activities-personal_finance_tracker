<?php
session_start();
$id = $_GET['id'];
$login_status = $_SESSION['logged_in'];
if ($login_status != "true") {
    header("location:../../login.php");
}
$user_id = $_SESSION['user_id'];
include("../../connection.php");
if (isset($_POST['updateallocation'])) {
    $allocation_for = $_POST['allocation_for'];
    $estimated_money = $_POST['estimated_money'];
    $sql = "UPDATE dapf_allocatebudget SET allocation_for='$allocation_for',estimated_money='$estimated_money' WHERE id='$id'";
    $sub = mysqli_query($conn, $sql);
    header("location:./view_allocatedbudget.php");
}
$fetch_expenses = "SELECT id, title FROM dapf_monthlyexpense WHERE user_id=$user_id";
$get_expenses = mysqli_query($conn, $fetch_expenses);
$allocated_budget_query = "SELECT id, user_id, allocation_for,estimated_money FROM dapf_allocatebudget WHERE id='$id'";
$allocated_budget = mysqli_query($conn, $allocated_budget_query);
$get_allocated_budget = mysqli_fetch_assoc($allocated_budget);
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
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <form class="row gap-2" method="post">
                                <div class="col-12">
                                    <h2 class="page-title">Allocate Budget</h2>
                                </div>
                                <div class="col-6" style="transform:translateX(-25px)">
                                    <label for="">Allocation For</label>
                                    <select id="select" name="allocation_for" value="<?php echo $get_allocated_budget['allocation_for'] ?>" required>
                                        <?php while ($data = mysqli_fetch_assoc($get_expenses)) {
                                            $selected = ($data['id'] == $get_allocated_budget['allocation_for']) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['title']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-6" style="transform:translateX(25px)">
                                    <label for="">Estimated Money</label>
                                    <input type="number" name="estimated_money" value="<?php echo $get_allocated_budget['estimated_money']; ?>" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-success" name="updateallocation">Update</button>
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