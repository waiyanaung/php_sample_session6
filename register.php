<?php
include('header.php');
include('check_already_login.php');
?>

<div class="jumbotron text-center">
    <h3>Register</h3>
</div>

<div class="container">

    <?php include('check_error.php'); ?>

    <form action="register_action.php" method="post" name="myForm" id="myForm">
        <div class="row">

            <div class="col-sm-6">
                <label><b>Full Name * (max length - 50)</b></label>
                <input class="form-control" type="text" id="name" name="name">
            </div>

            <div class="col-sm-6">
                <label><b>Email * (max length - 50)</b></label>
                <input class="form-control" type="email" id="email" name="email">
            </div>
        </div>

        <div class="row">

            <div class="col-sm-6">
                <label><b>Login Name * (max length - 50)</b></label>
                <input class="form-control" type="text" id="username" name="username">
            </div>

            <div class="col-sm-6">
                <label><b>Password * (max length - 50)</b></label>
                <input class="form-control" type="password" id="password" name="password">
            </div>

        </div>
        <br>

        <div class="row">
            <div class="col-sm-8">
            </div>

            <div class="col-sm-2">
                <button type="submit" id="btn_submit" class="btn btn-primary form-control">Register</button>
            </div>

            <div class="col-sm-2">
                <a class="btn btn-secondary form-control" href="index.php">Cancel</a>
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

                    name: {
                        required: true,
                        maxlength: 50
                    },
                    username: {
                        required: true,
                        maxlength: 50
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        maxlength: 50
                    },
                    messages: {
                        name: "Please enter your full name",
                        username: "Please enter your login name",
                        email: "Please enter your email",
                        password: "Please enter your password",
                    }
                },
                submitHandler: function(form) {
                    $("#btn_submit").attr("disabled", true);
                    this.submit();
                }
            });

        });
    </script>