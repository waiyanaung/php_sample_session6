<?php

include_once("header.php");
include('check_session.php');

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM products WHERE login_id=" . $_SESSION['id'] . " ORDER BY id DESC");
?>


<div class="jumbotron text-center">
    <h3>Products</h3>
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
        <div class="col-sm-3">
            <a class="btn btn-primary form-control" href="product_create.php">Add New Product</a>
        </div>
    </div>
    </br>


    <div class="row">

        <div class="col-sm-12">

            <table id="my_table" class="display table" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($res = mysqli_fetch_array($result)) {

                        echo "<tr>";

                        echo "<td><a href=\"product_edit.php?id=$res[id]\">" . $res['id'] . "</a></td>";
                        echo "<td><a href=\"product_edit.php?id=$res[id]\">" . $res['sku'] . "</a></td>";
                        echo "<td><a href=\"product_edit.php?id=$res[id]\">" . $res['name'] . "</a></td>";

                        echo "<td><a href=\"product_edit.php?id=$res[id]\">";
                        if ($res['status'] == 1) {
                            echo "Active";
                        } else {
                            echo "In-Active";
                        }

                        echo "</a></td>";

                        echo "<td><a href=\"product_edit.php?id=$res[id]\">" . $res['price'] . "</a></td>";
                        echo '<td><img class="img-responsive" src="uploads/' . $res['image'] . '" width="40" height="40"></td>';
                        echo "<td><a href=\"product_edit.php?id=$res[id]\">Edit</a></td>";
                        echo "<td><a href=\"product_delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">De-activate</a></td>";
                    }
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Image</th>
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