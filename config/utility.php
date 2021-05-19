<?php

$configs = [];
define("ROLE_ADMIN", 1);
define("ROLE_CUSTOMER", 2);

$roles = [];
$roles[ROLE_ADMIN] = 'Admin';
$roles[ROLE_CUSTOMER] = 'Customer';



define("TRANS_STATUS_PENDING", 2);
define("TRANS_STATUS_CONFIRM", 1);
define("TRANS_STATUS_VOID", 3);
define("TRANS_STATUS_PAID", 4);
define("TRANS_STATUS_VOID_PAYMENT", 5);

$status_transaction = [];
$status_transaction[TRANS_STATUS_PENDING] = 'Pending';
$status_transaction[TRANS_STATUS_CONFIRM] = 'Confirmed';
$status_transaction[TRANS_STATUS_VOID] = 'Void';
$status_transaction[TRANS_STATUS_PAID] = 'Paid';
$status_transaction[TRANS_STATUS_VOID_PAYMENT] = 'Payment Cancel';


define("PAYMENT_TYPE_COD", 1);
define("PAYMENT_TYPE_BANK", 2);
define("PAYMENT_TYPE_PAYPAL", 3);

$type_payment = [];
$type_payment[PAYMENT_TYPE_COD] = 'Cash On Delivery';
$type_payment[PAYMENT_TYPE_BANK] = 'Bank Transfer';
$type_payment[PAYMENT_TYPE_PAYPAL] = 'with PayPal';
