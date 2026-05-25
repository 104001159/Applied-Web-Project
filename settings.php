<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "cartx_db";

$conn = @mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    $conn = @mysqli_connect($host, $user, $password);
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    $sql = "CREATE DATABASE IF NOT EXISTS $database";
    if (!mysqli_query($conn, $sql)) {
        die("Database creation failed: " . mysqli_error($conn));
    }
    mysqli_select_db($conn, $database);
}
?>
