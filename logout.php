<?php
session_start();

unset($_SESSION['id'] ,$_SESSION['email']);
header('location:login.php');
 ?>
