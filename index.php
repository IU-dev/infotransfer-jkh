<?php
//index.php 
require_once 'includes/global.inc.php';
$page = "index.php";
require_once 'includes/header.inc.php';
?>
<html>
<head>
<title>Главная | <?php echo $pname; ?></title>
</head>
<body>
<center>
<br>
<h1>ИнфоТрансфер: ЖКХ</h1><br>
<div class="alert alert-info" role="alert">
<h3>Добро пожаловать!<h3>
</div><br>
<div class="alert alert-warning" role="alert">
<h5>Информация по счетчикам - на вкладке "Счетчики"</h5>
<h5>Заявки на установку / обслуживание - на вкладке "Заявки"</h5>
<h5>Баланс - в меню "Аккаунт"</h5>
</div><br>
<div class="alert alert-success" role="alert">
<h5>Сделано</h5>
<h3>Payalnik Team</h3>
<h5><a href="http://payalnik-team.ru/">payalnik-team.ru</a></h5>
</div><br>
</center>
</body>
</html>