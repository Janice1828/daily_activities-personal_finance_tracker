<?php
include("../connection.php");
$selectQuery = "SELECT fullname, email, usertype FROM users";
$fetch = mysqli_query($conn, $selectQuery);

?>
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
                <div class="sidebar-finance">
                    <ul>
                        <h2>Daily Activities & Personal Finance Tracker</h2>
                        <li><a href="#">User Lists</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-9">
            <nav class="d-flex position-sticky">
                <a href="../login.php">Log out</a>
                <p>Profile</p>
            </nav>
            <div class="p-5">
                <div class="card">
                    <div class="card-body">
                        <div class="p-3">
                            <form class="row gap-2">
                                <div class="col-12">
                                    <h2>User Lists</h2>
                                </div>
                                <table class="col-12" border="1" cellpadding="10" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($fetch)) {
                                            if ($row['usertype'] != "admin") {
                                        ?>
                                                <tr>
                                                    <td><?php echo ++$i; ?></td>
                                                    <td><?php echo $row['fullname'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
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