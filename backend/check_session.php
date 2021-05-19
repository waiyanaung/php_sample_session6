<?php
if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
}
