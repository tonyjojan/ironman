<?php
require 'config.php';


$_SESSION['logged_in'] = false;
$_SESSION['super_logged_in'] = false;
$_SESSION['email'] = "";
$_SESSION['name'] = "";
header('Location: index.php');
?>
