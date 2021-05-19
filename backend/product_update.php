<?php
session_start();
// including the database connection file
include_once("../config/connection.php");

if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    // checking empty fields
    if (empty($name)) {
        $errors = "<p><font color='red'>Errors</font></p>";
        $errors .= "<p><font color='red'>* Name : is required !.</font></p>";
        $_SESSION['errors'] = $errors;
        header("Location: product_edit.php" . "?id=" . $id);
    } else {

        $price = $_POST['price'];
        if ($price == "") {
            $price = "0.0";
        }
        $loginId = $_SESSION['id'];
        $update_at = date("h:i:s");
        $type = $_POST['type'];
        $color = $_POST['color'];
        $description = $_POST['description'];
        $remark = $_POST['remark'];
        $status = $_POST['status'];

        // Receiving image
        $cover = $_FILES['image']['name'];

        // Checking with image upload or not
        if (isset($cover) && $cover != "") {

            $tmp = $_FILES['image']['tmp_name'];
            $ext = pathinfo($cover, PATHINFO_EXTENSION);
            $new_image = uniqid() . "." . $ext;
            if ($cover) {
                move_uploaded_file($tmp, "uploads/$new_image");
            } else {
                //redirectig 
                $errors = "<p><font color='red'>Errors in Updating</font></p>";
                $errors .= "<p><font color='red'>Error occur while updating !</font></p>";
                $_SESSION['errors'] = $errors;
                header("Location: product_edit.php" . "?id=" . $id);
            }

            //updating the table
            $query = "UPDATE products SET name='$name', color='$color', type = '$type', description = '$description', remark = '$remark', image = '$new_image', status = '$status', price='$price' WHERE id='$id'";
        } else {
            //updating the table
            $query = "UPDATE products SET name='$name', color='$color', type = '$type', description = '$description', status = '$status', remark = '$remark', price ='$price' WHERE id='$id'";
        }

        $result = mysqli_query($mysqli, $query);

        //redirectig to the display page. In our case, it is product_update_result.php
        // header("Location: product_update_result.php");

        $messages = "<p><font color='blue'>Success - Product updated successfully </font></p>";

        $_SESSION['messages'] = $messages;

        header("Location: product_edit.php" . "?id=" . $id);
    }
} else {
    //redirectig 
    $errors = "<p><font color='red'>Errors in Updating</font></p>";
    $errors .= "<p><font color='red'>Error occur while updating !</font></p>";
    $_SESSION['errors'] = $errors;
    header("Location: product_list.php");
}
