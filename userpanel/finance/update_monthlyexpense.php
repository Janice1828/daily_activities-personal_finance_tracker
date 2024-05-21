<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <?php
    include("../../connection.php");
    $id = $_GET['id'];
    $selectQuery = "SELECT title, id FROM dapf_monthlyexpense WHERE id=$id";
    $fetch = mysqli_query($conn, $selectQuery);
    $data = mysqli_fetch_assoc($fetch);

    ?>
    <div class="p-5">

        <form class="row gap-2" method="post">
            <div class="col-12">
                <h2 class="ml-2">Update Monthly Expense</h2>
            </div>

            <div class="col-12" style="width:97%; margin:auto">
                <label for="">Title</label>
                <input type="text" name="title" value="<?php echo $data['title']; ?>">
            </div>
            <div class="col-12">
                <button type="submit" class="btn-success ml-2" name="updatemonthlyexpense">Update Monthly Expense</button>
            </div>
        </form>
    </div>
</body>

</html>

<?php
if (isset($_POST['updatemonthlyexpense'])) {
    $title = $_POST['title'];
    $update = "UPDATE dapf_monthlyexpense SET title='$title' WHERE id=$id ";
    $sub = mysqli_query($conn, $update);
    header("location:./view_monthly_expense.php");
}

?>