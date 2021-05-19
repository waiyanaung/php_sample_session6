<?php

session_start();
include("../config/connection.php");
include("../config/utility.php");
if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = mysqli_real_escape_string($mysqli, $_POST['username']);
    $pass = mysqli_real_escape_string($mysqli, $_POST['password']);

    $error_msg = "";
    if ($user == "" || $pass == "") {
        if ($user == "") {
            $error_msg .= "Invalid Username !<br>";
        }

        if ($pass == "") {
            $error_msg .= "Invalid Password !";
        }

        $_SESSION['errors'] = $error_msg;
        header('Location: login.php');
    } else {
        $result = mysqli_query($mysqli, "SELECT * FROM users WHERE username='$user' AND password=md5('$pass')");
        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if (is_array($row) && !empty($row)) {

                if ($row['role_id'] == ROLE_ADMIN) {
                    $validuser = $row['username'];
                    $_SESSION['valid'] = $validuser;
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    header('Location: index.php');
                } else {
                    $_SESSION['errors'] = "Errro - Backend is noly for Admin user !<br> Not allow for customer !";
                    header('Location: login.php');
                }
            } else {
                $_SESSION['errors'] = "Invalid username or password.";
                header('Location: login.php');
            }
        } else {
            $_SESSION['errors'] = "Errro at database while retrieveing data !";
            header('Location: login.php');
        }
    }
} else {
    $_SESSION['errors'] = "Invalid username or password.";
    header('Location: login.php');
}
