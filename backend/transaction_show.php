<?php
include 'header.php';
include('check_session.php');

if (isset($_GET['id'])) {
    //getting id from url
    $id = $_GET['id'];
    $total = 0;

    //fetching data in descending order (lastest entry first)
    $result = mysqli_query($mysqli, "
    SELECT t.*,u.name as user_name, p.payment_type AS payment_type  
    FROM 
    transactions AS t 
    LEFT JOIN users AS u
    ON u.id = t.login_id
    LEFT JOIN transaction_payment AS p
    ON p.transaction_id = t.id
    WHERE t.id = '$id'
    ");

    while ($res = mysqli_fetch_array($result)) {
        $id = $res['id'];
        $username = $res['user_name'];
        $date = $res['date'];
        $subtotal = $res['subtotal'];
        $status = $status_transaction[$res['status']];
        if ($res['payment_type'] != "") {
            $payment_type = $type_payment[$res['payment_type']];
        } else {
            $payment_type = "No Payment Yet";
        }
    }


    //fetching data in descending order (lastest entry first)
    $result_items = mysqli_query($mysqli, "
        SELECT t.*,p.name as name, p.image AS image
        FROM 
        transaction_item AS t 
        LEFT JOIN products AS p
        ON p.id = t.product_id
        WHERE t.transaction_id = '$id'
        ORDER BY t.id DESC
    ");

    //selecting product types data
    // $product_types = mysqli_query($mysqli, "SELECT * FROM product_type");
}
?>

<div class="jumbotron text-center">
    <h3>Transaction Show</h3>
</div>

<div class="container">
    <?php include('check_error.php'); ?>

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

        <div class="col-sm-4">
            <label>Transaction iD</label>
            <input class="form-control" type="text" id="id" name="id" value="<?php echo $id; ?>" readonly>
        </div>

        <div class="col-sm-4">
            <label>Customer Name</label>
            <input class="form-control" type="text" id="username" name="username" value="<?php echo $username; ?>" readonly>
        </div>

        <div class="col-sm-4">
            <label>Transaction Status</label>
            <input class="form-control" type="text" id="status" name="status" value="<?php echo $status; ?>" readonly>
        </div>

    </div>
    <br>

    <div class="row">

        <div class="col-sm-4">
            <label>Transaction Date</label>
            <input class="form-control" type="text" id="date" name="date" value="<?php echo $date; ?>" readonly>
        </div>

        <div class="col-sm-4">
            <label>Transaction Subtotal</label>`
            <input class="form-control" type="text" id="subtotal" name="subtotal" value="<?php echo $subtotal; ?>" readonly>
        </div>

    </div>
    <br>

    <div class="row">

        <div class="col-sm-12">

            <table id="my_table" class="display table" width="100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    while ($product = mysqli_fetch_array($result_items)) {
                        $img_src = "uploads/default_images/1.jpg";
                        if ($product['image'] != "") {
                            $img_src = 'uploads/' . $product['image'];
                        }
                    ?>

                        <tr>
                            <td><img src="<?php print $img_src ?>" width="50"></td>
                            <td><?php print $product['name'] ?></td>
                            <td align="right">$<?php print $product['price'] ?></td>
                            <td align="right"><?php print $product['qty'] ?></td>
                            <td align="right"><?php print $product['qty'] * $product['price'] ?></td>
                        </tr>

                        <?php $total = $total + ($product['price'] * $product['qty']); ?>
                    <?php } ?>

                    <?php $_SESSION['products']  = []; ?>
                    <tr>
                        <td colspan="4" align="right">
                            Total
                        </td>
                        <td align="right">
                            <h6>$ <?php print $total ?></h6>
                        </td>

                    </tr>

                    <tr>
                        <form method="post" action="product_cart_payment.php">
                            <td colspan="4" align="right">
                                Payment Type
                            </td>
                            <td align="right">
                                <?php echo $payment_type; ?>
                            </td>
                    </tr>

                    <tr>
                        <form method="post" action="product_cart_payment.php">
                            <td colspan="4" align="right">
                                Transaction Status
                            </td>
                            <td align="right">
                                <?php echo $status; ?>
                            </td>
                    </tr>

                </tbody>

                <tfoot>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                </tfoot>
            </table>


        </div>


    </div>

    <div class="row">
        <div class="col-sm-10">
        </div>

        <div class="col-sm-2">
            <a class="btn btn-secondary form-control" href="transaction_list.php">Go Back to List</a>
        </div>

    </div>
    </br>
    <?php
    include 'footer.php';
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