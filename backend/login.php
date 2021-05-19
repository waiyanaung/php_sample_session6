<?php
include('header.php');
?>

<div class="jumbotron text-center">
    <h3>Log In</h3>
</div>

<div class="container">

    <?php include('check_error.php'); ?>

    <form action="login_action.php" method="post" name="myForm" id="myForm">
        <div class="row">

            <div class="col-sm-4">
            </div>

            <div class="col-sm-4">
                <label><b>User Name * </b></label>
                <input class="form-control" type="username" id="username" name="username">
            </div>

            <div class="col-sm-4">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
            </div>

            <div class="col-sm-4">
                <label><b>Password * </b></label>
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