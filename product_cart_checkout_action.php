<?php
session_start();

//including the database connection file
include_once("config/connection.php");

$total = 0;
$user_products = $_SESSION['products'];
$item_count = count($user_products);

if (isset($_POST['checkout']) && $item_count > 0) {

    $loginId = $_SESSION['id'];

    // Calculatin total payable amount for the transaction
    $total_disc = 0;
    $total_amt = 0;
    $total_tax = 0;
    $subtotal = 0;

    // Calculatin total payable amount for the transaction
    foreach ($user_products as $id => $item) {

        $item_disc = 0;
        $item_tax = 0;
        $item_price = $item['price'];
        $item_qty = $item['qty'];
        $item_total = $item_price * $item_qty;

        $total_disc = $total_disc + $item_disc;
        $total_amt = $total_amt + $item_total;
        $total_tax = $total_tax + $item_tax;
        $subtotal = $subtotal + $item_total;
    }

    // Turn autocommit off
    mysqli_autocommit($con, FALSE);

    try {

        // saving parent / header / transaction data 
        $result_header = mysqli_query($mysqli, "INSERT INTO transactions (total_disc, total_amt, total_tax, subtotal,login_id) VALUES('$total_disc', '$total_amt', '$total_tax', '$subtotal', '$loginId')");

        if ($result_header) {
            $transaction_id = $mysqli->insert_id;

            foreach ($user_products as $id => $product) {

                $disc = 0;
                $tax = 0;
                $price = $product['price'];
                $qty = $product['qty'];
                $total = $price * $qty;
                $subtotal = $total;

                // saving child / detail / item data 
                $result = mysqli_query($mysqli, "INSERT INTO transaction_item (transaction_id,product_id, price, qty, disc, total, tax, subtotal) VALUES('$transaction_id','$id','$price','$qty','$disc', '$total', '$tax', '$subtotal')");

                if (!$result) {

                    $mysqli_rollback($mysqli);
                    $mysqli->close();

                    $_SESSION['errors'] = "Error while saving data !<br>" . $mysqli->error;
                    header('Location: product_cart_checkout.php');
                }
            }

            /* commit newly created table */
            $mysqli->commit();

            $_SESSION['errors'] = "success";
            $mysqli->close();
            header('Location: product_chekout_result.php?id=' . $transaction_id);
        } else {

            $mysqli_rollback($mysqli);
            $mysqli->close();
            $_SESSION['errors'] = "Error while saving data !<br>" . $mysqli->error;
            $mysqli->close();
            header('Location: product_cart_checkout.php');
        }
    }

    //catch exception
    catch (Exception $e) {

        $mysqli_rollback($mysqli);
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
