<?php
session_start();

if(isset($_SESSION['id'])) {
    session_unset();
    session_destroy();
    header("Location: sudpas_login.php");
    exit();
} else {
    header("Location: sudpas_login.php");
    exit();
}
?>