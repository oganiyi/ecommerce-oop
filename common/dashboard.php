<?php
$pageTitle = "Dashboard";
require_once "admin-seller-nav.php";
if (!isset($_SESSION['email'])) {
    header('location:../login.php');
}
?>