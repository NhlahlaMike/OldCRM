<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['username']);
unset($_SESSION['Role']);
header('Location:light/login.php');
?>