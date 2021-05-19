<?php
include('header.php');
?>
<hr class="featurette-divider">

<div class="container">
    <?php include('check_error.php'); ?>

    <form action="login_action.php" method="post" name="myForm" id="myForm">
        <div class="row">

            <div class="col-sm-4">
            </div>

            <div class="col-sm-4">
                <label>User Name</label>
                <input class="form-control" type="username" id="username" name="username">
            </div>

            <div class="col-sm-4">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
            </div>

            <div class="col-sm-4">
                <label>Password</label>
                <input class="form-control" type="password" id="password" name="password">
            </div>

            <div class="col-sm-4">
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
                <button type="submit" id="btn_check" class="btn btn-primary form-control">Log In</button>
            </div>
            <div class="col-sm-4">
            </div>
        </div>
        </br>
    </form>

</div>
<br>

<?php
include('footer.php');
?>

<script>
    $(document).ready(function() {

        $('#myForm').validate({ // initialize the plugin
            rules: {
                username: {
                    required: true,
                    maxlength: 50
                },
                password: {
                    required: true,
                    maxlength: 50
                },
                messages: {
                    username: "Please enter your login name",
                    password: "Please enter your password",
                }
            },
            submitHandler: function(form) {
                this.submit();
            }
        });

    });
</script>