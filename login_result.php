<?php
include('header.php');
?>

<div class="jumbotron text-center">
    <h3>Welcome</h3>
</div>

<div class="container">

    <?php
    if (isset($_SESSION['valid'])) {
    ?>

        <p>
            Dear <b> <?php echo $_SESSION['valid']; ?></b>,<br><br>
            Welcome to website ! <br /><br /><br />
        </p>

    <?php
    } else {
    ?>

        <p>
            Dear <b> Visitor</b>,<br><br>
            Welcome to our website.<br />
            Please login to use ! <br /><br /><br />
        </p>

    <?php
    }
    ?>
    <?php
    include('footer.php');
    ?>