<?php session_start();

if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
}

//including the database connection file
include("../config/connection.php");

//deleting the row from table
// Actual Delete should not use it 
// but it can use up to your condition
// $result=mysqli_query($mysqli, "DELETE FROM Users WHERE id=$id");

// Checking with image upload or not
if (isset($_GET['id']) && $_GET['id'] != "") {

    //getting id of the data from url
    $id = $_GET['id'];
    $update_at = date("Y-m-d h:i:s");
    $login_id = $_SESSION['id'];

    //updating the table
    $query = "UPDATE users SET status='0', updated_at='$update_at', updated_by = '$login_id' WHERE id='$id'";

    $result = mysqli_query($mysqli, $query);

    $messages = "<p><font color='blue'>Success - Deleting Data !</font></p>";
    $messages .= "<p><font color='blue'>User deleted successfully !.</font></p>";
    $_SESSION['messages'] = $messages;
    header("Location: user_list.php");
} else {

    $errors = "<p><font color='red'>Errors in Deleting Data !</font></p>";
    $errors .= "<p><font color='red'>Error while deleting User !.</font></p>";
    $_SESSION['errors'] = $errors;
    header("Location: user_list.php");
}

//redirecting to the display page (view.php in our case)
header("Location:user_list.php");
