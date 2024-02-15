<?php

$db_host = 'sql311.infinityfree.com';
$db_user = 'if0_35758298';
$db_password = 'kashiben97';
$db_db = 'if0_35758298_Online_bookstore';
$connect = mysqli_connect($db_host, $db_user, $db_password, $db_db);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die(mysqli_error($connect));
}
?>