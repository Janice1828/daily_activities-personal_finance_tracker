<?php
include("../../connection.php");
$id = $_GET['id'];
$getQuery = "SELECT date, importance, task_name, task_due_date,status, summary FROM dapf_tasks WHERE id=$id";
$data = mysqli_query($conn, $getQuery);
$result = mysqli_fetch_assoc($data);
$importances = ['low', 'Medium', 'High', 'Critical'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <div class="p-5">
        <div class="card">
            <div class="card-body">
                <div class="p-3">
                    <form class="row gap-2" method="post">
                        <div class="col-12">
                            <h2 class="page-title">Update Tasks</h2>
                        </div>
                        <div class="col-6">
                            <label for="">Task Name</label>
                            <input type="text" name="task_name" value="<?php echo $result['task_name'] ?>">
                        </div>
                        <div class="col-6">
                            <label for="">Importance</label>
                            <select id="select" name="importance" required value="<?php echo $result['importance'] ?>">

                                <?php foreach ($importances as $important) {
                                    $selected = $important == $result['importance'] ? 'selected' : '';
                                ?>
                                    <option value="<?php echo $important ?>" <?php echo $selected ?>><?php echo $important  ?></option>

                                <?php } ?>
                            </select>

                        </div>
                        <div class="col-6">
                            <label for="">Due Date</label>
                            <input type="date" name="task_due_date" value="<?php echo $result['task_due_date'] ?>">
                        </div>

                        <div class="col-6">
                            <label for="">Summary</label>
                            <textarea name="summary" id="edit_task_summary"><?php echo $result['summary'] ?></textarea>
                        </div>
                        <div class="col-6">
                            <button type="submit" name="updateactivity">Update Tasks</button>
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
    $task_name = $_POST['task_name'];
    $task_due_date = $_POST['task_due_date'];
    $importance = $_POST['importance'];
    $summary = $_POST['summary'];
    $sql = "UPDATE dapf_tasks SET task_name='$task_name', task_due_date='$task_due_date', importance='$importance',importance='$importance',summary='$summary' WHERE id=$id ";
    $sub = mysqli_query($conn, $sql);
    header("location:./view_tasks.php");
}


?>