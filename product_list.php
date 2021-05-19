<?php
include('header.php');

//including the database connection file
include_once("config/connection.php");

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "	SELECT * FROM products WHERE status = 1 ORDER BY id DESC");
?>

<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">

    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <!-- Three columns of text below the carousel -->
    <div class="row">
        <?php
        while ($res = mysqli_fetch_array($result)) {
            $img_src = "backend/uploads/default_images/1.jpg";
            if ($res['image'] != "") {
                $img_src = 'backend/uploads/' . $res['image'];
            }
        ?>
            <div class="col-lg-4">
                <a href="product_detail.php?id=<?php echo $res['id']; ?>">
                    <img class="img-responsive" src="<?php echo $img_src; ?>" width="100%" height="60%">
                    <h6> <?php echo $res['name']; ?></h6>
                </a>
                <a class="btn btn-secondary form-control" href="product_detail.php?id=<?php echo $res['id']; ?>" role=" button">Add To Cart</a>
            </div>
        <?php
        }
        ?>

    </div><!-- /.row -->

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

</div><!-- /.container -->

<?php
include('footer.php');
?>