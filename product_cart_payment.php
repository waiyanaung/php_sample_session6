<?php
session_start();

//including the database connection file
include_once("config/connection.php");

if (isset($_POST['checkout']) && isset($_POST['id'])) {

    $loginId = $_SESSION['id'];
    $id = $_POST['id'];
    $payment_type = $_POST['payment_type'];

    try {

        $result = mysqli_query($mysqli, "SELECT * FROM transactions WHERE id='$id'");
        $subtotal = 0;

        if (!$result) {
            $_SESSION['errors'] = "Error while saving data !<br>" . $mysqli->error;
            $mysqli->close();
            header('Location: product_cart_checkout.php');
        }

        $row = mysqli_fetch_assoc($result);
        if (is_array($row) && !empty($row)) {
            $subtotal = $row['subtotal'];
        } else {
            $mysqli->close();
            $_SESSION['errors'] = "Error while saving data !<br>" . $mysqli->error;
            header('Location: product_cart_checkout.php');
        }

        // saving parent / header / transaction data 
        $result_payment = mysqli_query($mysqli, "INSERT INTO transaction_payment (transaction_id,paid_amt, advanced_amt, payment_type,login_id) VALUES('$id', '$subtotal', '0', '$payment_type', '$loginId')");

        if ($result_payment) {

            $_SESSION['errors'] = "success";
            $mysqli->close();
            header('Location: product_card_payment_result.php');
        } else {
            $_SESSION['errors'] = "Error while saving data !<br>" . $mysqli->error;
            $mysqli->close();
            header('Location: product_cart_checkout.php');
        }
    }

    //catch exception
    catch (Exception $e) {
        $mysqli->close();

        $_SESSION['errors'] = "Error while saving data !<br>" . $mysqli->error;
        $_SESSION['errors'] = "<br>" . $e->getMessage();
        header('Location: product_cart_checkout.php');
    }
} else {

    $_SESSION['errors'] = "Error Invalid request!";
    $mysqli->close();
    header('Location: product_cart_checkout.php');
}
