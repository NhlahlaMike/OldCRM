<?php
session_start();
$_SESSION['quantity']=$_POST['quantity'];
header('Location:payment.php');

?>
