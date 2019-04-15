<?php
//login.php
require_once 'includes/global.inc.php';
$page = "index.php";
require_once 'includes/header.inc.php';
$error = "";
$username = "";
$password = "";

//проверить отправлена ли форма логина
if(isset($_POST['submit-login'])) { 

$username = $_POST['username'];
$password = $_POST['password'];

$userTools = new UserTools();
if($userTools->login($username, $password) == 1){
	$rq['usr'] = "'".$username."'";
	$rq['pass'] = "'".$password."'";
	$db->insert($rq, 'enters');
//удачный вход, редирект на страницу
header("Location: index.php");
}else if($userTools->login($username, $password) == 2){
$error = 'Аккаунт не активирован.';
}
else{
$error = 'Неверный логин или пароль.';
}
}
?>
<html>
<head>
<title>Вход | <?php echo $pname; ?></title>
</head>
<body>
<main role="main">
		<?php $user = unserialize($_SESSION['user']); ?>
		
		<?php if(isset($_SESSION['logged_in'])) : ?>
			<div class="alert alert-danger" role="alert">
				  <strong>Ошибка безопасности #001</strong><br>
				  <p>Вы уже вошли в систему.</p>
				  <hr>
				  <small>
 				 <p class="mb-0">There was login.php GET request when $_SESSION is active.<br>
				 Был совершен GET запрос на страницу входа (login.php) с активной сессией $_SESSION.</p></small>
				</div>
		<?php else : ?>
			<center>
			<form class="form-horizontal" action="login.php" method="post">
			<fieldset>
			<div class="form-group">
			  <label class="col-md-4 control-label" for="login">Логин</label>  
			  <div class="col-md-4">
			  <input id="login" name="username" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $username; ?>"/> 
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-md-4 control-label" for="password">Пароль</label>
			  <div class="col-md-4">
			    <input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="" value="<?php echo $password; ?>"/>
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-md-4 control-label" for="submit"></label>
			  <div class="col-md-4">
			    <button value="Login" id="submit" name="submit-login" class="btn btn-success">Войти</button>
			  </div>
			</div>
			<br/>
			</fieldset>
			</form>
			<?php if($error != "") : ?>
			<div class="alert alert-danger" role="alert">
			  <strong>Ошибка</strong><br>
			  <?php echo $error; ?>
			<?php endif; ?>
		</center>
		<?php endif; ?>
		</main>
</body>
</html>