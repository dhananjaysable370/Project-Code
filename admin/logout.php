<?php
session_start();
session_unset();

echo "<script>window.location.href='./admin_login.php';</script>";
?>