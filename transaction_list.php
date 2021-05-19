<?php

include('header.php');

//including the database connection file
include_once("config/connection.php");

$login_id = $_SESSION['id'];

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "
SELECT t.*,u.name as user_name FROM 
transactions AS t 
LEFT JOIN users AS u
ON u.id = t.login_id
WHERE t.login_id = '$login_id' 
ORDER BY t.id DESC
");
?>

<div class="jumbotron text-center">
    <h3>Transactions</h3>
</div>

<div class="container">


    <!-- for validation error show case -->
    <?php
    if (isset($_SESSION['messages']) && $_SESSION['messages'] != "") { ?>

        <div class="row">
            <div class="col-sm-12 border border-primary">
                <?php
                echo $_SESSION['messages'];
                $_SESSION['messages'] = "";
                ?>
            </div>
        </div>
        <br /><br />
    <?php } ?>
    <!-- for validation error show case -->

    <div class="row">

        <div class="col-sm-12">

            <table id="my_table" class="display table" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($res = mysqli_fetch_array($result)) {

                        echo "<tr>";

                        echo "<td><a href=\"transaction_show.php?id=$res[id]\">" . $res['id'] . "</a></td>";
                        echo "<td><a href=\"transaction_show.php?id=$res[id]\">" . $res['user_name'] . "</a></td>";

                        echo "<td><a href=\"transaction_show.php?id=$res[id]\">";
                        echo $status_transaction[$res['status']];
                        echo "</a></td>";

                        echo "<td><a href=\"transaction_show.php?id=$res[id]\">" . $res['date'] . "</a></td>";

                        echo "<td><a href=\"transaction_show.php?id=$res[id]\">" . $res['subtotal'] . "</a></td>";

                        echo "<td><a href=\"transaction_show.php?id=$res[id]\">View</a></td>";
                    }
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>


        </div>

    </div>

    <?php
    include('footer.php');
    ?>

    <script>
        $(document).ready(function() {
            $('#my_table').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>