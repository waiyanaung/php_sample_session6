<?php
include('header.php');

//including the database connection file
include_once("config/connection.php");

$id = $_REQUEST['id'];

//fetching data in descending order (lastest entry first)
//$result = mysqli_query($mysqli, "SELECT * FROM products WHERE id = ". $id);

$query = "SELECT p.*,pt.name  AS product_type_name
	FROM 
	products  AS p
	JOIN product_type AS pt
	ON p.`type` = pt.id
	WHERE p.id = $id";
$result = mysqli_query($mysqli, $query);
?>

<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">

    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <!-- Three columns of text below the carousel -->

    <?php
    while ($res = mysqli_fetch_array($result)) {

        $img_src = "backend/uploads/default_images/2.jpg";
        if ($res['image'] != "") {
            $img_src = 'backend/uploads/' . $res['image'];
        }
    ?>

        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary text-center" role="alert">

                    <?php
                    echo $res['name'];
                    ?>
                </div>
            </div>



            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>Color</td>
                        <td><?php
                            if ($res['color'] == 1) {
                                echo "White";
                            } else if ($res['color'] == 2) {
                                echo "Black";
                            } else if ($res['color'] == 3) {
                                echo "Green";
                            } else if ($res['color'] == 4) {
                                echo "Yellow";
                            } else if ($res['color'] == 5) {
                                echo "Red";
                            } else if ($res['color'] == 6) {
                                echo "Blue";
                            } else {
                                echo "Undefined Color";
                            }
                            ?></td>
                    </tr>

                    <tr>
                        <td>Type</td>
                        <td><?php echo $res['product_type_name']; ?></td>
                    </tr>

                    <tr>
                        <td>Description</td>
                        <td><?php $res['description']; ?> </td>
                    </tr>

                    <tr>
                        <td>Remark</td>
                        <td><?php echo $res['remark']; ?></td>
                    </tr>

                </table>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <img class="center featurette-image img-fluid" src="<?php echo $img_src; ?>">
            </div>
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


<style>
    img.img-responsive {
        display: block;
        max-width: 100%;
        height: auto;
    }

    .img-fluid {
        max-width: 100%;
        height: auto
    }
</style>