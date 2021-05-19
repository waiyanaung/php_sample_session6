<?php session_start();

//including the database connection file
include_once("../config/connection.php");
include("../config/utility.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>PHP Sample Project</title>

    <!-- Bootstrap core CSS -->
    <link href="../public/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../public/carousel.css" rel="stylesheet">

    <!-- My Custom Style -->
    <link href="../public/css/my_style.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../public/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="../public/popper.min.js"></script>
    <script src="../public/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../public/holder.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Jquery Datatable -->
    <script src="../public/js/jquery.min.js"></script>
    <link rel="stylesheet" href="../public/js/jquery.dataTables.min.css">
    <script src="../public/js/jquery.dataTables.min.js"></script>

    <!-- jquery form validation -->
    <link rel="stylesheet" href="../public/bootstrap-4.1.3/site/docs/4.1/examples/checkout/form-validation.css">
    <script src="../public/js/jquery-validation-1.19.1/dist/jquery.validate.js"></script>


</head>

<body cz-shortcut-listen="true">

    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

            <a class="navbar-brand" href="index.php">PHP Sample Project</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <?php
                    if (isset($_SESSION['valid'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="product_list.php">Products</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="user_list.php">Users</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="transaction_list.php">Orders</a>
                        </li>

                    <?php
                    }
                    ?>

                </ul>

                <?php
                if (isset($_SESSION['valid'])) {
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-white">Welcome : <?php echo $_SESSION['valid']; ?></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="dropdown-item" href="#">Logout</a>
                        </div>
                    </li>

                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="login.php">Log In</a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link text-white" href="register.php">Register</a>
                    </li> -->

                <?php
                }
                ?>

            </div>
        </nav>
    </header>

    <main role="main">