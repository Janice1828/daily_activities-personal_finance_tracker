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
                        <li><a href="./add_finance.php">Add Income/Expenses</a></li>
                        <li><a href="#">View Income/Expenses</a></li>
                        <li><a href="./edit_finance.php">Edit Income/Expenses</a></li>
                        <li><a href="./delete_finance.php">Delete Income/Expenses</a></li>
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
                                    <h2>Delete Finance</h2>
                                </div>
                                <table class="col-12" border="1" cellpadding="10" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Date</th>
                                            <th>Money Spent</th>
                                            <th>Spent On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2024/4/2</td>
                                            <td>2000</td>
                                            <td>Book Purchasing</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>2024/4/2</td>
                                            <td>2000</td>
                                            <td>Book Purchasing</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>2024/4/2</td>
                                            <td>2000</td>
                                            <td>Book Purchasing</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>2024/4/2</td>
                                            <td>2000</td>
                                            <td>Book Purchasing</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</body>