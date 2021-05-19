<?php
error_reporting(0);
include('header.php');

//including the database connection file
include_once("config/connection.php");

$transaction_id = $_REQUEST['id'];

?>
<hr class="featurette-divider">

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-inverse" style="background:#04B745;">
                <div class="container-fluid pull-left" style="width:300px;">
                    <div class="navbar-header">
                        <span style="color:#FFFFFF;">Payment</span>
                    </div>
                </div>
                <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="product_list.php" class="btn btn-info">New Order</a></div>
            </nav>

        </div>
    </div>
    <br>

    <?php if (!empty($_SESSION['products'])) : ?>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th align="right">Price</th>
                            <th align="right">Qty</th>
                            <th align="right">Amount</th>
                        </tr>
                    </thead>

                    <?php foreach ($_SESSION['products'] as $key => $product) : ?>

                        <?php
                        $img_src = "backend/uploads/default_images/1.jpg";
                        if ($product['image'] != "") {
                            $img_src = 'backend/uploads/' . $product['image'];
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
                    <?php endforeach; ?>

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
                                <select name="payment_type" class="form-control">
                                    <option value="0" disabled>Select One Pyament Type</option>
                                    <option selected value="1">Cash On Delivery</option>
                                    <option value="2">Bank Transfer</option>
                                    <option value="3">With Paypal</option>
                                </select>
                            </td>
                    </tr>

                    <tr>
                        <td colspan="6" align="right">
                            <input type="hidden" name="checkout" value="checkout">
                            <input type="hidden" name="id" value="<?php echo $transaction_id; ?>">

                            <button onClick="return confirm('Are you sure you want to submit?')" type="submit" class="btn btn-info">Submit Payment</button>
                        </td>
                        </form>

                    </tr>
                </table>


            <?php endif; ?>
            </div>
        </div>

</div>

<?php
include('footer.php');
?>