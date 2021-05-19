<?php
session_start();

//including the database connection file
include_once("../config/connection.php");

if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
}

if (isset($_POST['name'])) {

    $name = $_POST['name'];
    $sku = $_POST['sku'];

    // checking empty fields
    if (empty($name) || empty($sku)) {

        $errors = "<p><font color='red'>Errors</font></p>";
        if (empty($name)) {
            $errors .= "<p><font color='red'>* Name : is required !.</font></p>";
        }

        if (empty($sku)) {
            $errors .= "<p><font color='red'>* SKU : is required !.</font></p>";
        }

        $_SESSION['errors'] = $errors;
        header("Location: product_create.php");
    } else {

        $price = $_POST['price'];
        if ($price == "") {
            $price = "0.0";
        }
        $loginId = $_SESSION['id'];
        $type = $_REQUEST['type'];
        $color = $_REQUEST['color'];
        $description = $_REQUEST['description'];
        $remark = $_REQUEST['remark'];
        $status = $_REQUEST['status'];

        // Receiving image
        $cover = $_FILES['image']['name'];
        $new_image = "";

        // Checking with image upload or not
        if (isset($cover) && $cover != "") {
            $tmp = $_FILES['image']['tmp_name'];
            $ext = pathinfo($cover, PATHINFO_EXTENSION);
            $new_image = uniqid() . "." . $ext;

            if ($cover) {
                move_uploaded_file($tmp, "uploads/$new_image");
            } else {
                echo "error at image move";
                exit();
            }
        }

        try {


            $validate_sku = mysqli_query($mysqli, "SELECT * FROM products WHERE  sku = '$sku'");
            $sku_exist = $validate_sku->num_rows;

            if ($sku_exist == 1) {
                $_SESSION['errors'] = "Error while saving data !<br>" . "Duplicate Product Sku - '" . $sku . "'";
                $mysqli->close();
                header('Location: product_create.php');
            } else {

                $query = "INSERT INTO products (name,sku, price, login_id,color,type,description,remark,image,status) VALUES ('$name','$sku','$price', '$loginId','$color','$type','$description','$remark', '$new_image','$status')";

                //insert data to database
                $result = mysqli_query($mysqli, $query);

                if ($result) {
                    $_SESSION['errors'] = "";
                    $mysqli->close();
                    header('Location: product_store_result.php');
                } else {
                    $_SESSION['errors'] = "Error while saving data AA !<br>" . $mysqli->error;
                    $mysqli->close();
                    header("Location: product_create.php");
                }
            }
        } catch (Exception $e) {
            $errors = "<p><font color='red'>Errors in Storing New Data !</font></p>";
            $errors .= "<p><font color='red'>Error while storing new product !.</font></p>";
            $errors .= $e->getMessage();
            $_SESSION['errors'] = $errors;
            header("Location: product_create.php");
        }
    }
} else {
    //redirectig 
    $errors = "<p><font color='red'>Errors in Storing New Data !</font></p>";
    $errors .= "<p><font color='red'>Error while storing new product !.</font></p>";
    $$errors .= "Error while saving data AA !<br>" . $mysqli->error;
    $mysqli->close();

    $_SESSION['errors'] = $errors;
    header("Location: product_create.php");
}
