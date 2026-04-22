<?php
session_start();


if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit(); 
} else {

    if ($_SESSION['role'] == 'manager') {
        header("Location: mdash.php");
        exit();
    } else {
        header("Location: cdash.php"); 
        exit();
    }
}
?>
