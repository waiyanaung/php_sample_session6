<?php
include('header.php');
include('check_session.php');

//fetching data in descending order (lastest entry first)
$types = mysqli_query($mysqli, "	SELECT * FROM product_type ORDER BY id DESC");

?>

<div class="jumbotron text-center">
    <h3>Product Create</h3>
</div>

<div class="container">

    <?php
    include('check_error.php');
    ?>

    <form action="product_store.php" method="post" enctype="multipart/form-data" name="myForm" id="myForm">

        <div class="row">
            <div class="col-sm-4">
                <label><b>Product SKU * </b></label> <label> (max length - 50)</label>
                <input class="form-control" type="text" id="sku" name="sku">
            </div>
        </div>
        <br />

        <div class="row">

            <div class="col-sm-4">
                <label><b>Product Name * </b></label> <label> (max length - 50)</label>
                <input class="form-control" type="text" id="name" name="name">
            </div>

            <div class="col-sm-4">
                <label><b>Product Price * </b></label>
                <input class="form-control" type="number" min="0" step="1" id="price" name="price" id="price" value="0">
            </div>

            <div class="col-sm-4">
                <label><b>Product Status * </b></label>
                <select name="status" class="form-control">
                    <option value="2" disabled>Select One Status</option>
                    <option selected value="1">Active</option>
                    <option value="0">In-Active</option>
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
                    while ($type = mysqli_fetch_array($types)) {
                    ?>
                        <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="col-sm-4">
                <label><b>Product Color * </b></label>
                <select name="color" class="form-control">
                    <option value="0" disabled>Select One Color</option>
                    <option value="1">White</option>
                    <option value="2">Black</option>
                    <option value="4">Green</option>
                    <option value="3">Yellow</option>
                    <option value="5">Red</option>
                    <option value="6">Blue</option>
                </select>
            </div>

            <div class="col-sm-4">
                <label>Product Image</label>
                <input class="form-control" type="file" name="image">
            </div>

        </div>
        <br>

        <div class="row">

            <div class="col-sm-12">
                <label>Product Description </label> <label> (max length - 255)</label>

                <textarea maxlength="255" rows="4" class="form-control" name="description"></textarea>
            </div>

        </div>
        <br>

        <div class="row">

            <div class="col-sm-12">
                <label>Product Remark</label> <label> (max length - 500)</label>
                <textarea maxlength="500" rows="4" class="form-control" name="remark"></textarea>
            </div>

        </div>
        <br>

        <div class="row">
            <div class="col-sm-8">
            </div>

            <div class="col-sm-2">
                <button type="submit" id="btn_submit" class="btn btn-primary form-control">Save</button>
            </div>

            <div class="col-sm-2">
                <a class="btn btn-secondary form-control" href="product_list.php">Cancel</a>
            </div>

        </div>
        <br>
    </form>

    <?php
    include('footer.php');
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