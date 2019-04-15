<?php
//register.php

require_once 'includes/global.inc.php';
$page = "a2_spis.php";
require_once 'includes/header.inc.php';
//инициализируем php переменные, которые используются в форме

$error = "";
$login = "";
$bally = "";
$comment = "";

if(isset($_POST['submit-addpoints'])) { 

$user = unserialize($_SESSION['user']);
$login = $_POST['login'];
$bally = $_POST['bally'];
$comment = $_POST['comment'];

$userTools = new UserTools();
$userTools->rem_points($login, $user->displayname, $bally, $comment);
$error = '<div class="alert alert-success" role="alert">Запрос выполнен.</div>';
}
?>
<html>
<head>
<title>Списание средств | A2 | <?php echo $pname; ?></title>
</head>
<body>
<?php if(isset($_SESSION['logged_in'])) : ?>
<?php $user = unserialize($_SESSION['user']); ?>
<?php if($user->admin > 0) : ?>
<?php if($error) echo $error; 
	?>
	<h3>Списание средств</h3>
				<form class="form-vertical" action="a2_spis.php" method="post">
				 <fieldset>
				  <div class="form-group">
					  <label class="col control-label" for="login">Логин</label>  
					  <div class="col">
					  <input id="login" name="login" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $login; ?>"/> 
					  </div>
					</div>
					<div class="form-group">
					  <label class="col control-label" for="login">Сумма</label>  
					  <div class="col">
					  <input id="bally" name="bally" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $bally; ?>"/> 
					  </div>
					</div>
					<div class="form-group">
					  <label class="col control-label" for="login">Комментарий</label>  
					  <div class="col">
					  <input id="comment" name="comment" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $comment; ?>"/> 
					  </div>
					</div>
					Единый формат комментариев:<br>
					01 Списание средств по тарифу "N" на период с NN.NN.NNN по NN.NN.NNN (сумма N руб. NN коп.)<br>
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