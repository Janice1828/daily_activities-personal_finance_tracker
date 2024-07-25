<?php
include "../../connection.php";
$file_name = "tasks_" . date("Y-m-d") . ".csv";

$delimiter = ",";
$f = fopen('php://memory', 'w');
$fields = array('id', 'date', 'task_name', 'task_due_date', 'importance', 'status', 'summary');
fputcsv($f, $fields, $delimiter);
$result = $conn->query("SELECT * FROM dapf_tasks WHERE user_id='$user_id' AND date>='$to_date' AND date<='$from_date'");
$id = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lineData = array(++$id, $row['date'], $row['task_name'], $row['task_due_date'], $row['importance'], $row['status'], $row['summary']);
        fputcsv($f, $lineData, $delimiter);
    }
}
fseek($f, 0);
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $file_name . '";');
fpassthru($f);
exit();
