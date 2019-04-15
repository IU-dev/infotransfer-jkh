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
<h1>Информационная система Лагерь</h1>
<div class="alert alert-info" role="alert">
<h3><?php $temp = $db->select('settings', "name = 'period'"); echo $temp['value']; ?></h3><br>
<strong>Наименование организации: </strong><?php $temp = $db->select('settings', "name = 'org'"); echo $temp['value']; ?><br>
<strong>Администратор: </strong><?php $temp = $db->select('settings', "name = 'admin'"); echo $temp['value']; ?><br>
</div><br>
<div class="alert alert-warning" role="alert">
<h4>Не забывайте проверять уведомления во вкладке "Аккаунт"!</h4>
<h2><a href="check_username.php">Узнать логин</a></h2>
<h2><a href="check_password.php">Сбросить пароль</a></h2>
<h2><a href="check_osn.php">Сменить основное направление</a></h2>
</div><br>
<div class="alert alert-success" role="alert">
<h4>Очень важная информация по дополнительным занятиям</h4>
<hr>
Во вкладке "Дополнительное", через пункт "Записаться" можно выбрать дополнительное занятие.<br>
Дополнительные занятия для записи доступны на сегодняшний и завтрашний день.<br>
Рекомендуем записываться за день до планируемого занятия.
</div></br>
</center>
</body>
</html>