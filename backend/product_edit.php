<?php
include 'header.php';
include('check_session.php');

if (isset($_GET['id'])) {
    //getting id from url
    $id = $_GET['id'];

    //selecting data associated with this particular id
    $result = mysqli_query($mysqli, "SELECT * FROM products WHERE id=$id");

    while ($res = mysqli_fetch_array($result)) {
        $id = $res['id'];
        $sku = $res['sku'];
        $name = $res['name'];
        $qty = $res['qty'];
        $price = $res['price'];
        $image = $res['image'];
        $color = $res['color'];
        $type = $res['type'];
        $description = $res['description'];
        $remark = $res['remark'];
        $status = $res['status'];
    }

    //selecting product types data
    $product_types = mysqli_query($mysqli, "SELECT * FROM product_type");
}
?>

<div class="jumbotron text-center">
    <h3>Product Edit</h3>
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

    <form action="product_update.php" method="post" enctype="multipart/form-data" name="form1">
        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">


        <div class="row">
            <div class="col-sm-4">
                <label><b>Product SKU * </b></label> <label> (max length - 50)</label>
                <input class="form-control" type="text" id="sku" name="sku" value="<?php echo $sku; ?>" readonly>
            </div>
        </div>
        <br>
        <div class="row">

            <div class="col-sm-4">
                <label><b>Product Name * </b></label> <label> (max length - 50)</label>
                <input class="form-control" type="text" id="name" name="name" value="<?php echo $name; ?>">
            </div>

            <div class="col-sm-4">
                <label><b>Product Price * </b></label>
                <input class="form-control" type="number" min="0" step="1" id="price" name="price" value="<?php echo $price; ?>">
            </div>

            <div class="col-sm-4">
                <label><b>Product Status * </b></label>
                <select name="status" class="form-control">
                    <option value="2" disabled>Select One Status</option>
                    <option <?php if ($status == 1) {
                                echo 'selected';
                            }
                            ?> value="1">Active</option>

                    <option <?php if ($status == 0) {
                                echo 'selected';
                            }
                            ?> value="0">In-Active</option>
                </select>
            </div>

        </div>
        <br>

        <div class="row">

            <div class="col-sm-4">
                <label><b>Product Type * </b></label>
                <select name="type" class="form-control">
                    <option value="0" disabled>Select One Type</option>
                    <?php
                    while ($product_type = mysqli_fetch_array($product_types)) {

                        $selected = '';
                        if ($type == $product_type['id']) {
                            $selected = 'selected';
                        }

                        echo '<option value="' . $product_type['id'] . '" ' . $selected . '>';
                        echo $product_type['name'];
                        echo '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="col-sm-4">
                <label><b>Product Color * </b></label>
                <select name="color" class="form-control">
                    <option value="0" disabled>Select One Color</option>
                    <option <?php if ($color == 1) {
                                echo 'selected';
                            }
                            ?> value="1">White</option>

                    <option <?php if ($color == 2) {
                                echo 'selected';
                            }
                            ?> value="2">Black</option>

                    <option <?php if ($color == 3) {
                                echo 'selected';
                            }
                            ?> value="3">Green</option>

                    <option <?php if ($color == 4) {
                                echo 'selected';
                            }
                            ?> value="4">Yellow</option>

                    <option <?php if ($color == 5) {
                                echo 'selected';
                            }
                            ?> value="5">Red</option>

                    <option <?php if ($color == 6) {
                                echo 'selected';
                            }
                            ?> value="6">Blue</option>
                </select>
            </div>

            <div class="col-sm-4">
                <label>Product Image</label>
                <input class="form-control" type="file" name="image">
            </div>

        </div>
        <br>

        <div class="row">

            <div class="col-sm-8">
                <label>Product Description </label> <label> (max length - 255)</label>
                <textarea maxlength="255" rows="7" class="form-control" name="description"><?php echo $description; ?></textarea>
            </div>

            <div class="col-sm-4">
                <label>Current Existing Image</label><br />
                <?php
                echo '<img class="img-responsive" src="uploads/' . $image . '" width="100%" height="90%">';
                ?>
            </div>

        </div>
        <br>

        <div class="row">

            <div class="col-sm-12">
                <label>Product Remark</label> <label> (max length - 500)</label>
                <textarea maxlength="500" rows="4" class="form-control" name="remark"><?php echo $remark; ?></textarea>
            </div>

        </div>
        <br>

        <div class="row">
            <div class="col-sm-8">
            </div>

            <div class="col-sm-2">
                <button type="submit" id="btn_submit" class="btn btn-primary form-control">Update</button>
            </div>

            <div class="col-sm-2">
                <a class="btn btn-secondary form-control" href="product_list.php">Cancel</a>
            </div>

        </div>
        <br>
    </form>
    <?php
    include 'footer.php';
    ?>

    <script>
        $(document).ready(function() {

            $('#myForm').validate({ // initialize the plugin
                rules: {

                    sku: {
                        required: true,
                        maxlength: 50
                    },

                    name: {
                        required: true,
                        maxlength: 50
                    },
                    price: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                    type: {
                        required: true,
                    },
                    color: {
                        required: true,
                    },
                    color: {
                        maxlength: 255,
                    },
                    remark: {
                        maxlength: 500,
                    },
                    messages: {
                        name: "Please enter product sku !",
                        name: "Please enter product name !",
                        price: "Please enter price !",
                        status: "Please enter status !",
                        type: "Please enter type !",
                        color: "Please enter color !",
                    }
                },
                submitHandler: function(form) {
                    $("#btn_submit").attr("disabled", true);
                    this.submit();
                }
            });

        });
    </script>