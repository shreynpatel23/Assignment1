<?php

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'Online_bookstore';
$connect = mysqli_connect($db_host, $db_user, $db_password, $db_db);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die(mysqli_error($connect));
}
?>