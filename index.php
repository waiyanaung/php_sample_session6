<?php
include('header.php');
include('slider.php');
?>

<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">


    <div class="row">

        <div class="col-lg-12">

            <?php
            if (isset($_SESSION['valid'])) {
            ?>

                <p>
                    This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.This is Home Page.
                </p>

            <?php
            } else {
            ?>

                <p class="text-center font-weight-bold">
                    Welcome to my website and Please login to use ! <br /><br /><br />
                </p>

                <p class="text-center font-weight-bold">This web site has two sides / views, froned and backend.</p>

                <p class="text-center font-weight-bold">Frontend is for public and no need to login. Backend is for the administrators.</p>

                <p class="text-center font-weight-bold">Backend is for the administrators. And url is "/backend".</p>

            <?php
            }
            ?>

        </div>

    </div>


    <!-- Three columns of text below the carousel -->
    <div class="row">

        <div class="col-lg-4">
            <img class="rounded-circle" src="public/images/php.png" width="140" height="140">
            <h2>Sample Image</h2>
            <p>Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-4">
            <img class="rounded-circle" src="public/images/php.png" width="140" height="140">
            <h2>Sample Image</h2>
            <p>Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-4">
            <img class="rounded-circle" src="public/images/php.png" width="140" height="140">
            <h2>Sample Image</h2>
            <p>Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.Sample Image.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        </div><!-- /.col-lg-4 -->

    </div><!-- /.row -->


    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">What is PHP?</h2>
            <p class="lead">PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages. PHP is a widely-used, free, and efficient alternative to competitors such as Microsoft's ASP.</p>
        </div>
        <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" src="public/images/php_2.png" alt="500x500" style="width: 500px; height: 500px;" data-holder-rendered="true">
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">What is PHP?</h2>
            <p class="lead">PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages. PHP is a widely-used, free, and efficient alternative to competitors such as Microsoft's ASP.</p>
        </div>
        <div class="col-md-5 order-md-1">
            <img class="featurette-image img-fluid mx-auto" src="public/images/php_2.png" alt="500x500" src="" data-holder-rendered="true" style="width: 500px; height: 500px;">
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">What is PHP?</h2>
            <p class="lead">PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages. PHP is a widely-used, free, and efficient alternative to competitors such as Microsoft's ASP.</p>
        </div>
        <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" src="public/images/php_2.png" alt="500x500" src="" data-holder-rendered="true" style="width: 500px; height: 500px;">
        </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

</div><!-- /.container -->

<?php
include('footer.php');
?>