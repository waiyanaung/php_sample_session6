<?php

include_once("header.php");
include('check_session.php');

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC");
?>


<div class="jumbotron text-center">
    <h3>Users</h3>
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
                        <th>Name</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($res = mysqli_fetch_array($result)) {

                        echo "<tr>";

                        echo "<td><a href=\"user_show.php?id=$res[id]\">" . $res['id'] . "</a></td>";
                        echo "<td><a href=\"user_show.php?id=$res[id]\">" . $res['name'] . "</a></td>";

                        echo "<td><a href=\"user_show.php?id=$res[id]\">";
                        if ($res['status'] == 1) {
                            echo "Active";
                        } else {
                            echo "In-Active";
                        }
                        echo "</a></td>";

                        echo "<td><a href=\"user_show.php?id=$res[id]\">" . $res['email'] . "</a></td>";

                        echo "<td><a href=\"user_show.php?id=$res[id]\">";
                        if ($res['role_id'] == 1) {
                            echo "Admin";
                        } else {
                            echo "Customer";
                        }
                        echo "</a></td>";

                        echo "<td><a href=\"user_show.php?id=$res[id]\">View</a></td>";
                        echo "<td><a href=\"user_delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">De-activate</a></td>";
                    }
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
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