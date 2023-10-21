<?php
$databaseHost = 'localhost';
$databaseName = 'test_db2';
$databaseUsername = 'william';
$databasePassword = '';

// DB Connection with mysqli
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

//Database connection, replace with your connection string.. Used PDO
$conn = new PDO("mysql:host=" . $databaseHost . ";dbname=" . $databaseName, $databaseUsername, $databasePassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
