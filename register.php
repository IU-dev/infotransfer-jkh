<?php
//register.php

require_once 'includes/global.inc.php';
$page = "register.php";
require_once 'includes/header.inc.php';
//инициализируем php переменные, которые используются в форме
$username = "";
$password = "";
$password_confirm = "";
$email = "";
$displayname = "";
$error = "";
$correct = false;

//проверить отправлена ли форма
if(isset($_POST['submit-form'])) { 

//получить переменные $_POST
$username = $_POST['username'];
$password = $_POST['password'];
$password_confirm = $_POST['password-confirm'];
$email = $_POST['email'];
$displayname = $_POST['displayname'];

//инициализировать переменные для проверки формы
$success = true;
$userTools = new UserTools();

//проверить правильность заполнения формы
//проверить не занят ли этот логин
if($userTools->checkUsernameExists($username))
{
$error = '<div class="alert alert-danger" role="alert">Логин уже существует.</div>';
$success = false;
}


if($success)
{
//подготовить информацию для сохранения объекта нового пользователя
$data['username'] = $username;
$data['password'] = md5($password); //зашифровать пароль для хранения
$data['email'] = $email;
$data['displayname'] = $displayname;

//создать новый объект пользователя
$newUser = new User($data);

//сохранить нового пользователя в БД
$newUser->save(true);

//редирект на страницу приветствия
$error = '<div class="alert alert-success" role="alert">Пользователь успешно создан.<br>Для входа <a href="login.php">перейдите по кнопке "Вход"</a></div>';
$correct = true;
}
}

//Если форма не отправлена или не прошла проверку, тогда показать форму снова

?>
<html>
<head>
<title>Регистрация | <?php echo $pname; ?></title>
</head>
<body>
<?php if($error) echo $error; 
	?>
<?php if($correct != true) : ?>
<form action="register.php" method="post">
<div class="form-group row">
    <label for="username" class="col-4 col-form-label">Логин</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-address-card"></i>
          </div>
        </div> 
        <input id="username" value="<?php echo $username; ?>" name="username" type="text" class="form-control" required="required">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="text" class="col-4 col-form-label">E-mail</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-commenting"></i>
          </div>
        </div> 
        <input id="text" name="email" value="<?php echo $email; ?>" type="email" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="displayname" class="col-4 col-form-label">ФИО</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-address-card-o"></i>
          </div>
        </div> 
        <input id="displayname" value="<?php echo $displayname; ?>" name="displayname" type="text" class="form-control" required="required">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="password" class="col-4 col-form-label">Пароль</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-id-badge"></i>
          </div>
        </div> 
        <input id="password" value="<?php echo $password; ?>" name="password" type="password" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="password-confirm" class="col-4 col-form-label">Повторите пароль</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-id-badge"></i>
          </div>
        </div> 
        <input id="password-confirm" value="<?php echo $password_confirm; ?>" name="password-confirm" type="password" class="form-control" required="required">
      </div>
    </div>
  </div> 
<div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit-form" type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </div>
</form>
<?php endif; ?>
</body>
</html>