<?php
error_reporting(0);

include('header.php');

//including the database connection file
include_once("config/connection.php");

//Get all Products
$query = "SELECT * FROM products";
$stmt = $conn->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll();

?>


<hr class="featurette-divider">

<div class="container marketing">

    <div class="row">
        <?php foreach ($products as $product) : ?>

            <?php
            $img_src = "backend/uploads/default_images/1.jpg";
            if ($product['image'] != "") {
                $img_src = 'backend/uploads/' . $product['image'];
            }
            ?>

            <div class="col-lg-4 border">
                <a href="product_detail.php?id=<?php echo $product['id']; ?>">
                    <img class="img-responsive" src="<?php echo $img_src; ?>" width="100%" height="60%">
                </a>
                <p class="text-primary"> <?php echo $product['name']; ?></p>
                <p class="text-primary"><small class="text-muted">$ <?php echo $product['price']; ?></small></p>

                <form method="post" action="product_cart_checkout.php?action=addcart">
                    <p style="text-align:center;color:#04B745;">
                        <button type="submit" class="btn btn-secondary form-control">Add To Cart</button>
                        <input type="hidden" name="id" value="<?php print $product['id'] ?>">
                    </p>
                </form>



            </div>

        <?php endforeach; ?>

    </div><!-- /.row -->

    <hr class="featurette-divider">

</div><!-- /.container -->

<?php
include('footer.php');
?>