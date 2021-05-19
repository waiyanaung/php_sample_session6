<?php
include 'header.php';
include('check_session.php');

if (isset($_GET['id'])) {
    //getting id from url
    $id = $_GET['id'];

    //selecting data associated with this particular id
    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

    while ($res = mysqli_fetch_array($result)) {
        $id = $res['id'];
        $name = $res['name'];
        $image = $res['image'];
        $email = $res['email'];
        $username = $res['username'];
        $role_id = $res['role_id'];
        $address = $res['address'];
        $status = $res['status'];
    }

    //selecting product types data
    $product_types = mysqli_query($mysqli, "SELECT * FROM product_type");
}
?>

<div class="jumbotron text-center">
    <h3>User Show</h3>
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
            <label>Full Name</label>
            <input class="form-control" type="text" id="name" name="name" value="<?php echo $name; ?>" readonly>
        </div>

        <div class="col-sm-4">
            <label>User Name</label>
            <input class="form-control" type="text" id="username" name="username" value="<?php echo $username; ?>" readonly>
        </div>

        <div class="col-sm-4">
            <label>User Status</label>
            <select name="status" class="form-control" readonly>
                <option value="" disabled>Select One Status</option>
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
            <label>User Email</label>
            <input class="form-control" type="text" id="email" name="email" value="<?php echo $email; ?>" readonly>
        </div>

        <div class="col-sm-4">
            <label>User Role</label>
            <select name="role_id" class="form-control" readonly>
                <option value="0" disabled>Select One Role</option>
                <option <?php if ($role_id == 1) {
                            echo 'selected';
                        }
                        ?> value="1">Admin</option>

                <option <?php if ($role_id == 2) {
                            echo 'selected';
                        }
                        ?> value="0">Customer</option>
            </select>
        </div>

    </div>
    <br>

    <div class="row">

        <div class="col-sm-8">
            <label>Detail Address</label>
            <textarea rows="7" class="form-control" name="address" readonly><?php echo $address; ?></textarea>
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
        <div class="col-sm-10">
        </div>

        <div class="col-sm-2">
            <a class="btn btn-secondary form-control" href="user_list.php">Go Back to List</a>
        </div>

    </div>
    <?php
    include 'footer.php';
    ?>