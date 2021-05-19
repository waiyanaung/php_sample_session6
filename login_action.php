<?php

session_start();
include("./config/connection.php");
if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = mysqli_real_escape_string($mysqli, $_POST['username']);
    $pass = mysqli_real_escape_string($mysqli, $_POST['password']);

    $error_msg = "";
    if ($user == "" || $pass == "") {

        die('error');
        if ($user == "") {
            $error_msg .= "Invalid Username !<br>";
        }

        if ($pass == "") {
            $error_msg .= "Invalid Password !";
        }

        $_SESSION['errors'] = $error_msg;
        header('Location: login.php');
    } else {
        $result = mysqli_query($mysqli, "SELECT * FROM users WHERE username='$user' AND password=md5('$pass')")
            or die("Could not execute the select query.");

        $row = mysqli_fetch_assoc($result);
        if (is_array($row) && !empty($row)) {
            $validuser = $row['username'];
            $_SESSION['valid'] = $validuser;
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
        } else {

            $_SESSION['errors'] = "Invalid username or password.";
            header('Location: login.php');
        }

        if (isset($_SESSION['valid'])) {
            header('Location: login_result.php');
        }
    }
} else {
    $_SESSION['errors'] = "Invalid username or password.";
    header('Location: login.php');
}
