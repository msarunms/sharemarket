<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
function db_connect() {
    
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "sharemarlet";
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
?>