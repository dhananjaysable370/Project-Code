<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "careerin";

$con = mysqli_connect($server, $username, $password, $db);
if (!$con) {
    die("Database not connected!" . mysqli_connect_error());
} else {
}