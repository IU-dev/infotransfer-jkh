<?php
//register.php

require_once 'includes/global.inc.php';
$page = "a2_notf.php";
require_once 'includes/header.inc.php';
//инициализируем php переменные, которые используются в форме

$error = "";
$login = "";
$comment = "";

if(isset($_POST['submit-addpoints'])) { 

$user = unserialize($_SESSION['user']);
$login = $_POST['login'];
$comment = $_POST['comment'];

$userTools = new UserTools();
$userTools->notify($login, $user->displayname, $comment);
$error = '<div class="alert alert-success" role="alert">Запрос выполнен.</div>';
}
?>
<html>
<head>
<title>Уведомление | A2 | <?php echo $pname; ?></title>
</head>
<body>
<?php if(isset($_SESSION['logged_in'])) : ?>
<?php $user = unserialize($_SESSION['user']); ?>
<?php if($user->admin > 0) : ?>
<?php if($error) echo $error; 
	?>
	<h3>Отправка уведомления</h3>
				<form class="form-vertical" action="notify.php" method="post">
				 <fieldset>
				  <div class="form-group">
					  <label class="col control-label" for="login">Логин</label>  
					  <div class="col">
					  <input id="login" name="login" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $login; ?>"/> 
					  </div>
					</div>
					<div class="form-group">
					  <label class="col control-label" for="login">Сообщение</label>  
					  <div class="col">
					  <input id="comment" name="comment" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $comment; ?>"/> 
					  </div>
					</div>
					<div class="form-group">
					  <label class="col control-label" for="submit"></label>
					  <div class="col">
						<button value="submit-search" id="submit" name="submit-addpoints" class="btn btn-success">Выполнить запрос</button>
					  </div>
					</div>
					</fieldset>
					</form>
<?php else : ?>
Вы не авторизованы как администратор.
<?php endif; ?>
<?php else : ?>
Вы не авторизованы.
<?php endif; ?>
</body>
</html>