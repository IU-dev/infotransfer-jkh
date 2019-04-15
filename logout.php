<?php
//logout.php
require_once 'includes/global.inc.php';
$page = "index.php";
require_once 'includes/header.inc.php';
$userTools = new UserTools();
$userTools->logout();
header("Location: index.php");
?>