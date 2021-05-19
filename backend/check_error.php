<!-- for validation error show case -->
<?php
if (isset($_SESSION['errors']) && $_SESSION['errors'] != "") { ?>
    <div class="row">
        <div class="col-sm-12">
            <p class="text-center text-danger font-weight-bold">
                <?php
                echo $_SESSION['errors'];
                $_SESSION['errors'] = "";
                ?>
            </p>
        </div>
    </div>
    <br /><br />
<?php } ?>
<!-- for validation error show case -->