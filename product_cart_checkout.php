<?php
error_reporting(0);
include('header.php');

//including the database connection file
include_once("config/connection.php");
$connection = $conn;

$total = 0;

//Get all Products
$query = "SELECT * FROM products";
$stmt = $conn->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll();

//get action string
$action = isset($_GET['action']) ? $_GET['action'] : "";

//Add to cart
if ($action == 'addcart' && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    //Finding the product by code
    $query = "SELECT * FROM products WHERE id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam('id', $id);
    $stmt->execute();
    $product = $stmt->fetch();

    $currentQty = $_SESSION['products'][$id]['qty'] + 1; //Incrementing the product qty in cart
    $_SESSION['products'][$id] = array('qty' => $currentQty, 'name' => $product['name'], 'image' => $product['image'], 'price' => $product['price']);
    $product = '';
    header("Location:product_cart_checkout.php");
}

// Remove fromcart
if ($action == 'removecart' && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    //Finding the product by code
    $query = "SELECT * FROM products WHERE id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam('id', $id);
    $stmt->execute();
    $product = $stmt->fetch();

    $currentQty = $_SESSION['products'][$id]['qty'] - 1; //Decrease the product qty in cart
    if ($currentQty <= 0) {
        $products = $_SESSION['products'];
        unset($products[$id]);
        $_SESSION['products'] = $products;
        header("Location:product_cart_checkout.php");
    } else {
        $_SESSION['products'][$id] = array('qty' => $currentQty, 'name' => $product['name'], 'image' => $product['image'], 'price' => $product['price']);
        $product = '';
        header("Location:product_cart_checkout.php");
    }
}

//Empty All
if ($action == 'emptyall') {
    $_SESSION['products'] = array();
    header("Location:product_cart_checkout.php");
}

//Empty one by one 
if ($action == 'empty') {
    $id = $_GET['id'];
    $products = $_SESSION['products'];
    unset($products[$id]);
    $_SESSION['products'] = $products;
    header("Location:product_cart_checkout.php");
}


?>
<hr class="featurette-divider">

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-inverse" style="background:#04B745;">
                <div class="container-fluid pull-left" style="width:300px;">
                    <div class="navbar-header">
                        <span style="color:#FFFFFF;">Shopping Cart</span>
                    </div>
                </div>
                <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="product_cart_checkout.php?action=emptyall" class="btn btn-info">Empty cart</a></div>
            </nav>

        </div>
    </div>
    <br>

    <?php if (!empty($_SESSION['products'])) : ?>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th></th>
                            <th></th>
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
                            <td>
                                <form method="post" action="product_cart_checkout.php?action=addcart">
                                    <p style="text-align:center;color:#04B745;">
                                        <button type="submit" class="btn-info">+</button>
                                        <input type="hidden" name="id" value="<?php print $key ?>">
                                    </p>
                                </form>
                            </td>
                            <td><img src="<?php print $img_src ?>" width="50"></td>
                            <td><?php print $product['name'] ?></td>
                            <td align="right">$<?php print $product['price'] ?></td>
                            <td align="right"><?php print $product['qty'] ?></td>
                            <td align="right"><?php print $product['qty'] * $product['price'] ?></td>
                            <td>
                                <form method="post" action="product_cart_checkout.php?action=removecart">
                                    <p style="text-align:center;color:#04B745;">
                                        <button type="submit" class="btn-info">-</button>
                                        <input type="hidden" name="id" value="<?php print $key ?>">
                                    </p>
                                </form>
                            </td>
                            <td>
                                <a href="product_cart_checkout.php?action=empty&id=<?php print $key ?>" class="btn btn-secondary">Remove</a>
                            </td>
                        </tr>
                        <?php $total = $total + ($product['price'] * $product['qty']); ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="5" align="right">
                            Total
                        </td>
                        <td align="right">
                            <h6>$ <?php print $total ?></h6>
                        </td>
                        <td></td>
                        <td>
                            <?php
                            if (isset($_SESSION['valid'])) {
                            ?>
                                <form method="post" action="product_cart_checkout_action.php">
                                    <input type="hidden" name="checkout" value="checkout">
                                    <button onClick="return confirm('Are you sure you want to submit?')" type="submit" class="btn btn-info">Checkout</button>
                                </form>
                            <?php } else { ?>
                                <p class="text-warning"> <a href="login.php" class="btn btn-info"> Please, login to continue.</a></p>

                            <?php } ?>
                        </td>

                    </tr>
                </table>


            <?php endif; ?>
            </div>
        </div>

</div>

<?php
include('footer.php');
?>