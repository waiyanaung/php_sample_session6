<?php
session_start();
include("./config/connection.php");

if (isset($_POST['username']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $error_msg = "";

    if ($user == "" || $pass == "" || $name == "" || $email == "") {
        if ($user == "") {
            $error_msg .= "Invalid Full Name ! <br/>";
        }
        if ($email == "") {
            $error_msg .= "Invalid Email ! <br/>";
        }

        if ($pass == "") {
            $error_msg .= "Invalid User Name ! <br/>";
        }

        if ($name == "") {
            $error_msg .= "Invalid Password ! <br/>";
        }

        $_SESSION['errors'] = $error_msg;
        header('Location: register.php');
    } else {

        $validate_email = mysqli_query($mysqli, "SELECT * FROM users WHERE  email= '$email'");
        $email_exist = $validate_email->num_rows;

        $validate_username = mysqli_query($mysqli, "SELECT * FROM users WHERE  username = '$user'");
        $username_exist = $validate_username->num_rows;

        if ($email_exist == 1) {
            $_SESSION['errors'] = "Error while saving data !<br>" . "Duplicate Email - '" . $email . "'";
            $mysqli->close();
            header('Location: register.php');
        } else if ($username_exist == 1) {
            $_SESSION['errors'] = "Error while saving data !<br>" . "Duplicate User Name - '" . $user . "'";
            $mysqli->close();
            header('Location: register.php');
        } else {

            $result = mysqli_query($mysqli, "INSERT INTO users (name, email, username, password) VALUES('$name', '$email', '$user', md5('$pass'))");

            if ($result) {
                $_SESSION['errors'] = "";
                $mysqli->close();
                header('Location: register_action_result.php');
            } else {
                $_SESSION['errors'] = "Error while saving data AA !<br>" . $mysqli->error;
                $mysqli->close();
                header('Location: register.php');
            }
        }
    }
} else {
}
